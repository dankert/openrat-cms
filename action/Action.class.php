<?php
// OpenRat Content Management System
// Copyright (C) 2002-2012 Jan Dankert, cms@jandankert.de
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.


define('OR_NOTICE_OK'   ,'ok'     );
define('OR_NOTICE_WARN' ,'warning');
define('OR_NOTICE_ERROR','error'  );

define('OR_FILTER_ALPHA'   ,'abc'   );
define('OR_FILTER_ALPHANUM','abc123');
define('OR_FILTER_FILENAME','file'  );
define('OR_FILTER_MAIL'    ,'mail'  );
define('OR_FILTER_TEXT'    ,'text'  );
define('OR_FILTER_FULL'    ,'full'  );
define('OR_FILTER_NUMBER'  ,'123'   );
define('OR_FILTER_RAW'     ,'raw'   );
define('OR_FILTER_ALL'     ,'all'   );

class ObjectNotFoundException extends Exception {}

/**
 * Eltern-Klasse fuer alle Actions.
 *
 * Diese Klasse stellt grundlegende action-uebergreifende Methoden
 * bereit.
 * Dient als Ueberklasse fuer alle abgeleiteten Action-Klassen in
 * diesem Package bzw. Verzeichnis.
 *
 * @author Jan Dankert
 * @package openrat.actions
 * @abstract 
 */
class Action
{
	var $db;
	private $templateVars = Array();
	var $actionName;
	var $subActionName;
	var $actionClassName;

	var $writable;
	var $publishing;
	var $refresh;
	
	/**
	 * Aktuell angemeldeter Benutzer.<br>
	 * Wird ind er Funktion "init()" gesetzt.
	 *
	 * @var Object Benutzer
	 */
	var $currentUser;

	

	function setStyle( $style )
	{
		$this->setControlVar( "new_style", $style );
	}

	
	function nextView( $viewName )
	{
		$this->setControlVar( "next_view", $viewName );
	}

	
	

	/**
	 * Wird durch das Controller-Skript (do.php) nach der Kontruierung des Objektes aufgerufen.
	 * So koennen Unterklassen ihren eigenen Kontruktor besitzen, ohne den Superkontruktor
	 * (=diese Funktion) aufrufen zu m�ssen.
	 */
	function init()
	{
		global $conf;
		$this->writable    = !$conf['security']['readonly' ];
		$this->publishing  = !$conf['security']['nopublish'];
		$this->currentUser = Session::getUser();
		
		$this->templateVars['errors' ] = array();
		$this->templateVars['notices'] = array();
		$this->templateVars['control'] = array();
		$this->templateVars['output' ] = array();
		
		header('Content-Language: '.$conf['language']['language_code']);
		
		$this->refresh = false;
	}


	/**
	 * Liest eine Session-Variable
	 *
	 * @param String $varName Schl�ssel
	 * @return mixed
	 */
	protected function getSessionVar( $varName )
	{
		global $SESS;

		if	( !isset($SESS[ $varName ]) )
			return '';
		else	return $SESS[ $varName ];
	}


	/**
	 * Setzt eine Session-Variable
	 *
	 * @param Sring $varName Schl�ssel
	 * @param mixed $value Inhalt
	 * @return mixed
	 */
	protected function setSessionVar( $varName,$value )
	{
		global $SESS;

		$SESS[ $varName ] = $value;
	}


