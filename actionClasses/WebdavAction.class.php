<?php


/**
 * Action-Klasse fuer WEBDAV.<br>
 * <br>
 * WebDAV ist spezifiziert in der RFC 2518.<br>
 * Siehe <code>http://www.ietf.org/rfc/rfc2518.txt</code><br>
 * Implementiert wird DAV-Level 1 (d.h. ohne LOCK).
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
	var $folder;
	var $obj;
	var $filename;
	var $pathnames = array();
	var $uri;
	var $headers;
	var $requestType;
	var $request;
	var $destination = null;
	var $fullSkriptName;
	var $create;
	var $readonly;
	var $maxFileSize;
	var $webdav_conf;

	function WebdavAction()
	{
		if (!defined('E_STRICT')) 
			define('E_STRICT', 2048);

		// Nicht notwendig, da wir den Error-Handler umbiegen:
<<<<<<< WebdavAction.class.php
		// error_reporting(0); // PHP-Fehlermeldungen zerstoeren XML-Dokument, daher ausschalten.
		error_reporting(E_ALL ^ E_STRICT);
		error_reporting(0);
		error_reporting(E_ERROR | E_WARNING | E_NOTICE);
		error_reporting(E_ERROR);
		//echo "error-rep:".error_reporting(0);
		//echo "error-rep:".error_reporting(0);
		error_reporting(0);
		
		// PHP-Fehler ins Log schreiben, damit die Ausgabe nicht zerstoert wird.
		//set_error_handler('webdavErrorHandler');
		// PHP5-only?
		set_error_handler('webdavErrorHandler',E_ERROR | E_WARNING | E_NOTICE);
=======
		// error_reporting(0); // PHP-Fehlermeldungen zerst�ren XML-Dokument, daher ausschalten.
		
		// PHP-Fehler ins Log schreiben, damit die Ausgabe nicht zerst�rt wird.
		set_error_handler('webdavErrorHandler');
>>>>>>> 1.4

		global $conf;
		$this->webdav_conf = $conf['webdav'];

		if	( $this->webdav_conf['compliant_to_redmond'] )
			header('e'           ); // Extrawurst fuer MS-Clients.
			
		if	( $this->webdav_conf['expose_openrat'] )
			header('X-Dav-powered-by: OpenRat CMS'); // Bandbreite verschwenden :)

//		foreach(getallheaders() as $k=>$v)
//			Logger::debug( 'WEBDAV: REQ_HEADER_'.$k.'='.$v);

		#	echo "error-rep:".error_reporting(0);
		Logger::debug( 'WEBDAV: URI='.$_SERVER['REQUEST_URI']);
//		Logger::debug( 'WEBDAV: SCRIPT_NAME='.$_SERVER['SCRIPT_NAME']);
		
		if	( !$conf['webdav']['enable'])
		{
			Logger::info( 'WEBDAV is disabled' );
			$this->httpStatus('403 Forbidden');
			exit;
		}
		
		$this->create      = $this->webdav_conf['create'];
		$this->readonly    = $this->webdav_conf['readonly'];
		$this->maxFileSize = $this->webdav_conf['max_file_size'];
		
<<<<<<< WebdavAction.class.php
		Logger::debug( 'method '.$_GET['subaction'] );
=======
		Logger::debug( 'WEBDAV: Method '.$_GET[REQ_PARAM_SUBACTION] );
>>>>>>> 1.4
		
		$this->headers = getallheaders();
		/* DAV compliant servers MUST support the "0", "1" and
		 * "infinity" behaviors. By default, the PROPFIND method without a Depth
		 * header MUST act as if a "Depth: infinity" header was included. */
		if	( !isset($this->headers['Depth']) )
			$this->depth = 1;
		elseif	( strtolower($this->headers['Depth'])=='infinity')
			$this->depth = 1;
		else
			$this->depth = intval($this->headers['Depth']);

		if	( isset($this->headers['Destination']) )
			$this->destination = $this->headers['Destination'];

		// Pr�fen, ob Benutzer angemeldet ist.
		$user = $this->getUserFromSession();

		// Authentisierung erzwingen.
        // for the motivation for not checking OPTIONS requests see 
        // http://pear.php.net/bugs/bug.php?id=5363
		if	( !is_object($user) && $_GET[REQ_PARAM_SUBACTION] != 'options' )
		{
			Logger::debug( 'WEBDAV: Need Auth!' );
			if	( !is_object(Session::getDatabase()) )
				$this->setDefaultDb();
				
			Logger::debug( 'WEBDAV: Need Auth! #2' );
			$ok = false;
			if	( isset($_SERVER['PHP_AUTH_USER']) )
			{
				Logger::debug( 'WEBDAV: Checking Auth!' );
				$user = new User();
				$user->name = $_SERVER['PHP_AUTH_USER'];
				
				$ok = $user->checkPassword( $_SERVER['PHP_AUTH_PW'] );
				
				if	( $ok )
				{
					$user->setCurrent();
					$this->redirectWithSessionId();
				}
			}
			
			if	( !$ok )
			{
				Logger::debug( 'WEBDAV: Requesting Auth!' );
				header('WWW-Authenticate: Basic realm="OpenRat"');
				$this->httpStatus('401 Unauthorized');
				exit;
			}
		}
		elseif	( !is_object($user) && $_GET[REQ_PARAM_SUBACTION] == 'options' )
		{
			$this->setDefaultDb();
		}
		
		
		$this->fullSkriptName = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'].'/';	

		if	( $this->webdav_conf['session_in_uri'] )
			$sos = 1+strlen(session_id())+strlen($this->webdav_conf['session_in_uri_prefix']);
		else
			$sos = 0;
			
		// URL parsen.
		$uri = substr($_SERVER['REQUEST_URI'],strlen($_SERVER['SCRIPT_NAME']) + $sos);

		Logger::debug( 'URI='.$uri );
			
		$uri = $this->parseURI( $uri );
		$this->requestType = $uri['type'   ];
		$this->folder      = $uri['folder' ];
		$this->obj         = $uri['object' ];
		$this->project     = $uri['project'];

		$this->fullSkriptName .= implode('/',$uri['path']);
		
		if	( is_object($this->obj) && $this->obj->isFolder )	
			$this->fullSkriptName .= '/';	

		/*
		 * Verzeichnisse m�ssen mit einem '/' enden. Falls nicht, Redirect aussf�hren.
		 * 
		 * RFC 2518, 5.2 Collection Resources, Page 11:
		 * "For example, if a client invokes a
		 * method on http://foo.bar/blah (no trailing slash), the resource
		 * http://foo.bar/blah/ (trailing slash) may respond as if the operation
		 * were invoked on it, and should return a content-location header with
		 * http://foo.bar/blah/ in it.  In general clients SHOULD use the "/"
		 * form of collection names."
		 */
