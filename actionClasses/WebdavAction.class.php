<?php


/**
 * Action-Klasse fuer WEBDAV.
 * 
 * WebDAV ist spezifiziert in der RFC 2518.
 * Geplant wird: DAV-Level 1 (wenn fertig).
 * Aktuell wird eine Nur-Lese-Modus implementiert, Schreiben folgt später.
 * 
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class WebdavAction extends Action
{
	var $defaultSubAction = 'show';
	var $database;
	var $depth;
	var $project;
//	var $folder;
	var $obj;
	var $filename;
	var $pathnames = array();
	var $uri;
	var $headers;
	var $requestType;
	var $fullSkriptName;

	function WebdavAction()
	{
		// Nicht notwendig, da wir den Error-Handler umbiegen:
		// error_reporting(0); // PHP-Fehlermeldungen zerstören XML-Dokument, daher ausschalten.
//				phpinfo();
		
		// PHP-Fehler ins Log schreiben, damit die Ausgabe nicht zerstört wird.
		set_error_handler('webdavErrorHandler');
		
		header('MS-Author-Via: DAV'           ); // Extrawurst fuer MS-Clients.
		header('X-Dav-powered-by: OpenRat CMS'); // Bandbreite verschwenden :)
		Logger::debug( 'WEBDAV: Method '.$_GET['subaction'] );
		
		$this->headers = getallheaders();

		// Prüfen, ob Benutzer angemeldet ist.
		$user = $this->getUserFromSession();
		if	( !is_object($user))
		{
			if	( !is_object(Session::getDatabase()) )
				$this->setDefaultDb();
				
			$ok = false;
			if	( isset($_SERVER['PHP_AUTH_USER']) )
			{
				$user = new User();
				$user->name = $_SERVER['PHP_AUTH_USER'];
				
				$ok = $user->checkPassword( $_SERVER['PHP_AUTH_PW'] );
				
				if	( $ok )
					$user->setCurrent();
			}
			
			if	( !$ok )
			{
				header('WWW-Authenticate: Basic realm="OpenRat"');
				$this->httpStatus('401 Unauthorized');
				exit;
			}
		}
		
		
		$this->fullSkriptName = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'].'/';	

		$uri = '/1/2'.substr($_SERVER['REQUEST_URI'],strlen($_SERVER['SCRIPT_NAME']));
		
		Logger::debug( 'WEBDAV: URI '.$uri);
		$uriParts = explode('/',dirname($uri).'/'.basename($uri) );
		$this->filename = basename($uri);
		$i=0;
//		Html::debug($uriParts,'Parts');
		foreach( $uriParts as $nr=>$uriPart )
		{
			switch( $nr )
			{
				case 0:
				case 1:
					break;

				case 2:
					// URI='/'
					// Keine weiteren URL-Bestandteile, also Projektliste laden.
					$this->requestType = 'projectlist';
					break;
				case 3:
					// URI='/project/'
					// Name des Projektes in der URL, es wird das Projekt geladen.
					$this->requestType = 'object';
					
					$this->project = new Project();
					$this->project->name = $uriPart;
//					Logger::warn($this->project->name);
					$this->project->loadByName();
					//Session::setProjectLanguage( new Language( $this->project->getDefaultLanguageId() ) );
					//Session::setProjectModel   ( new Model   ( $this->project->getDefaultModelId()    ) );
					
					$oid = $this->project->getRootObjectId();
					$this->folder = new Folder($oid);
					$this->obj = $this->folder;
				
//				Logger::debug('ja');
					$this->fullSkriptName .= $uriPart.'/';	

					break;

				default:
					// URI='/project/a'
					// URI='/project/a/'
					
					$oid = $this->folder->getObjectIdByFileName($uriPart);
//					$this->obj = ObjectFactory::create($oid);

					if	( $oid == 0 )
					{
						
						Logger::debug( 'Existiert nicht: Teil '.$uriPart);
						$this->obj = null;
					}
					else
					{
						Logger::debug( 'Teil '.$uriPart);
						$this->obj = new Object($oid);
						$this->obj->load();
						
	//					if	( $this->obj->isFolder() )
						$this->folder = new Folder($oid);
					}

					$this->fullSkriptName .= $uriPart;
					
					if	( $this->obj != null && $this->obj->isFolder )	
						$this->fullSkriptName .= '/';	
					
					break;
			}
		}
		
//		$this->fullSkriptName .= $this->filename;	
		
		Logger::debug( 'Skriptname: '.$this->fullSkriptName);
//		Logger::debug( 'Objekt: '.$this->obj->getType() );
//		Logger::debug( 'Objekt: '.print_r($this->obj,true) );
		
		foreach(getallheaders() as $k=>$v)
			Logger::debug( 'WEBDAV: REQ_HEADER_'.$k.'='.$v);

		$this->request  = implode('',file('php://input')); 
		Logger::debug( 'WEBDAV: REQ_BODY='.$this->request);
		
//		Logger::debug('E super');
	}
	
	
	
	function setDefaultDb()
	{
		global $conf;

		if	( !isset($conf['database']['default']) )
			die('default-database not set');

		$dbid = $conf['database']['default'];

		$db = new DB( $conf['database'][$dbid] );
		$db->id = $dbid;
		Session::setDatabase( $db );
	}
	
	
	
	function options()
	{
		Logger::debug('WEBDAV: client wants to see our OPTIONS');
		header('DAV: 1');
		header('Allow: GET,PUT,MKCOL,PROPFIND');

		$this->httpStatus( '200 OK' );
		exit();
	}
	
	

	/**
	 * Setzt einen HTTP-Status.<br>
	 * <br>
	 * Es wird ein HTTP-Status gesetzt, zusätzlich wird der Status in den Header "X-WebDAV-Status" geschrieben.
	 */	
	function httpStatus( $status = true )
	{
		Logger::debug('WEBDAV: HTTP-Status: '.$status);
		
		if	( $status === true )
			$status = '200 OK';
			
		header('HTTP/1.1 '.$status);
		header('X-WebDAV-Status: '.$status,true);
	}
	
	

	/**
	 * WebDav-GET-Methode.
	 * Die gewünschte Datei wird geladen und im HTTP-Body mitgeliefert.
	 */	
	function get()
	{
		if	( $this->obj->isFolder )
			$this->getDirectory();
		elseif( $this->obj->isPage )
		{
			$this->httpStatus( '200 OK' );
			
			header('Content-Type: text/html');
			echo '<html><head><title>OpenRat WEBDAV Access</title></head>';
			echo '<body>';
			echo '<h1>Page</h1>';
			echo '<pre>';
			echo 'No Content available';
	//		echo 'Testseite: '.$this->uri;
	//		echo 'Pathname: '.$this->pathname;
	//		echo 'Filename: '.$this->filename;
			echo '</pre>';
			echo '</body>';
			echo '</html>';
		}
		elseif( $this->obj->isLink )
		{
			$this->httpStatus( '200 OK' );
			
			header('Content-Type: text/html');
			echo '<html><head><title>OpenRat WEBDAV Access</title></head>';
			echo '<body>';
			echo '<h1>Link</h1>';
			echo '<pre>';
			echo 'No Content available';
	//		echo 'Testseite: '.$this->uri;
	//		echo 'Pathname: '.$this->pathname;
	//		echo 'Filename: '.$this->filename;
			echo '</pre>';
			echo '</body>';
			echo '</html>';
		}
		elseif( $this->obj->isFile )
		{
			$this->httpStatus( '200 OK' );
			
			$file = new File( $this->obj->objectid );
			$file->load();
			
			header('Content-Type: '.$file->mimeType() );
			header('X-File-Id: '.$file->fileid );
	
			// Angabe Content-Disposition
			// - Bild soll "inline" gezeigt werden
			// - Dateiname wird benutzt, wenn der Browser das Bild speichern moechte
			header('Content-Disposition: inline; filename='.$file->filenameWithExtension() );
			header('Content-Transfer-Encoding: binary' );
			header('Content-Description: '.$file->name );
	
			$file->loadValue(); // Bild aus Datenbank laden
	
			// Groesse des Bildes in Bytes
			// Der Browser hat so die Moeglichkeit, einen Fortschrittsbalken zu zeigen
			header('Content-Length: '.strlen($file->value) );
	
			echo $file->value;
		}
		exit;
	}
	
	
	
	/**
	 * Erzeugt ein Unix-ähnliche Ausgabe des Verzeichnisses als HTML.
	 */
	function getDirectory()
	{
		$this->httpStatus( '200 OK' );
		
		// Verzeichnis ausgeben
		header('Content-Type: text/html');
		echo '<html><head><title>OpenRat directory content</title></head>';
		echo '<body>';
		echo '<pre>';
		echo '<a href="../">..</a>';
		echo '</pre>';
		echo '</body>';
		echo '</html>';
		
		exit;
	}
	
	
	
	function lock()
	{
//		$this->httpStatus('405 Not Allowed, LOCK not implemented');
		$this->httpStatus('412 Precondition failed');
		$this->options();
		exit;
	}


		
	function unlock()
	{
//		$this->httpStatus('405 Not Allowed, UNLOCK not implemented');
		$this->httpStatus('412 Precondition failed');
		$this->options();
		exit;
	}



	/**
	 * Verzeichnis anlegen.
	 * 
	 * Diese Methode ist nicht implementiert. Der Client erhält eine Nachricht, dass die Methode nicht verfügbar ist.
	 */		
	function mkcol()
	{
		if	( $this->obj == null )
		{
			// NEUE Datei
			$f = new Folder();
			$f->filename  = basename($this->fullSkriptName);
			$f->parentid  = $this->folder->objectid;
			$f->projectid = $this->project->projectid;
			$f->add();
			$this->httpStatus('201 Created');
		}
		elseif	( $this->obj->isFolder )
		{
			$file = new File( $this->obj->objectid );
			$file->saveValue( $this->request );
			$file->setTimestamp();
			$this->httpStatus('204 No Content');
		}
		else
		{
			$this->httpStatus('405 Not Allowed, MKCOL on existing object' );
			echo 'Error: MKCOL on existing object';
		}
		exit;
	}


		
	/**
	 * Objekt löschen.
	 */		
	function delete()
	{
		// Aus Sicherheitsgründen erstmal deaktiviert!
		if	( true )
		{
			$this->httpStatus('405 Not Allowed' );
			exit;
		}
		else
		{
			if	( $this->obj->isFolder )
			{
				$this->obj->deleteAll();
			}
			else
			{
				$this->obj->delete();
			}

			$this->httpStatus( true );
			exit;
		}
	}


		
	/**
	 * Diese Methode ist nicht implementiert. Der Client erhält eine Nachricht, dass die Methode nicht verfügbar ist.
	 */		
	function copy()
	{
		$this->httpStatus('405 Not Allowed, Not implemented');
		exit;
	}


		
	/**
	 * Diese Methode ist nicht implementiert. Der Client erhält eine Nachricht, dass die Methode nicht verfügbar ist.
	 */		
	function move()
	{
		$this->httpStatus('405 Not Allowed, Not implemented');
		exit;
	}


		
	/**
	 * Das PUT ist nur für Dateien möglich.
	 */		
	function put()
	{
		if	( $this->obj == null )
		{
			// NEUE Datei
			$file = new File();
			$file->filename  = basename($this->fullSkriptName);
			$file->extension = '';		
			$file->size      = strlen($this->request);
			$file->parentid  = $this->folder->objectid;
			$file->projectid = $this->project->projectid;
			$file->value     = $this->request;
			Logger::debug('NEUE DATEI '.print_r($file,true));
			$file->add();
			$this->httpStatus('201 Created');
		}
		elseif	( $this->obj->isFile )
		{
			$file = new File( $this->obj->objectid );
			$file->saveValue( $this->request );
			$file->setTimestamp();
			$this->httpStatus('204 No Content');
		}
		else
		{
			$this->httpStatus('405 Not Allowed, PUT not implemented for object type '.$this->obj->getType() );
		}
		exit;
	}
	
	

	/**
	 * WebDav-Methode PROPFIND.
	 * 
	 * Diese Methode wird beim Ermitteln von Verzeichnisinhalten verwendet.
	 */	
	function propfind()
	{
		Logger::debug( 'WEBDAV: PROPFIND');
		
		switch( $this->requestType )
		{
			case 'projectlist':  // Projektliste
				
				$inhalte = array();
				foreach( Project::getAll() as $projectName )
				{
					$objektinhalt = array();
					$z = 30*365.25*24*60*60;
					$objektinhalt['createdate'    ] = $z;
					$objektinhalt['lastchangedate'] = $z;
					$objektinhalt['size'          ] = 1;
					$objektinhalt['name'          ] = $this->fullSkriptName.'/'.$projectName;
					$objektinhalt['type']           = 'folder';
					$inhalte[] = $objektinhalt;
				}
					
				$this->multiStatus( $inhalte );
				break;

			case 'object':  // Verzeichnisinhalt
			
				if	( $this->obj == null )
				{
					Logger::debug( 'WEBDAV: PROPFIND of non-existent object');
					// Objekt existiert nicht.
				}
				elseif	( $this->obj->isFolder )
				{
					Logger::debug( 'WEBDAV: PROPFIND of folder');

					$inhalte = array();

					$objektinhalt = array();
					$objektinhalt['createdate'    ] = $this->obj->createDate;
					$objektinhalt['lastchangedate'] = $this->obj->lastchangeDate;
					$objektinhalt['name'] = $this->fullSkriptName;
					$objektinhalt['type'] = 'folder';
					$objektinhalt['size'] = 1;
					$inhalte[] = $objektinhalt;
					
					$objects = $this->folder->getObjects();
					foreach( $objects as $object  )
					{
						//$object->loadRaw();
						$objektinhalt = array();
						$objektinhalt['createdate'    ] = $object->createDate;
						$objektinhalt['lastchangedate'] = $object->lastchangeDate;
						
						switch( $object->getType() )
						{
							case OR_TYPE_FOLDER:
								$objektinhalt['name'] = $this->fullSkriptName.$object->filename.'/';
								$objektinhalt['type'] = 'folder';
								$objektinhalt['size'] = 1;
								$inhalte[] = $objektinhalt;
								break;
							case OR_TYPE_FILE:
								$objektinhalt['name'] = $this->fullSkriptName.$object->filename;
								$objektinhalt['type'] = 'file';
								$objektinhalt['size'] = 1;
								$objektinhalt['mime'] = 'application/x-non-readable';
								$inhalte[] = $objektinhalt;
								break;
							case OR_TYPE_LINK:
								$objektinhalt['name'] = $this->fullSkriptName.$object->filename;
								$objektinhalt['type'] = 'file';
								$objektinhalt['size'] = 0;
								$objektinhalt['mime'] = 'application/x-non-readable';
								$inhalte[] = $objektinhalt;
								break;
							case OR_TYPE_PAGE:
								$objektinhalt['name'] = $this->fullSkriptName.$object->filename;
								$objektinhalt['type'] = 'file';
								$objektinhalt['size'] = 0;
								$inhalte[] = $objektinhalt;
								break;
							default:
						}
					}
					Logger::debug( 'WEBDAV: PROPFIND2');
					
					if	( count($inhalte)==0 )
						$inhalte[] = array('createdate'=>0,'lastchangedate'=>0,'name'=>'empty','size'=>0,'type'=>'file');
						
					Logger::debug('Anzahl Dateien:'.count($inhalte));
					$this->multiStatus( $inhalte );
				}
				else
				{
					$object = $this->obj;
					Logger::debug( 'WEBDAV: PROPFIND of file');
					$objektinhalt = array();
					//$object->loadRaw();
					$objektinhalt = array();
					$objektinhalt['name']           = $this->fullSkriptName.'/'.$object->filename.'/';
					$objektinhalt['createdate'    ] = $object->createDate;
					$objektinhalt['lastchangedate'] = $object->lastchangeDate;
					$objektinhalt['size'          ] = 0;
					$objektinhalt['type'          ] = 'file';
					
					
					$this->multiStatus( array($objektinhalt) );
				}
				break;
				
			default:
				die('???:'.$this->requestType);
		}
		
		exit;
	}
	
	
	/**
	 * Webdav-Methode PROPPATCH ist nicht implementiert.
	 */
	function proppatch()
	{
		
		Logger::debug( 'WEBDAV: PROPPATCH');
		
		$this->httpStatus('405 Not Allowed, Not implemented');
		exit;
	}
	
	
	/**
	 * Erzeugt einen Multi-Status.
	 */
	function multiStatus( $files )
	{
		$this->httpStatus('207 Multi-Status');
		header('Content-Type: text/xml; charset=utf-8');
		
		$response = '';
		$response .= '<?xml version="1.0" encoding="utf-8" ?>';
		$response .= '<d:multistatus xmlns:d="DAV:">';

		foreach( $files as $file )
			$response .= $this->getResponse( $file['name'],$file );
		
		$response .= '</d:multistatus>';
		Logger::debug('PROPFIND-Ausgabe: '.$response);

		$response = utf8_encode($response);

		header('Content-Length: '.strlen($response));
		echo $response;
	}
	
	
	function getResponse( $file,$options )
	{
//		extract($options,EXTR_OVERWRITE,'opt');
		
		$response = '';
		$response .= '<d:response>';
		$response .= '<d:href>'.$file.'</d:href>';
		$response .= '<d:propstat>';
		$response .= '<d:prop>';
//		$response .= '<d:source></d:source>';
		$response .= '<d:creationdate>'.date('r',$options['createdate']).'</d:creationdate>';
//		$response .= '<d:getlastmodified>'.date('r',$options['lastchangedate']).'</d:getlastmodified>';
		$response .= '<d:displayname>'.$options['name'].'</d:displayname>';
		$response .= '<d:getcontentlength>'.$options['size'].'</d:getcontentlength>';
		$response .= '<d:getlastmodified xmlns:b="urn:uuid:c2f41010-65b3-11d1-a29f-00aa00c14882/" b:dt="dateTime.rfc1123">'.date('r',$options['lastchangedate']).'</d:getlastmodified>';
		
		if	( $options['type'] == 'folder')
			$response .= '<d:resourcetype><d:collection/></d:resourcetype>';
		else
			$response .= '<d:resourcetype></d:resourcetype>';
			
		$response .= '<d:categories></d:categories>';
		$response .= '<d:fields></d:fields>';
		
		
		
//		$response .= '<d:getcontenttype>text/html</d:getcontenttype>';
//		$response .= '<d:getcontentlength />';
//		$response .= '<d:getcontentlanguage />';
//		$response .= '<d:executable />';
//		$response .= '<d:resourcetype>';
//		$response .= '<d:collection />';
//		$response .= '</d:resourcetype>';
//		$response .= '<d:getetag />';

		$response .= '</d:prop>';
		$response .= '<d:status>HTTP/1.1 200 OK</d:status>';
		$response .= '</d:propstat>';
		$response .= '</d:response>';

		return $response;		
	}
}



function webdavErrorHandler($errno, $errstr, $errfile, $errline) 
{
	Logger::warn('WEBDAV ERROR: '.$errno.'/'.$errstr.'/file:'.$errfile.'/line:'.$errline);
}

?>