	/**
	 * Ermittelt den Inhalt der gew�nschten Request-Variablen.
	 * Falls nicht vorhanden, wird "" zur�ckgegeben.
	 *
	 * @param String $varName Schl�ssel
	 * @return String Inhalt
	 */
	protected function getRequestVar( $varName,$transcode=OR_FILTER_FULL )
	{
		global $REQ;

		if	( !isset($REQ[ $varName ]) )
			return '';
			
		
		switch( $transcode )
		{
			case OR_FILTER_ALPHA:
				$white = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
				break;
				
			case OR_FILTER_ALPHANUM:
				$white = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789.,_-!?%&/()';
				break;
				
			case OR_FILTER_FILENAME:
				// RFC 1738, Section 2.2:
				// Thus, only alphanumerics, the special characters "$-_.+!*'(),", and
				// reserved characters used for their reserved purposes may be used
				// unencoded within a URL.
				$white = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789$-_.+!*(),'."'";
				break;
				
			case OR_FILTER_MAIL:
				$white = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789._-@';
				break;

			case OR_FILTER_TEXT:
			case OR_FILTER_FULL:
			case OR_FILTER_ALL:
				// Ausfiltern von Control-Chars ( ASCII < 32 außer CR,LF) und HTML (<,>)
				$white = '';
				                                $white .= chr(10).chr(13); // Line-Feed, Carriage-Return
				for ($i =  32; $i <=  59; $i++) $white .= chr($i);  // Zahlen
												// 60: '<'
				                                $white .= chr(61);
												// 62: '>'
				for ($i =  63; $i <= 126; $i++) $white .= chr($i);  // abc
				for ($i = 128; $i <= 255; $i++) $white .= chr($i);  // Sonderzeichen incl. UTF-8, UTF-16 (beginnen mit Bit 1)
				break;
				
			case OR_FILTER_NUMBER:
				$white = '1234567890.';
				break;
				
			case OR_FILTER_RAW:
				return $REQ[ $varName ];
				
			default:
				Http::serverError('Unknown request filter','not found: '.$transcode);
				return '?';
		}
		
		$value  = $REQ[ $varName ];
		$newValue = Text::clean( $value, $white );
		
		if	( strlen($newValue) != strlen($value) )
			$this->addNotice('','','UNEXPECTED_CHARS',OR_NOTICE_WARN);
			
		return $newValue;
	}


	/**
	 * Ermittelt, ob der aktuelle Request eine Variable mit dem
	 * angegebenen Namen enth�lt.
	 *
	 * @param String $varName Schl�ssel
	 * @return boolean true, falls vorhanden.
	 */
	protected function hasRequestVar( $varName )
	{
		global $REQ;

		return( isset($REQ[$varName]) && (!empty($REQ[$varName]) || $REQ[$varName]=='0') );
	}


	/**
	 * Ermittelt die aktuelle Id aus dem Request.<br>
	 * Um welche ID es sich handelt, ist abh�ngig von der Action.
	 *
	 * @return Integer
	 */
	protected function getRequestId()
	{
		if	( $this->hasRequestVar('idvar') )
			return intval( $this->getRequestVar( $this->getRequestVar('idvar') ) );
		else
			return intval( $this->getRequestVar( REQ_PARAM_ID ) );
	}



	/**
	 * Setzt eine Variable f�r die Oberfl�che.
	 *
	 * @param String $varName Schl�ssel
	 * @param Mixed $value
	 */
	protected function setTemplateVar( $varName,$value )
	{
		$this->templateVars[ 'output' ][ $varName ] = $value;
	}


	/**
	 * Setzt eine Variable f�r die Oberfl�che.
	 *
	 * @param String $varName Schl�ssel
	 * @param Mixed $value
	 */
	protected function setControlVar( $varName,$value )
	{
		$this->templateVars[ 'control' ][ $varName ] = $value;
	}


	/**
	 * Setzt eine Liste von Variablen f�r die Oberfl�che.
	 *
	 * @param Array $varList Assoziatives Array
	 */
	protected function setTemplateVars( $varList )
	{
		foreach( $varList as $name=>$value )
		{
			$this->setTemplateVar( $name,$value );
		}
	}


	/**
	 * F�gt einen Validierungsfehler hinzu.
	 *
	 * @param String $name Name des validierten Eingabefeldes
	 * @param String Textschl�ssel der Fehlermeldung (optional)
	 */
	protected function addValidationError( $name,$message="COMMON_VALIDATION_ERROR",$vars=array(),$log=array() )
	{
		if	( !empty($message) )
			$this->addNotice('','',$message,OR_NOTICE_ERROR,$vars,$log);

		$this->templateVars['errors'][] = $name;
	}

	
	public function handleResult( $result )
	{
	    // TODO -
	}
	