<<<<<<< WebdavAction.class.php
		if	( is_object($this->obj) && $this->obj->isFolder &&  $_GET['subaction']=='get' && substr($_SERVER['REQUEST_URI'],strlen($_SERVER['REQUEST_URI'])-1 ) != '/' )
=======
		if	( $this->obj->isFolder &&  $_GET[REQ_PARAM_SUBACTION]=='get' && substr($_SERVER['REQUEST_URI'],strlen($_SERVER['REQUEST_URI'])-1 ) != '/' )
>>>>>>> 1.4
		{
			Logger::debug( 'WEBDAV: Umleitung auf Verzeichnis mit ".../"' );
			
			header('HTTP/1.1 302 Moved Temporarily');
			header('Location: '.$_SERVER['REQUEST_URI'].'/');
			exit;	
		}	

		// Falls vorhanden, den "Destination"-Header parsen.
		if	( isset($_SERVER['HTTP_DESTINATION']) )
		{
			$destUri = parse_url( $_SERVER['HTTP_DESTINATION'] );
			
			$uri = substr($destUri['path'],strlen($_SERVER['SCRIPT_NAME'])+$sos);
				
			// URL parsen.
			$this->destination = $this->parseURI( $uri );
		}


		$this->request = implode('',file('php://input')); 
