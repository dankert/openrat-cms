<?php


/**
 * Action-Klasse fuer WebDAV.<br>
 * 
 * Das virtuelle Ordnersystem dieses CMS kann über das WebDAV-Protokoll
 * dargestellt werden.
 * 
 * Diese Klasse nimmt die Anfragen von WebDAV-Clients entgegen, zerlegt die
 * Anfrage und erzeugt eine Antwort, die im HTTP-Body zurück übertragen
 * wird.
 * <br>
 * WebDAV ist spezifiziert in der RFC 2518.<br>
 * Siehe <code>http://www.ietf.org/rfc/rfc2518.txt</code><br>
 * 
 * Implementiert wird DAV-Level 1 (d.h. ohne LOCK).
 * 
 * @author Jan Dankert
 * @package openrat.actions
 */

class WebdavAction extends Action
{
	// Zahlreiche Instanzvariablen, die im Konstruktor
	// beim Zerlegen der Anfrag gefüllt werden.
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

	
	/**
	 * Im Kontruktor wird der Request analysiert und ggf. eine Authentifzierung
	 * durchgefuehrt.
	 */
	function WebdavAction()
	{
		if (!defined('E_STRICT')) 
			define('E_STRICT', 2048);

		// Nicht notwendig, da wir den Error-Handler umbiegen:
		error_reporting(0); // PHP-Fehlermeldungen zerstoeren XML-Dokument, daher ausschalten.
		
		// PHP-Fehler ins Log schreiben, damit die Ausgabe nicht zerstoert wird.
		if (version_compare(PHP_VERSION, '5.0.0', '>'))
			set_error_handler('webdavErrorHandler',E_ERROR | E_WARNING);
		else
			set_error_handler('webdavErrorHandler');

		global $conf;
		$this->webdav_conf = $conf['webdav'];

		if	( $this->webdav_conf['compliant_to_redmond'] )
			header('MS-Author-Via: DAV'           ); // Extrawurst fuer MS-Clients.
			
		if	( $this->webdav_conf['expose_openrat'] )
			header('X-Dav-powered-by: OpenRat CMS'); // Bandbreite verschwenden :)

		Logger::trace( 'WEBDAV: URI='.$_SERVER['REQUEST_URI']);
		
		if	( !$conf['webdav']['enable'])
		{
			Logger::warn( 'WEBDAV is disabled by configuration' );
			$this->httpStatus('403 Forbidden');
			exit;
		}
		
		$this->create      = $this->webdav_conf['create'];
		$this->readonly    = $this->webdav_conf['readonly'];
		$this->maxFileSize = $this->webdav_conf['max_file_size'];
		
		Logger::debug( 'WEBDAV method is '.$_GET['subaction'] );
		
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

		// Prï¿½fen, ob Benutzer angemeldet ist.
		$user = $this->getUserFromSession();

		// Authentisierung erzwingen (außer bei Methode OPTIONS).
        // For the motivation for not checking OPTIONS requests see 
        // http://pear.php.net/bugs/bug.php?id=5363
		if	( !is_object($user) && $_GET[REQ_PARAM_SUBACTION] != 'options' )
		{
			Logger::debug( 'Checking Authentication' );
			
			if	( !is_object(Session::getDatabase()) )
				$this->setDefaultDb();
				
			$ok = false;
			if	( isset($_SERVER['PHP_AUTH_USER']) )
			{
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
				// Client ist nicht angemeldet, daher wird nun die
				// Authentisierung angefordert.
				Logger::debug( 'Requesting Client to authenticate' );
				header('WWW-Authenticate: Basic realm="'.OR_TITLE.'"');
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

		Logger::debug( 'WebDAV: URI="'.$uri.'"' );
			
		$uri = $this->parseURI( $uri );
		$this->requestType = $uri['type'   ];
		$this->folder      = $uri['folder' ];
		$this->obj         = $uri['object' ];
		$this->project     = $uri['project'];

		$this->fullSkriptName .= implode('/',$uri['path']);
		
		if	( is_object($this->obj) && $this->obj->isFolder )	
			$this->fullSkriptName .= '/';	

		/*
		 * Verzeichnisse muessen mit einem '/' enden. Falls nicht, Redirect aussfuehren.
		 * 
		 * RFC 2518, 5.2 Collection Resources, Page 11:
		 * "For example, if a client invokes a
		 * method on http://foo.bar/blah (no trailing slash), the resource
		 * http://foo.bar/blah/ (trailing slash) may respond as if the operation
		 * were invoked on it, and should return a content-location header with
		 * http://foo.bar/blah/ in it.  In general clients SHOULD use the "/"
		 * form of collection names."
		 */
		if	( is_object($this->obj) && $this->obj->isFolder &&  $_GET['subaction']=='get' && substr($_SERVER['REQUEST_URI'],strlen($_SERVER['REQUEST_URI'])-1 ) != '/' )
		{
			Logger::debug( 'WebDAV: Redirect lame client to slashyfied URL' );
			
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

		// Den Request-BODY aus der Standardeingabe lesen.
		$this->request = implode('',file('php://input')); 
	}
	
	

	/**
	 * Falls ein WebDAV-Client keine Cookies setzen kann (was HTTP/1.1 eigentlich
	 * der Fall sein sollte), kann die Session-Id in die URL eingetragen
	 * werden. Dies muss in der Konfiguration aktiviert werden.
	 */
	function redirectWithSessionId()
	{
		if	( $this->webdav_conf['session_in_uri'] )
		{
			header('Location: '.dirname($_SERVER['REQUEST_URI']).'/'. $this->webdav_conf['session_in_uri_prefix'].session_id().'/'.basename($_SERVER['REQUEST_URI']));
			//$this->httpStatus('303 See Other');
			$this->httpStatus('302 Moved');
		}
	}
	
	
	
	/**
	 * Da im WebDAV-Request keine Datenbank-Id angegeben werden kann, benutzen
	 * wir hier die Standard-Datenbank.
	 */
	function setDefaultDb()
	{
		global $conf;
		
		if	( !isset($conf['database']['default']) )
		{
			Logger::error('No default database in configuration');
			$this->httpStatus('500 Internal Server Error - no default-database in configuration');
		}

		$dbid = $conf['database']['default'];

		$db = new DB( $conf['database'][$dbid] );
		$db->id = $dbid;
		Session::setDatabase( $db );
	}

	
	
	function allowed_methods()
	{
		
		if	 ($this->readonly)
			return array('OPTIONS','HEAD','GET','PROPFIND');  // Readonly-Modus
		else
			// PROPPATCH unterstuetzen wir garnicht, aber lt. Spec sollten wir das.
			return array('OPTIONS','HEAD','GET','PROPFIND','DELETE','PUT','COPY','MOVE','MKCOL','PROPPATCH');
	}
	
	
	
	/**
	 * HTTP-Methode OPTIONS.<br>
	 * <br>
	 * Es werden die verfuegbaren Methoden ermittelt und ausgegeben.
	 */
	function options()
	{
		header('DAV: 1'); // Wir haben DAV-Level 1.
		header('Allow: '.implode(', ',$this->allowed_methods()) );

		$this->httpStatus( '200 OK' );
		exit;
	}
	
	

	/**
	 * Setzt einen HTTP-Status.<br>
	 * <br>
	 * Es wird ein HTTP-Status gesetzt, zusï¿½tzlich wird der Status in den Header "X-WebDAV-Status" geschrieben.<br>
	 * Ist der Status nicht 200 oder 207 (hier folgt ein BODY), wird das Skript beendet.
	 */	
	function httpStatus( $status = true )
	{
		if	( $status === true )
			$status = '200 OK';
			
		Logger::debug('WEBDAV: HTTP-Status: '.$status);
		
		header('HTTP/1.1 '.$status);
		header('X-WebDAV-Status: '.$status,true);

		// RFC 2616 (HTTP/1.1), Section 10.4.6 "405 Method Not Allowed" says:
		//   "[...] The response MUST include an
		//    Allow header containing a list of valid methods for the requested
		//    resource."
		// 
		// RFC 2616 (HTTP/1.1), Section 14.7 "Allow" says:
		//   "[...] An Allow header field MUST be
		//     present in a 405 (Method Not Allowed) response."
		if	( substr($status,0,3) == '405' )
			header('Allow: '.implode(', ',$this->allowed_methods()) );
			
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
	 * Die gewï¿½nschte Datei wird geladen und im HTTP-Body mitgeliefert.
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
	
			$file->write(); // Bild aus Datenbank laden und in temporäre Datei schreiben

			// Groesse des Bildes in Bytes
			// Der Browser hat so die Moeglichkeit, einen Fortschrittsbalken zu zeigen
			header('Content-Length: '.filesize($file->tmpfile()) );
			readfile( $file->tmpfile() );
		}
		exit;
	}
	
	
	
	/**
	 * Erzeugt ein Unix-ï¿½hnliche Ausgabe des Verzeichnisses als HTML.
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
		elseif  ( !$this->folder->hasRight( ACL_CREATE_FOLDER ) )
		{
			$this->httpStatus('403 Forbidden' ); // Benutzer darf das nicht
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
			Logger::warn('MKCOL-Request to an existing resource');
			$this->httpStatus('405 Method Not Allowed' );
		}
		exit;
	}


		
	/**
	 * Objekt lï¿½schen.
	 */		
	function delete()
	{
		if	( $this->readonly )
		{
			$this->httpStatus('403 Forbidden' ); // Kein Schreibzugriff erlaubt
		}
		else
		{
			if	( $this->obj == null )
			{
				// Nicht existente URIs kann man auch nicht loeschen.
				$this->httpStatus('404 Not Found' );
			}
			elseif  ( ! $this->obj->hasRight( ACL_DELETE ) )
			{
				$this->httpStatus('403 Forbidden' ); // Benutzer darf die Resource nicht loeschen
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
	 * Das Kopieren von Ordnern, Verknï¿½pfungen und Seiten ist nicht moeglich.
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
			elseif ( is_object($destinationFolder) && ! $destinationFolder->hasRight( ACL_CREATE_FILE ) )
			{
				$this->httpStatus('403 Forbidden' ); // Benutzer darf das nicht
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
				
				Logger::debug('WEBDAV: COPY request accepted' );
				// Objekt wird in anderen Ordner kopiert.
				$this->httpStatus('201 Created' );
			}	
		}

	}


		
	/**
	 * Verschieben eines Objektes.<br>
	 * <br>
	 * Folgende Operationen sind mï¿½glich:<br>
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
		elseif( is_object($this->obj) && ! $this->obj->hasRight( ACL_WRITE ) )
		{
			// Was nicht da ist, laesst sich auch nicht verschieben.
			Logger::error('Source '.$this->obj->objectid.' is not writable: Forbidden');
			$this->httpStatus('403 Forbidden' );
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

			if	( is_object($destinationFolder) && ! $destinationFolder->hasRight( ACL_CREATE_FILE ) )
			{
				Logger::error('Source '.$this->obj->objectid.' is not writable: Forbidden');
				$this->httpStatus('403 Forbidden' );
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
			
			Logger::warn('WEBDAV: MOVE request failed' );
			$this->httpStatus('500 Internal Server Error' );
		}

		exit;
	}


		
	/**
	 * Anlegen oder ï¿½berschreiben Dateien ï¿½ber PUT.<br>
	 * Dateien kï¿½nnen neu angelegt und ï¿½berschrieben werden.<br>
	 * <br>
	 * Seiten kï¿½nnen nicht ï¿½berschrieben werden. Wird versucht,
	 * eine Seite mit PUT zu ï¿½berschreiben, wird der Status "405 Not Allowed" gemeldet.<br>
	 */		
	function put()
	{
		// TODO: 409 (Conflict) wenn ï¿½bergeordneter Ordner nicht da.

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
				Logger::warn('WEBDAV: Creation of files not allowed by configuration' );
				$this->httpStatus('405 Not Allowed' );
			}
			
			if	( ! $this->folder->hasRight( ACL_CREATE_FILE ) )
			{
				$this->httpStatus('403 Forbidden');
				exit;
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
			if	( ! $this->obj->hasRight( ACL_WRITE ) )
			{
				Logger::debug('PUT failed, parent folder not writable by user' );
				$this->httpStatus('403 Forbidden');
				exit;
			}
			
			// Bestehende Datei ueberschreiben.
			$file = new File( $this->obj->objectid );
			$file->saveValue( $this->request );
			$file->setTimestamp();
			$this->httpStatus('204 No Content');
			Logger::debug('PUT ok, file is created' );
			exit;
		}
		elseif	( $this->obj->isFolder )
		{
			Logger::error('PUT on folder is not supported, use PROPFIND. Lame client?' );
			$this->httpStatus('405 Not Allowed' );
		}
		else
		{
			// Fuer andere Objekttypen (Links, Seiten) ist kein PUT moeglich.
			Logger::warn('PUT only available for files, pages and links are ignored' );
			$this->httpStatus('405 Not Allowed' );
		}
		exit;
	}
	
	

	/**
	 * WebDav-Methode PROPFIND.
	 * 
	 * Diese Methode wird
	 * - beim Ermitteln von Verzeichnisinhalten und
	 * - beim Ermitteln von Metainformationen zu einer Datei
	 * verwendet.
	 * 
	 * Das Ergebnis wird in einer XML-Zeichenkette geliefert.
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
				
				foreach( Project::getAll() as $projectid=>$projectName )
				{
					$project = new Project( $projectid );
					$rootObjectId = $project->getRootObjectId();
					$folder = new Folder( $rootObjectId );
					$folder->load();
					
					$objektinhalt = array();
					$z = 30*365.25*24*60*60;
					$objektinhalt['createdate'    ] = $z;
					$objektinhalt['lastchangedate'] = $folder->lastchangeDate;
					$objektinhalt['size'          ] = $project->size();
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
					Logger::trace( 'WEBDAV: PROPFIND of non-existent object');
					$this->httpStatus('404 Not Found');
					exit;
				}
				elseif	( $this->obj->isFolder )
				{
					if	( ! $this->obj->hasRight( ACL_READ ))
					{
						Logger::debug( 'Folder '.$this->obj->objectid.': access denied');
						$this->httpStatus('403 Forbidden');
					}
					
					$inhalte = array();

					$objektinhalt = array();
					$objektinhalt['createdate'    ] = $this->obj->createDate;
					$objektinhalt['lastchangedate'] = $this->obj->lastchangeDate;
					$objektinhalt['name'          ] = $this->fullSkriptName;
					$objektinhalt['displayname'   ] = basename($this->fullSkriptName);
					$objektinhalt['type'          ] = 'folder';
					$objektinhalt['size'          ] = 0;
					$inhalte[] = $objektinhalt;
					
					if	( $this->depth > 0 )
					{
						$objects = $this->folder->getObjects();
						foreach( $objects as $object  )
						{
							if	( ! $object->hasRight( ACL_READ ))
								continue;
							
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
									$objektinhalt['size'] = 0;
									$inhalte[] = $objektinhalt;
									break;
								case OR_TYPE_FILE:
									$objektinhalt['name'] = $this->fullSkriptName.$object->filename;
									$objektinhalt['type'] = 'file';
									$file = new File($object->objectid);
									$file->load();
									$objektinhalt['size'] = $file->size;
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
					Logger::trace( 'WEBDAV: PROPFIND-2');
					
//					if	( count($inhalte)==0 )
//						$inhalte[] = array('createdate'=>0,'lastchangedate'=>0,'name'=>'empty','size'=>0,'type'=>'file');
						
					Logger::trace('Anzahl Dateien:'.count($inhalte));
					$this->multiStatus( $inhalte );
				}
				else
				{
					$object = $this->obj;
					Logger::trace( 'WEBDAV: PROPFIND of file');
					$objektinhalt = array();
					$objektinhalt = array();
					$objektinhalt['name']           = $this->fullSkriptName.'/'.$object->filename.'/';
					$objektinhalt['displayname']    = $object->filename;
					$objektinhalt['createdate'    ] = $object->createDate;
					$objektinhalt['lastchangedate'] = $object->lastchangeDate;
					$file = new File( $this->obj->objectid );
					$file->load();
					$objektinhalt['size'          ] = $file->size;
					$objektinhalt['type'          ] = 'file';
					
					
					$this->multiStatus( array($objektinhalt) );
				}
				break;
				
			default:
				Logger::warn('Internal Error, unknown request type: '. $this->requestType);
				$this->httpStatus('500 Internal Server Error');
		}
		
		exit;
	}
	
	
	/**
	 * Webdav-Methode PROPPATCH ist nicht implementiert.
	 */
	function proppatch()
	{
		// TODO: Multistatus erzeugen.
		// Evtl. ist '409 Conflict' besser?
		$this->httpStatus('405 Not Allowed');
		exit;
	}
	
	
	/**
	 * Erzeugt einen Multi-Status.
	 * @access private
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
		Logger::trace('PROPFIND: '.$response);

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
		// Ergebnis initialisieren (damit alle Schlï¿½ssel vorhanden sind)
		$ergebnis = array('type'    => null,
		                  'project' => null,
		                  'path'    => array(),
		                  'folder'  => null,
		                  'object'  => null  );
		
		Logger::trace( 'WEBDAV: Parsen der URI '.$uri);
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
				Logger::trace("Projektname: ".$p->name);
				$p->loadByName();
				$ergebnis['project'] = $p;
				// Das Projekt hat weder Sprache noch Variante gesetzt.
				//Session::setProjectLanguage( new Language( $this->project->getDefaultLanguageId() ) );
				//Session::setProjectModel   ( new Model   ( $this->project->getDefaultModelId()    ) );

				$oid = $p->getRootObjectId();

				$f = new Folder($oid);
				$ergebnis['object'] = $f;
				$ergebnis['folder'] = $f;
			
			}
			else
			{
				if	( $ergebnis['object'] == null )
				{
					$this->httpStatus('409 Conflict');
					exit;
				}
				
				$oid = $f->getObjectIdByFileName($uriPart);

				if	( $oid == 0 )
				{
					Logger::trace( 'WEBDAV: URL-Part does not exist: '.$uriPart);
					$ergebnis['object'] = null;
				}
				else
				{
					Logger::trace( 'Teil '.$uriPart);
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

		return $ergebnis;
	 }
}



/**
 * Fehler-Handler fuer WEBDAV.<br>
 * Bei einem Laufzeitfehler ist eine Ausgabe des Fehlers auf der Standardausgabe sinnlos,
 * da der WebDAV-Client dies nicht lesen oder erkennen kann.
 * Daher wird der Fehler-Handler umgebogen, so dass nur ein Logeintrag sowie ein
 * Server-Fehler erzeugt wird.
 */
function webdavErrorHandler($errno, $errstr, $errfile, $errline) 
{
	Logger::warn('WEBDAV ERROR: '.$errno.'/'.$errstr.'/file:'.$errfile.'/line:'.$errline);

	// Wir teilen dem Client mit, dass auf dem Server was schief gelaufen ist.	
	WebdavAction::httpStatus('500 Internal Server Error, WebDAV-Request failed with "'.$errstr.'"');
}

?>