	/**
	 * F�gt ein Meldung hinzu.
	 *
	 * @param String $type Typ des Objektes, zu dem diese Meldung geh�rt.
	 * @param String $name Name des Objektes, zu dem diese Meldung geh�rt.
	 * @param String $text Textschl�ssel der Fehlermeldung (optional)
	 * @param String $status Einer der Werte OR_NOTICE_(OK|WARN|ERROR)
	 * @param Array  $vars Variablen f�r den Textschl�ssel
	 * @param Array $log Weitere Hinweistexte f�r diese Meldung.
	 */
	protected function addNotice( $type,$name,$text,$status=OR_NOTICE_OK,$vars=array(),$log=array() )
	{
		if	( $status === true )
			$status = OR_NOTICE_OK;
		elseif	( $status === false )
			$status = OR_NOTICE_ERROR;

		$this->templateVars['notice_status'] = $status;
		$this->templateVars['status'       ] = $status;
		$this->templateVars['success'      ] = ($status==OR_NOTICE_ERROR?'false':'true');
		
		if	( $status == OR_NOTICE_OK && isset($_COOKIE['or_ignore_ok_notices']))
			return;
			
		if	( !is_array($log))
			$log = array($log);

		if	( !is_array($vars))
			$vars = array($vars);
			
		$this->templateVars['notices'][] = array('type'=>$type,
                                                 'name'=>$name,
		                                         'key'=>'NOTICE_'.$text,
		                                         'vars'=>$vars,
		                                         'text'=>lang('NOTICE_'.$text,$vars),
		                                         'log'=>$log,
		                                         'status'=>$status);
	}


	
	/**
	 * Ausgabe des Templates.<br>
	 * <br>
	 * Erst hier soll die Ausgabe auf die Standardausgabe, also die
	 * Ausgabe f�r den Browser, starten.<br>
	 * <br>
	 */
	public function forward()
	{
		Session::close();
		global $conf;
		
		$db = db_connection();

		if	( is_object( $db ) )
			$db->commit();
		
		// Ablaufzeit für den Inhalt auf aktuelle Zeit setzen.
		header('Expires: '.substr(date('r',time()-date('Z')),0,-5).'GMT',false );

		if	( $conf['security']['content-security-policy'] )
			header('X-Content-Security-Policy: '.'allow  \'self\'; img-src: *; script-src \'self\'; options inline-script');
		
		
		$httpAccept = getenv('HTTP_ACCEPT');
		$types = explode(',',$httpAccept);
		
		if	( version_compare(PHP_VERSION, '4.3.0', '>=') ) 
			Logger::trace('Output'."\n".print_r($this->templateVars,true));
		
		// Weitere Variablen anreichern.
		$this->templateVars['session'] = array('name'=>session_name(),'id'=>session_id(),'token'=>token() );
		$this->templateVars['version'] = OR_VERSION;
		$this->templateVars['api'    ] = '2';
		
		if	( sizeof($types)==1 && in_array('application/php-array',$types) || $this->getRequestVar('output')=='php-array' )
		{
			if	(version_compare(PHP_VERSION, '4.3.0', '<'))
				Http::serverError('application/php-array is only available with PHP >= 4.3');
				
			header('Content-Type: application/php-array; charset=UTF-8');
			echo print_r($this->templateVars,true);
			exit;
		}

		if	( sizeof($types)==1 && in_array('application/php-serialized',$types) || $this->getRequestVar('output')=='php' )
		{
			header('Content-Type: application/php-serialized; charset=UTF-8');
			echo serialize($this->templateVars);
			exit;
		}

		if	( sizeof($types)==1 && in_array('application/json',$types) || $this->getRequestVar('output')=='json' )
		{
			$json = new JSON();
			header('Content-Type: application/json; charset=UTF-8');
			if	( function_exists('json_encode'))
				// Native Methode ist schneller.. 
				echo json_encode( $this->templateVars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK | JSON_PARTIAL_OUTPUT_ON_ERROR );
			else
				// Fallback, falls json_encode() nicht existiert...
				echo $json->encode( $this->templateVars );
			exit;
		}

		if	( sizeof($types)==1 && in_array('application/xml',$types) || $this->getRequestVar('output')=='xml' )
		{
			require_once( OR_SERVICECLASSES_DIR."XML.class.".PHP_EXT );
			$xml = new XML();
			$xml->root = 'server'; // Name des XML-root-Elementes
			header('Content-Type: application/xml; charset=UTF-8');
			echo $xml->encode( $this->templateVars );
			exit;
		}

		header('Content-Type: text/html; charset=UTF-8');
		$this->setMenu();
		
		$tplName = $this->actionName.'/'.$this->subActionName;

			
// 		if	(isset($this->actionConfig[$this->subActionName]['target']))
// 			$targetSubActionName = $this->actionConfig[$this->subActionName]['target'];
// 		else
			$targetSubActionName = $this->subActionName;
		

		global $REQ;
		global $PHP_SELF;
		global $HTTP_SERVER_VARS;
		global $image_dir;
		global $view;
		       
		// Übertragen der Ausgabe-Variablen in den aktuellen Kontext
		//
		extract( $this->templateVars['output'] );

		// Setzen einiger Standard-Variablen
		//
		$tpl_dir    = OR_THEMES_DIR.$conf['interface']['theme'].'/pages/html/';
		$image_dir  = OR_THEMES_EXT_DIR.$conf['interface']['theme'].'/images/';
	
		$user = Session::getUser();
		
		$self = $HTTP_SERVER_VARS['PHP_SELF'];
	
		if	( !empty($conf['interface']['override_title']) )
			$cms_title = $conf['interface']['override_title'];
		else
			$cms_title = OR_TITLE.' '.OR_VERSION;

		$subActionName = $this->subActionName;
		$actionName    = $this->actionName;
		$requestId     = $this->getRequestId();
		
		if	( $conf['theme']['compiler']['enable'] )
		{
		    try
		    {
    			$te = new TemplateEngine();
    			$te->compile( $tplName );
    			unset($te);
		    }
		    catch (Exception $e)
		    {
		        throw new DomainException("Compilation failed for Template '$tplName'.",0,$e );
		    }
		}

		$iFile = FileUtils::getTempDir().'/'.'or.cache.tpl.'.str_replace('/', '.',$tplName).'.tpl.'.PHP_EXT;;
		header("X-CMS-Template-File: ".$iFile);
			
		if	( is_file($iFile))
			// Einbinden des Templates
			require_once( $iFile );
		else
		    throw new LogicException("File '$iFile' not found."); 
	}
	
	
	/**
	 * Ruft eine weitere Subaction auf.
	 *
	 * @param String $subActionName Name der n�chsten Subaction. Es muss eine Methode mit diesem Namen geben.
	 */
	protected function callSubAction( $subActionName )
	{
		return;
		
		/*
		 * 
		if	( in_array($this->actionName,array('page','file','link','folder')) )
			Session::setSubaction( $subActionName );

		$this->subActionName = $subActionName;		

		Logger::trace("next subaction is '$subActionName'");
		
		$this->$subActionName();
		 */
	}