//		Logger::debug( 'WEBDAV: REQ_BODY='.$this->request);

		#Logger::debug( 'Uff' );

	}
	
	
	
	function redirectWithSessionId()
	{
		if	( $this->webdav_conf['session_in_uri'] )
		{
			header('Location: '.dirname($_SERVER['REQUEST_URI']).'/'. $this->webdav_conf['session_in_uri_prefix'].session_id().'/'.basename($_SERVER['REQUEST_URI']));
			//$this->httpStatus('303 See Other');
			$this->httpStatus('302 Moved');
		}
	}
	
	
	
	function setDefaultDb()
	{
		global $conf;
		
		if	( !isset($conf['database']['default']) )
			die('default-database not set');

		$dbid = $conf['database']['default'];
			Logger::debug( 'db' );

		$db = new DB( $conf['database'][$dbid] );
		$db->id = $dbid;
		Session::setDatabase( $db );
	}
	
	
	
	/**
	 * HTTP-Methode OPTIONS.<br>
	 * <br>
	 * Es werden die verf�gbaren Methoden ermittelt und ausgegeben.
	 */
	function options()
	{
		Logger::debug('WEBDAV: client wants to see our OPTIONS');
		header('DAV: 1'); // Wir haben DAV-Level 1.
		
		if	 ($this->readonly)
			header('Allow: OPTIONS, HEAD, GET, PROPFIND');  // Readonly-Modus
		else
			header('Allow: OPTIONS, HEAD, GET, PROPFIND, DELETE, PUT, COPY, MOVE, MKCOL, PROPPATCH');

		$this->httpStatus( '200 OK' );
		exit;
	}
	
	

	/**
	 * Setzt einen HTTP-Status.<br>
	 * <br>
	 * Es wird ein HTTP-Status gesetzt, zus�tzlich wird der Status in den Header "X-WebDAV-Status" geschrieben.<br>
	 * Ist der Status nicht 200 oder 207 (hier folgt ein BODY), wird das Skript beendet.
	 */	
	function httpStatus( $status = true )
	{
		if	( $status === true )
			$status = '200 OK';
			
		Logger::debug('WEBDAV: HTTP-Status: '.$status);
		
		header('HTTP/1.1 '.$status);
		header('X-WebDAV-Status: '.$status,true);
		
		// Bei Status 200 und 207 folgt Inhalt. Sonst nicht und beenden. 
		if	( !in_array(substr($status,0,3), array('200','207')) )
			exit;
	}
	
	

	/**
	 * WebDav-HEAD-Methode.
	 */	
	function head()
	{
		if	( $this->obj == null )
		{
			$this->httpStatus( '404 Not Found' );
		}
		elseif	( $this->obj->isFolder )
		{
			$this->httpStatus( '200 OK' );
		}
		elseif( $this->obj->isPage )
		{
			$this->httpStatus( '200 OK' );
		}
		elseif( $this->obj->isLink )
		{
			$this->httpStatus( '200 OK' );
		}
		elseif( $this->obj->isFile )
		{
			$this->httpStatus( '200 OK' );
		}
		exit;
	}
	
	
	
	/**
	 * WebDav-GET-Methode.
	 * Die gew�nschte Datei wird geladen und im HTTP-Body mitgeliefert.
	 */	
	function get()
	{
		if	( $this->obj->isFolder )
			$this->getDirectory();
		elseif( $this->obj->isPage )
		{
			$this->httpStatus( '403 Forbidden' );
			exit;
			$this->httpStatus( '200 OK' );
			
			header('Content-Type: text/html');
			echo '<html><head><title>OpenRat WEBDAV Access</title></head>';
			echo '<body>';
			echo '<h1>Page</h1>';
			echo '<pre>';
			echo 'No Content available';
			echo '</pre>';
			echo '</body>';
			echo '</html>';
		}
		elseif( $this->obj->isLink )
		{
			$this->httpStatus( '403 Forbidden' );
			exit;
			$this->httpStatus( '200 OK' );
			
			header('Content-Type: text/html');
			echo '<html><head><title>OpenRat WEBDAV Access</title></head>';
			echo '<body>';
			echo '<h1>Link</h1>';
			echo '<pre>';
			echo 'No Content available';
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
	
			// Groesse der Datei in Bytes
			// Der Browser hat so die Moeglichkeit, einen Fortschrittsbalken zu zeigen
			header('Content-Length: '.strlen($file->value) );
	
			echo $file->value;
		}
		exit;
	}
	
	
	
	/**
	 * Erzeugt ein Unix-�hnliche Ausgabe des Verzeichnisses als HTML.
	 */
	function getDirectory()
	{
		$this->httpStatus( '200 OK' );
		
		// Verzeichnis ausgeben
		header('Content-Type: text/html');
		$nl = "\n";
		$titel = 'Index of '.htmlspecialchars($this->fullSkriptName);
        $format = "%15s  %-19s  %-s\n";
		
		echo '<html><head><title>'.$titel.'</title></head>';
		echo '<body>';
        echo '<h1>'.$titel.'</h1>'.$nl;
		echo '<pre>';

        printf($format, "Size", "Last modified", "Filename");

/*

 */
		if	( $this->requestType == 'projectlist' )
		{
			foreach( Project::getAll() as $projectName )
			{
				$objektinhalt = array();
				$z = 30*365.25*24*60*60;
				$objektinhalt['createdate'    ] = $z;
				$objektinhalt['lastchangedate'] = $z;
				$objektinhalt['size'          ] = 1;
				echo '<a href="'.$this->fullSkriptName.'/'.$projectName.'">   </a>';
			}
		}
		elseif( $this->requestType == 'object' )  // Verzeichnisinhalt
		{
			$objects = $this->folder->getObjects();

			foreach( $objects as $object  )
			{
//				echo '<a href="'.$this->fullSkriptName.$object->filename.'/">'.$object->filename.'</a>';

//				       number_format($object->size),
				printf($format, 
				       number_format(1),
				       strftime("%Y-%m-%d %H:%M:%S",$object->lastchangeDate ),
				       '<a href="'.$object->filename.'">'.$object->filename.'</a>');
				echo $nl;
			}
		}
		
		echo '</pre>';
		echo '</body>';
		echo '</html>';
		
		exit;
	}
	
	

	/**
	 * Die Methode LOCK sollte garnicht aufgerufen werden, da wir nur
	 * Dav-Level 1 implementieren und dies dem Client auch mitteilen.<br>
	 * <br>
	 * Ausgabe von HTTP-Status 412 (Precondition failed)
	 */	
	function lock()
	{
		$this->httpStatus('412 Precondition failed');
		$this->options();
		exit;
	}


		
	/**
	 * Die Methode UNLOCK sollte garnicht aufgerufen werden, da wir nur
	 * Dav-Level 1 implementieren und dies dem Client auch mitteilen.<br>
	 * <br>
	 * Ausgabe von HTTP-Status 412 (Precondition failed)
	 */	
	function unlock()
	{
		$this->httpStatus('412 Precondition failed');
		$this->options();
		exit;
	}



	/**
	 * Die Methode POST ist bei WebDav nicht sinnvoll.<br>
	 * <br>
	 * Ausgabe von HTTP-Status 405 (Method Not Allowed)
	 */	
	function post()
	{
		// Die Methode POST ist bei Webdav nicht sinnvoll.
		$this->httpStatus('405 Method Not Allowed' );
		exit;
	}
	
	
	
	/**
	 * Verzeichnis anlegen.
	 */		
	function mkcol()
	{
		
		if	( !empty($this->request) )
		{
			$this->httpStatus('415 Unsupported Media Type' ); // Kein Body erlaubt
		}
		elseif	( $this->readonly )
		{
			$this->httpStatus('403 Forbidden' ); // Kein Schreibzugriff erlaubt
		}
		elseif	( $this->obj == null )
		{
			// Die URI ist noch nicht vorhanden
			$f = new Folder();
			$f->filename  = basename($this->fullSkriptName);
			$f->parentid  = $this->folder->objectid;
			$f->projectid = $this->project->projectid;
			$f->add();
			$this->httpStatus('201 Created');
		}
		else
		{
			// MKCOL ist nicht moeglich, wenn die URI schon existiert.
			$this->httpStatus('405 Method Not Allowed' );
		}
		exit;
	}


		
	/**
	 * Objekt l�schen.
	 */		
	function delete()
	{
		if	( $this->readonly )
		{
			$this->httpStatus('403 Forbidden' ); // Kein Schreibzugriff erlaubt
			//$this->httpStatus('405 Not Allowed' );
		}
		else
		{
			if	( $this->obj == null )
			{
				// Nicht existente URIs kann man auch nicht loeschen.
				$this->httpStatus('404 Not Found' );
			}
			elseif	( $this->obj->isFolder )
			{
				$f = new Folder( $this->obj->objectid );
				$f->deleteAll();
			}
			elseif	( $this->obj->isFile )
			{
				$f = new File( $this->obj->objectid );
				$f->delete();
			}
			elseif	( $this->obj->isPage )
			{
				$p = new Page( $this->obj->objectid );
				$p->delete();
			}
			elseif	( $this->obj->isLink )
			{
				$l = new Link( $this->obj->objectid );
				$l->delete();
			}

			$this->httpStatus( true ); // OK
		}
		
		exit;
	}


		
	/**
	 * Kopieren eines Objektes.<br>
	 * Momentan ist nur das Kopieren einer Datei implementiert.<br>
	 * Das Kopieren von Ordnern, Verkn�pfungen und Seiten ist nicht moeglich.
	 */		
	function copy()
	{
		if	( $this->readonly || !$this->create )
		{
			Logger::error('WEBDAV: COPY request, but readonly or no creating');
			$this->httpStatus('405 Not Allowed' );
			exit;
		}
		elseif( $this->obj == null )
		{
			// Was nicht da ist, laesst sich auch nicht verschieben.
			Logger::error('WEBDAV: COPY request, but Source not found');
			$this->httpStatus('405 Not Allowed' );
		}
		elseif ( $this->destination == null )
		{
			Logger::error('WEBDAV: COPY request, but no "Destination:"-Header');
			// $this->httpStatus('405 Not Allowed' );
			$this->httpStatus('412 Precondition failed');
		}
		else
		{
			// URL parsen.
			$dest = $this->destination;
			$destinationProject = $dest['project'];
			$destinationFolder  = $dest['folder' ];
			$destinationObject  = $dest['object' ];
			
			if	( $dest['type'] != 'object' )
			{
				Logger::debug('WEBDAV: COPY request, but "Destination:"-Header mismatch');
				$this->httpStatus('405 Not Allowed');
			}
			elseif	( $this->project->projectid != $destinationProject->projectid )
			{
				// Kopieren in anderes Projekt nicht moeglich.
				Logger::debug('WEBDAV: COPY request denied, project does not match');
				$this->httpStatus('403 Forbidden');
			}
			elseif	( $destinationObject != null )
			{
				Logger::debug('WEBDAV: COPY request denied, Destination exists. Overwriting is not supported');
				$this->httpStatus('403 Forbidden');
			}
			elseif ( is_object($destinationObject) && $destinationObject->isFolder)
			{
				Logger::debug('WEBDAV: COPY request denied, Folder-Copy not implemented');
				$this->httpStatus('405 Not Allowed');
			}
			elseif ( is_object($destinationObject) && $destinationObject->isLink)
			{
				Logger::debug('WEBDAV: COPY request denied, Link copy not implemented');
				$this->httpStatus('405 Not Allowed');
			}
			elseif ( is_object($destinationObject) && $destinationObject->isPage)
			{
				Logger::debug('WEBDAV: COPY request denied, Page copy not implemented');
				$this->httpStatus('405 Not Allowed');
			}
			else
			{
				$f = new File();
				$f->filename = basename($_SERVER['HTTP_DESTINATION']);
				$f->name     = '';
				$f->parentid = $destinationFolder->objectid;
				$f->projectid = $this->project->projectid;
				$f->add();
				$f->copyValueFromFile( $this->obj->objectid );
				
				#Logger::debug('WEBDAV: COPY request accepted, Destination: '.tinationObject->filename );
				Logger::debug('WEBDAV: COPY request accepted' );
				// Objekt wird in anderen Ordner kopiert.
				$this->httpStatus('201 Created' );
			}	
		}

	}


		
	/**
	 * Verschieben eines Objektes.<br>
	 * <br>
	 * Folgende Operationen sind m�glich:<br>
	 * - Unbenennen eines Objektes (alle Typen)<br> 
	 * - Verschieben eines Objektes (alle Typen) in einen anderen Ordner.<br>
	 */		
	function move()
	{
		if	( $this->readonly )
		{
			$this->httpStatus('403 Forbidden - Readonly Mode' ); // Schreibgeschuetzt
		}
		elseif	( !$this->create )
		{
			$this->httpStatus('403 Forbidden - No creation' ); // Schreibgeschuetzt
		}
		elseif( $this->obj == null )
		{
			// Was nicht da ist, laesst sich auch nicht verschieben.
			$this->httpStatus('404 Not Found' );
		}
		elseif ( $this->destination == null )
		{
			Logger::error('WEBDAV: MOVE request, but no "Destination:"-Header');
			// $this->httpStatus('405 Not Allowed' );
			$this->httpStatus('412 Precondition failed');
		}
		else
		{
			$dest = $this->destination;
			$destinationProject = $dest['project'];
			$destinationFolder  = $dest['folder' ];
			$destinationObject  = $dest['object' ];

			if	( $dest['type'] != 'object' )
			{
				Logger::debug('WEBDAV: MOVE request, but "Destination:"-Header mismatch');
				$this->httpStatus('405 Not Allowed');
				exit;
			}
			
			if	( $destinationObject != null )
			{
				Logger::debug('WEBDAV: MOVE request denied, destination exists');
				$this->httpStatus('412 Precondition Failed');
				exit;
			}
			
			if	( $this->project->projectid != $destinationProject->projectid )
			{
				// Verschieben in anderes Projekt nicht moeglich.
				Logger::debug('WEBDAV: MOVE request denied, project does not match');
				$this->httpStatus('405 Not Allowed');
				exit;
			}
			
			Logger::debug( "Vergl.".$this->folder->objectid.' mit '.$destinationFolder->objectid );
			
			if	( $this->folder->objectid == $destinationFolder->objectid )
			{
				Logger::debug('WEBDAV: MOVE request accepted, object renamed');
				// Resource bleibt in gleichem Ordner.
				$this->obj->filename = basename($_SERVER['HTTP_DESTINATION']);
				$this->obj->objectSave(false);
				$this->httpStatus('201 Created' );
				exit;
			}
			
			if	( $destinationFolder->isFolder )
			{
				Logger::debug('WEBDAV: MOVE request accepted, Destination: '.$destinationFolder->filename );
				// Objekt wird in anderen Ordner verschoben.
				$this->obj->setParentId( $destinationFolder->objectid );
				$this->httpStatus('201 Created' );
				exit;
			}
			
			$this->httpStatus('500 Internal Server Error - move' );
		}

		exit;
	}


		
	/**
	 * Anlegen oder �berschreiben Dateien �ber PUT.<br>
	 * Dateien k�nnen neu angelegt und �berschrieben werden.<br>
	 * <br>
	 * Seiten k�nnen nicht �berschrieben werden. Wird versucht,
	 * eine Seite mit PUT zu �berschreiben, wird der Status "405 Not Allowed" gemeldet.<br>
	 */		
	function put()
	{
		// TODO: 409 (Conflict) wenn �bergeordneter Ordner nicht da.

		if	( $this->webdav_conf['readonly'] )
		{
			$this->httpStatus('405 Not Allowed' );
		}		
		elseif	( strlen($this->request) > $this->maxFileSize*1000 )
		{
			// Maximale Dateigroesse ueberschritten.
			// Der Status 207 "Zuwenig Speicherplatz" passt nicht ganz, aber fast :)
			$this->httpStatus('507 Insufficient Storage' );
		}
		elseif	( $this->obj == null )
		{
			// Neue Datei anlegen
			if	( !$this->webdav_conf['create'] )
			{
				$this->httpStatus('405 Not Allowed' );
			}
			$file = new File();
			$file->filename  = basename($this->fullSkriptName);
			$file->extension = '';		
			$file->size      = strlen($this->request);
			$file->parentid  = $this->folder->objectid;
			$file->projectid = $this->project->projectid;
			$file->value     = $this->request;
			$file->add();
			$this->httpStatus('201 Created');
			exit;
		}
		elseif	( $this->obj->isFile )
		{
			// Bestehende Datei ueberschreiben.
			$file = new File( $this->obj->objectid );
			$file->saveValue( $this->request );
			$file->setTimestamp();
			$this->httpStatus('204 No Content');
			exit;
		}
		else
		{
			// F�r andere Objekttypen (Verzeichnisse, Links, Seiten) ist kein PUT moeglich.
			$this->httpStatus('405 Not Allowed' );
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
		switch( $this->requestType )
		{
			case 'projectlist':  // Projektliste
				
				$inhalte = array();
				
				$objektinhalt = array();
				$z = 30*365.25*24*60*60;
				$objektinhalt['createdate'    ] = $z;
				$objektinhalt['lastchangedate'] = $z;
				$objektinhalt['size'          ] = 1;
				$objektinhalt['name'          ] = $this->fullSkriptName;
				$objektinhalt['displayname'   ] = '';
				$objektinhalt['type']           = 'folder';

				$inhalte[] = $objektinhalt;
				
				foreach( Project::getAll() as $projectName )
				{
					$objektinhalt = array();
					$z = 30*365.25*24*60*60;
					$objektinhalt['createdate'    ] = $z;
					$objektinhalt['lastchangedate'] = $z;
					$objektinhalt['size'          ] = 1;
					$objektinhalt['name'          ] = $this->fullSkriptName.$projectName.'/';
					$objektinhalt['displayname'   ] = $projectName;
					$objektinhalt['type']           = 'folder';
					$inhalte[] = $objektinhalt;
				}
					
				$this->multiStatus( $inhalte );
				break;

			case 'object':  // Verzeichnisinhalt
			
				if	( $this->obj == null )
				{
					// Objekt existiert nicht.
					Logger::debug( 'WEBDAV: PROPFIND of non-existent object');
					$this->httpStatus('404 Not Found');
					exit;
					#$this->multiStatus( array() );
				}
				elseif	( $this->obj->isFolder )
				{
					Logger::debug( 'WEBDAV: PROPFIND of folder');

					$inhalte = array();

					$objektinhalt = array();
					$objektinhalt['createdate'    ] = $this->obj->createDate;
					$objektinhalt['lastchangedate'] = $this->obj->lastchangeDate;
//					$objektinhalt['name'] = substr($this->fullSkriptName,0,strlen($this->fullSkriptName)-1);
					$objektinhalt['name'] = $this->fullSkriptName;
					$objektinhalt['displayname'] = basename($this->fullSkriptName);
					$objektinhalt['type'] = 'folder';
					$objektinhalt['size'] = 1;
					$inhalte[] = $objektinhalt;
					
					if	( $this->depth > 0 )
					{
						$objects = $this->folder->getObjects();
						foreach( $objects as $object  )
						{
							//$object->loadRaw();
							$objektinhalt = array();
							$objektinhalt['createdate'    ] = $object->createDate;
							$objektinhalt['lastchangedate'] = $object->lastchangeDate;
							$objektinhalt['displayname'   ] = $object->filename;

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
					}
					Logger::debug( 'WEBDAV: PROPFIND2');
					
//					if	( count($inhalte)==0 )
//						$inhalte[] = array('createdate'=>0,'lastchangedate'=>0,'name'=>'empty','size'=>0,'type'=>'file');
						
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
					$objektinhalt['displayname']    = $object->filename;
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
		// TODO: Multistatus erzeugen.
		$this->httpStatus('405 Not Allowed');
//		$this->httpStatus('409 Conflict');
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
	
	
	/**
	 * Erzeugt ein "response"-Element, welches in ein "multistatus"-element verwendet werden kann.
	 */
	function getResponse( $file,$options )
	{
		// TODO: Nur angeforderte Elemente erzeugen.
		$response = '';
		$response .= '<d:response>';
		$response .= '<d:href>'.$file.'</d:href>';
		$response .= '<d:propstat>';
		$response .= '<d:prop>';
//		$response .= '<d:source></d:source>';
		$response .= '<d:creationdate>'.date('r',$options['createdate']).'</d:creationdate>';
		$response .= '<d:displayname>'.$options['displayname'].'</d:displayname>';
		$response .= '<d:getcontentlength>'.$options['size'].'</d:getcontentlength>';
		$response .= '<d:getlastmodified xmlns:b="urn:uuid:c2f41010-65b3-11d1-a29f-00aa00c14882/" b:dt="dateTime.rfc1123">'.date('r',$options['lastchangedate']).'</d:getlastmodified>';
		
		if	( $options['type'] == 'folder')
			$response .= '<d:resourcetype><d:collection/></d:resourcetype>';
		else
			$response .= '<d:resourcetype />';
			
		$response .= '<d:categories />';
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
	
	
	
	/**
	 * URI parsen.
	 */
	function parseURI( $uri )
	{
		// Ergebnis initialisieren (damit alle Schl�ssel vorhanden sind)
		$ergebnis = array('type'    => null,
		                  'project' => null,
		                  'path'    => array(),
		                  'folder'  => null,
		                  'object'  => null  );
		
		Logger::debug( 'WEBDAV: Parsen der URI '.$uri);
		$uriParts = explode('/',$uri);
		
		$nr = 0;
		$f = null;
		$o = null;
		$ergebnis['type'] = 'projectlist';

		foreach( $uriParts as $uriPart )
		{
			if	( empty( $uriPart))
				continue;

			$ergebnis['path'][] = $uriPart;	

			if	( $f == null )			
			{
				// URI='/project/'
				// Name des Projektes in der URL, es wird das Projekt geladen.
				$ergebnis['type'] = 'object';
				
				$p = new Project();
				$p->name = $uriPart;
				Logger::debug("Projektname: ".$p->name);
				$p->loadByName();
				$ergebnis['project'] = $p;
				// Das Projekt hat weder Sprache noch Variante gesetzt.
				//Session::setProjectLanguage( new Language( $this->project->getDefaultLanguageId() ) );
				//Session::setProjectModel   ( new Model   ( $this->project->getDefaultModelId()    ) );

				$oid = $p->getRootObjectId();

				$f = new Folder($oid);
//				$ergebnis['folder'] = $f;
				$ergebnis['object'] = $f;
				$ergebnis['folder'] = $f;
			
			}
			else
			{
				// URI='/project/a'
				// URI='/project/a/'
				if	( $ergebnis['object'] == null )
				{
					$this->httpStatus('409 Conflict');
					exit;
				}
				
				$oid = $f->getObjectIdByFileName($uriPart);

				if	( $oid == 0 )
				{
					Logger::debug( 'WEBDAV: URL-Teil existiert nicht: '.$uriPart);
					$ergebnis['object'] = null;
				}
				else
				{
					Logger::debug( 'Teil '.$uriPart);
					$o = new Object($oid);
					$o->load();
					$ergebnis['object'] = $o;
					
					if	( $o->isFolder )
					{
						$f = new Folder($oid);
						$ergebnis['folder'] = $f;
					}
				}
			}
		}

		#Logger::debug( 'WEBDAV: Fertig Parsen der URI');
		
		return $ergebnis;
	 }
}



/**
 * Fehler-Handler f�r WEBDAV.<br>
 * Bei einem Laufzeitfehler ist eine Ausgabe des Fehlers auf der Standardausgabe sinnlos.
 * Daher wird der Fehler nur geloggt.
 */
function webdavErrorHandler($errno, $errstr, $errfile, $errline) 
{
	Logger::warn('WEBDAV ERROR: '.$errno.'/'.$errstr.'/file:'.$errfile.'/line:'.$errline);

	// Wir teilen dem Client mit, dass auf dem Server was schief gelaufen ist.	
	WebdavAction::httpStatus('500 Internal Server Error');
}

?>