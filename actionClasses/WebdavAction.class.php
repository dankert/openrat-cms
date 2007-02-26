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
	var $folder;
	var $filename;
	var $pathnames = array();
	var $uri;
	var $isFolder;
	var $isFile;
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
		Logger::debug( 'WEBDAV: Method '.$this->subActionName);
		
		$this->headers = getallheaders();

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
		
		
		$this->fullSkriptName = 'http://'.$_SERVER['HTTP_HOST'].'/'.$_SERVER['SCRIPT_NAME'].'/';	

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
					Logger::warn($this->project->name);
					$this->project->loadByName();
					
					$oid = $this->project->getRootObjectId();
					$this->folder = new Folder($oid);
				
					$this->fullSkriptName .= $uriPart.'/';	

					break;

				default:
					// URI='/project/a'
					// URI='/project/a/'
					
					$oid = $this->folder->getObjectIdByFileName($uriPart);
					$this->folder = new Folder($oid);

					$this->fullSkriptName .= $uriPart.'/';	
					
					break;
			}
		}
		
		$this->fullSkriptName .= $this->filename;	
		
//		Html::debug($this);
		
		foreach(getallheaders() as $k=>$v)
			Logger::debug( 'WEBDAV: REQ_HEADER_'.$k.'='.$v);

		$this->request  = implode('',file('php://input')); 
		Logger::debug( 'WEBDAV: REQ_BODY='.$this->request);
		
		Logger::debug('E super');
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
		header('DAV: 1');
		header('Allow: GET,PUT,PROPFIND');

		$this->httpStatus( '200 OK' );
		exit();
	}
	
	
	
	function httpStatus( $status = true )
	{
		if	( $status === true )
			$status = '200 OK';
			
		header('HTTP/1.1 '.$status);
		header('X-WebDAV-Status: '.$status,true);
	}
	
	
	
	function get()
	{
		if	( $this->isFolder )
			$this->getDirectory();
			
		$this->httpStatus( '200 OK' );
		
		// Verzeichnis ausgeben
		header('Content-Type: text/html');
		echo '<html><head><title>OpenRat WEBDAV Access</title></head>';
		echo '<body>';
		echo '<h1>OpenRat WEBDAV Access</h1>';
		echo '<pre>';
//		echo 'Testseite: '.$this->uri;
//		echo 'Pathname: '.$this->pathname;
//		echo 'Filename: '.$this->filename;
		echo '</pre>';
		echo '</body>';
		echo '</html>';
		
		exit;
	}
	
	
	
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
		
		
		
		/*
		die('GET not implemented');
		global $conf;
		global $PHP_AUTH_USER;
		global $PHP_AUTH_PW;

		$user = Session::getUser();

		// Seite ändert sich nur 1x pro Session
		$this->lastModified( $user->loginDate );

		$this->setTemplateVar( 'stylesheet',$user->style );
		$this->setTemplateVar( 'css_body_class','background' );

		$this->maxAge( 4*60*60 ); // 1 Stunde Browsercache
     		
		$this->forward( 'border' );
		*/
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


		
	function mkcol()
	{
		$this->httpStatus('405 Not Allowed, Not implemented');
		exit;
	}


		
	function delete()
	{
		$this->httpStatus('405 Not Allowed, Not implemented');
		exit;
	}


		
	function copy()
	{
		$this->httpStatus('405 Not Allowed, Not implemented');
		exit;
	}


		
	function move()
	{
		$this->httpStatus('405 Not Allowed, Not implemented');
		exit;
	}


		
	function put()
	{
		$this->httpStatus('405 Not Allowed, PUT not implemented');
		exit;
		
		global $conf;
		global $PHP_AUTH_USER;
		global $PHP_AUTH_PW;

		$user = Session::getUser();

		// Seite ändert sich nur 1x pro Session
		$this->lastModified( $user->loginDate );

		$this->setTemplateVar( 'stylesheet',$user->style );
		$this->setTemplateVar( 'css_body_class','background' );

		$this->maxAge( 4*60*60 ); // 1 Stunde Browsercache
     		
		$this->forward( 'border' );
	}
	
	
	
	function propfind()
	{
		Logger::debug( 'WEBDAV: PROPFIND');
		
		switch( $this->requestType )
		{
			case 'projectlist':
				$projects = array();
				foreach( Project::getAll() as $projectName )
					$projects[] = $this->fullSkriptName.'/'.$projectName;
					
				$this->multiStatus( $projects );
				break;

			case 'object':
			
//				$o = ObjectFactory::create($this->folder->objectid);
//
//				if	( $o->isFolder )
//				{
					$objects = $this->folder->getObjects();
					$inhalte = array();
					foreach( $objects as $object  )
						$inhalte[] = $this->fullScriptName.'/'.$object->filename.'/';
						
					$this->multiStatus( $inhalte );
//				}
//				else
//				{
//					$this->multiStatus( array($o->filename) );
//				}
				break;
				
			default:
				die('???:'.$this->requestType);
		}
	}
	
	
	function proppatch()
	{
		
		Logger::debug( 'WEBDAV: PROPPATCH');
		
		$this->httpStatus('405 Not Allowed, Not implemented');
		exit;
	}
	
	
	function multiStatus( $files )
	{
		$this->httpStatus('207 Multi-Status');
		header('Content-Type: text/xml; charset=utf-8');
		
		$response = '';
		$response .= '<?xml version="1.0" encoding="utf-8" ?>';
		$response .= '<d:multistatus xmlns:d="DAV:">';

		foreach( $files as $file )
			$response .= $this->getResponse( $file,array() );
		
		$response .= '</d:multistatus>';
		Logger::debug('PROPFIND-Ausgabe: '.$response);

		$response = utf8_encode($response);

		header('Content-Length: '.strlen($response));
		echo $response;
	}
	
	
	function getResponse( $file,$options )
	{
		$response = '';
		$response .= '<d:response>';
		$response .= '<d:href>'.$file.'</d:href>';
		$response .= '<d:propstat>';
		$response .= '<d:prop>';
//		$response .= '<d:source></d:source>';
		$response .= '<d:creationdate>1997-12-01T17:42:21-08:00</d:creationdate>';
		$response .= '<d:getlastmodified>1997-12-01T17:42:21-08:00</d:getlastmodified>';
		$response .= '<d:displayname>Dumpfbacke/</d:displayname>';
		
		$response .= '
		<d:creationdate>2003-03-16T19:28:51Z</d:creationdate>
		<d:displayname>Default</d:displayname><d:getcontentlength>9841152</d:getcontentlength>
		<d:getlastmodified xmlns:b="urn:uuid:c2f41010-65b3-11d1-a29f-00aa00c14882/" b:dt="dateTime.rfc1123">Sun, 16 Mar 2003 19:28:51 GMT</d:getlastmodified>
		<d:resourcetype><d:collection/></d:resourcetype><d:categories></d:categories><d:fields></d:fields>';
		
		
		
//		$response .= '<d:getcontenttype>text/html</d:getcontenttype>';
//		$response .= '<d:getcontentlength />';
//		$response .= '<d:getcontentlanguage />';
//		$response .= '<d:executable />';
//		$response .= '<d:resourcetype>';
//		$response .= '<d:collection />';
//		$response .= '</d:resourcetype>';
//		$response .= '<d:getetag />';

/*
		$response .= '<d:supportedlock>
 
<d:lockentry>
 
<d:lockscope><d:exclusive/></d:lockscope>
 
<d:locktype><d:write/></d:locktype>
 
</d:lockentry>
 
<d:lockentry>
 
<d:lockscope><d:shared/></d:lockscope>
 
<d:locktype><d:write/></d:locktype>
 
</d:lockentry>
 
</d:supportedlock>';
*/
		$response .= '</d:prop>';
		$response .= '<d:status>HTTP/1.1 200 OK</d:status>';
		$response .= '</d:propstat>';
		$response .= '</d:response>';

		return $response;		
	}
}



function webdavErrorHandler($errno, $errstr, $errfile, $errline) 
{
	Logger::warn($errno.'/'.$errstr.'/file:'.$errfile.'/line:'.$errline);
}

?>