	/**
	 * Ruft eine weitere Subaction auf.
	 *
	 * @param String $subActionName Name der n�chsten Subaction. Es muss eine Methode mit diesem Namen geben.
	 */
	protected function nextSubAction( $subActionName )
	{
		$this->subActionName = $subActionName;		

		Logger::trace("next subaction is '$subActionName'");
		
		$methodName = $subActionName.($_SERVER['REQUEST_METHOD'] == 'POST'?'Post':'View');
		$this->$methodName();
	}


	/**
	 * Ermitteln, ob Benutzer Administratorrechte besitzt
	 * @return Boolean TRUE, falls der Benutzer ein Administrator ist.
	 */
	protected function userIsAdmin()
	{
		$user = Session::getUser();
		return is_object($user) && $user->isAdmin;
	}
	

	/**
	 * Ermitteln, ob Benutzer Administratorrechte besitzt
	 * @return Boolean TRUE, falls der Benutzer ein Administrator ist.
	 */
	public function userIsLoggedIn()
	{
		$user = Session::getUser();
		return is_object($user) && $user->isAdmin;
	}
	

	/**
	 * Ermitteln des Benutzerobjektes aus der Session
	 * @return User
	 */
	protected function getUserFromSession()
	{
		return Session::getUser();
	}


	
	/**
	 * Benutzen eines sog. "Conditional GET".
	 *
	 * Diese Funktion setzt einen "Last-Modified"-HTTP-Header.
	 * Ist der Inhalt der Seite nicht neuer, so wird der Inhalt
	 * der Seite nicht ausgegeben, sondern nur HTTP-Status 304
	 * ("304 not modified") gesetzt.
	 * Der Rest der Seite muss dann nicht mehr erzeugt werden,
	 * wodurch die Performance stark erhoeht werden kann.
	 *
	 * Credits: Danke an Charles Miller
	 * @see http://fishbowl.pastiche.org/2002/10/21/http_conditional_get_for_rss_hackers
	 *
	 * Gefunden auf:
	 * @see http://simon.incutio.com/archive/2003/04/23/conditionalGet
	 *
	 * @param Timestamp Letztes Aenderungsdatum des Objektes
	 */
	protected function lastModified( $time, $expirationDuration = 0 )
	{
		$user = Session::getUser();

		// Conditional-Get eingeschaltet?
		if	( ! config('cache','conditional_get') )
			return;

		$expires      = substr(date('r',time()+$expirationDuration-date('Z')),0,-5).'GMT';
		$lastModified = substr(date('r',$time -date('Z')),0,-5).'GMT';
		$etag         = '"'.base_convert($time,10,36).'"';

		// Header senden
		header('Expires: '      .$expires      );
		header('Last-Modified: '.$lastModified );
		header('ETag: '         .$etag         );
		
		// Die vom Interpreter sonst automatisch gesetzten
		// Header uebersteuern
		header('Cache-Control: must-revalidate');
		header('Pragma:');

		// See if the client has provided the required headers
		$if_modified_since = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? stripslashes($_SERVER['HTTP_IF_MODIFIED_SINCE']) : false;
		$if_none_match     = isset($_SERVER['HTTP_IF_NONE_MATCH']    ) ? stripslashes($_SERVER['HTTP_IF_NONE_MATCH']    ) :	false;

		// Bug in Apache 2.2, mod_deflat adds '-gzip' to E-Tag
		if    ( substr($if_none_match,-6) == '-gzip"' )
		    $if_none_match = substr($if_none_match,0,-6).'"';
		
		// At least one of the headers is there - check them
		if	( $if_none_match && $if_none_match != $etag )
			return; // etag is there but doesn't match

		if	( $if_modified_since && $if_modified_since != $lastModified )
			return; // if-modified-since is there but doesn't match
		
		if	( !$if_modified_since && !$if_none_match )
			return;

		// Der entfernte Browser bzw. Proxy holt die Seite nun aus seinem Cache 
		header('HTTP/1.0 304 Not Modified');
		exit;  // Sofortiges Skript-Ende
	}



	/**
	 * @param max Anzahl der Sekunden, die die Seite im Browsercache bleiben darf
	 */
	protected function maxAge( $max=3600 ) 
	{
		// Die Header "Last-Modified" und "ETag" wurden bereits in der
		// Methode "lastModified()" gesetzt.
		
		header('Expires: '.substr(date('r',time()-date('Z')+$max),0,-5).'GMT' );
		header('Pragma: '); // 'Pragma' ist Bullshit und
		                    // wird von den meisten Browsern ignoriert.
		header('Cache-Control: public, max-age='.$max.", s-maxage=".$max);
	}	
	
	
	
	protected function setMenu()
	{
		return;
		
		$windowMenu = array();
		$name       = $this->actionConfig[$this->subActionName]['menu'];
		$menuList   = explode(',',$this->actionConfig['menu']['menu']);
		//$menuList   = explode(',',$this->actionConfig['menu'][$name]);
		
		if	( isset($this->actionConfig[$this->subActionName]['menuaction']))
			$actionName = $this->actionConfig[$this->subActionName]['menuaction'];
		else
			$actionName = $this->subActionName;
		
		foreach( $menuList as $menuName )
		{
			if	( isset($this->actionConfig[$menuName]['alias']) )
				$menuText = 'menu_'.$this->actionName.'_'.$this->actionConfig[$menuName]['alias'];
			else
				$menuText = 'menu_'.$this->actionName.'_'.$menuName;
			
			
			$menuKey = 'accesskey_window_'.$menuName;
			
			$menuEntry = array('subaction'=>$menuName,
                               'text'     =>$menuText,
                               'title'    =>$menuText.'_DESC',
                               'key'      =>$menuKey );
                               
			if	( $this->checkMenu($menuName) )
				$menuEntry['url'] = Html::url($actionName,$menuName,$this->getRequestId());
				
			$windowMenu[] = $menuEntry;
		}
		$this->setTemplateVar('windowMenu',$windowMenu);
	}
	
	
	
	/**
	 * Ermittelt, ob der Men�punkt aktiv ist.
	 * Ob ein Men�punkt als aktiv angezeigt werden soll, steht meist erst zur Laufzeit fest.
	 * <br>
	 * Diese Methode kann von den Unterklassen �berschrieben werden.
	 * Falls diese Methode nicht �berschrieben wird, sind alle Men�punkte aktiv.
	 *
	 * @param String $name Logischer Name des Men�punktes
	 * @return boolean TRUE, wenn Men�punkt aktiv ist.
	 */
	protected function checkMenu( $name )
	{
		// Standard: Alle Men�punkt sind aktiv.
		return true;
	}
	
	
	
	/**
	 * Stellt fest, ob die Anzeige dieser Aktion editierbar ist.
	 * 
	 * @return boolean
	 * @deprecated
	 */
	function isEditable()
	{
		return false; 
	}

	
	/**
	 * Erzeugt einen Redirect auf einen bestimmte URL.
	 */
	protected function redirect( $url )
	{
		$this->setControlVar( 'redirect',$url );
	}
	
	
	/**
	 * Sorgt dafür, dass alle anderen Views aktualisiert werden.
	 * 
	 * Diese Methode sollte dann aufgerufen werden, wenn Objekte geändert werden
	 * und dies Einfluss auf andere Views hat.
	 */
	protected function refresh()
	{
		$this->refresh = true;
		$this->setControlVar('refresh',true);
	}
	
	
	/**
	 * Stellt fest, ob sich die Anzeige im Editier-Modus befindet.
	 *
	 * @return boolean
	 * @deprecated
	 */
	protected function isEditMode()
	{
		return true;
	}
	
	
	
	/**
	 * Setzt eine neue Perspektive für die Sitzung.
	 * 
	 * @param String Name der Perspektive
	 */
	protected function setPerspective( $name )
	{
		Session::set('perspective',$name);
		$this->refresh();
	}
}


// TODO - nicht benutzt
interface ActionResult
{
    public function getErrorField();
    public function isSuccess();
}

class ActionResultSuccess implements ActionResult
{
    public function isSuccess(){
        return true;
    }
    public function getErrorField(){
        return null;
    }
}
class ActionResultError implements ActionResult
{
    private $fieldName;
    
    public function __construct( $name )
    {
        $this->fieldName = $name;
    }
    public function isSuccess(){
        return false;
    }
    public function getErrorField(){
        return $fieldName;
    }
}


?>