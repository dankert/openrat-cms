<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// OpenRat Content Management System
// Copyright (C) 2002-2004 Jan Dankert, cms@jandankert.de
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
	var $templateVars = Array();
	var $actionName;
	var $subActionName;
	var $actionClassName;

	var $writable;
	var $publishing;
	var $actionConfig;
	
	/**
	 * Aktuell angemeldeter Benutzer.<br>
	 * Wird ind er Funktion "init()" gesetzt.
	 *
	 * @var Object Benutzer
	 */
	var $currentUser;


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

		if	( !$this->isEditable() || isset($_COOKIE['or_always_edit']) )
			$this->templateVars['mode'] = 'edit';
		else 
			$this->templateVars['mode'] = $this->getRequestVar('mode');
		
		header('Content-Language: '.$conf['language']['language_code']);
	}


	/**
	 * Liest eine Session-Variable
	 *
	 * @param String $varName Schl�ssel
	 * @return mixed
	 */
	function getSessionVar( $varName )
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
	function setSessionVar( $varName,$value )
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
	function getRequestVar( $varName,$transcode=OR_FILTER_FULL )
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
	function hasRequestVar( $varName )
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
	function getRequestId()
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
	function setTemplateVar( $varName,$value )
	{
		$this->templateVars[ $varName ] = $value;
	}


	/**
	 * Setzt eine Liste von Variablen f�r die Oberfl�che.
	 *
	 * @param Array $varList Assoziatives Array
	 */
	function setTemplateVars( $varList )
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
	function addValidationError( $name,$message="COMMON_VALIDATION_ERROR",$vars=array(),$log=array() )
	{
		if	( !empty($message) )
			$this->addNotice('','',$message,OR_NOTICE_ERROR,$vars,$log);

		$this->templateVars['errors'][] = $name;
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
	function addNotice( $type,$name,$text,$status=OR_NOTICE_OK,$vars=array(),$log=array() )
	{
		if	( $status === true )
			$status = OR_NOTICE_OK;
		elseif	( $status === false )
			$status = OR_NOTICE_ERROR;

		$this->templateVars['notice_status'] = $status;
		
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
	 *
	 * @param String Wird nicht benutzt!
	 */
	function forward()
	{
		$db = db_connection();

		if	( isset($this->actionConfig[$this->subActionName]['direct']) )
		{
			if	( is_object( $db ) )
				$db->commit();
			exit; // Die Ausgabe ist bereits erfolgt (z.B. Bin�rdateien o. WebDAV)
		}
			
		// Pruefen, ob HTTP-Header gesendet wurden. Dies deutet stark darauf hin, dass eine
		// PHP-Fehlermeldung ausgegeben wurde. In diesem Fall wird hier abgebrochen.
		// Weitere Ausgabe wuerde keinen Sinn machen, da wir nicht wissen, was
		// passiert ist.
		if	( headers_sent() )
		{
			Http::serverError("Some server error messages occured - see above - CMS canceled.");
		}
		
		if	( is_object( $db ) )
			$db->commit();
		
		$expires = substr(gmdate('r'),0,-5).'GMT';
		header('Expires: '      .$expires );
		
		header('X-Content-Security-Policy: '.'allow *; script-src \'self\'; options \'inline-script\'');
		
		
		$httpAccept = getenv('HTTP_ACCEPT');
		$types = explode(',',$httpAccept);
		
		if	( version_compare(PHP_VERSION, '4.3.0', '>=') ) 
			Logger::trace('Output'."\n".print_r($this->templateVars,true));
		
		// Weitere Variablen anreichern.
		$this->templateVars['session'] = array('name'=>session_name(),'id'=>session_id(),'token'=>token() );
		$this->templateVars['version'] = OR_VERSION;
		
		if	( sizeof($types)==1 && in_array('application/php-array',$types) || $this->getRequestVar('output')=='php-array' )
		{
			if	(version_compare(PHP_VERSION, '4.3.0', '<'))
				Http::serverError('application/php-array is only available with PHP >= 4.3');
				
			header('Content-Type: application/php-array');
			echo print_r($this->templateVars,true);
			exit;
		}

		if	( sizeof($types)==1 && in_array('application/php-serialized',$types) || $this->getRequestVar('output')=='php' )
		{
			header('Content-Type: application/php-serialized');
			serialize($this->templateVars);
			exit;
		}

		if	( sizeof($types)==1 && in_array('application/json',$types) || $this->getRequestVar('output')=='json' )
		{
			require_once( OR_SERVICECLASSES_DIR."JSON.class.".PHP_EXT );
			$json = new JSON();
			header('Content-Type: application/json');
			echo $json->encode( $this->templateVars );
			exit;
		}

		if	( sizeof($types)==1 && in_array('application/xml',$types) || $this->getRequestVar('output')=='xml' )
		{
			require_once( OR_SERVICECLASSES_DIR."XML.class.".PHP_EXT );
			$xml = new XML();
			$xml->root = 'server'; // Name des XML-root-Elementes
			header('Content-Type: application/xml');
			echo $xml->encode( $this->templateVars );
			exit;
		}

		$this->setMenu();
		
		$tplName = $this->actionName.'/'.$this->subActionName;

			
		if	( isset($this->actionConfig[$this->subActionName]['action']) )
			$tplName = $this->actionConfig[$this->subActionName]['action'].'/'.$this->subActionName;

		if	(isset($this->actionConfig[$this->subActionName]['alias']))
			$tplName = (method_exists(new ObjectAction(),$this->subActionName)?'object':$this->actionName).'/'.$this->actionConfig[$this->subActionName]['alias'];
			
		if	(isset($this->actionConfig[$this->subActionName]['target']))
			$targetSubActionName = $this->actionConfig[$this->subActionName]['target'];
		else
			$targetSubActionName = $this->subActionName;
		

		if	( isset($this->actionConfig[$this->subActionName]['menu']))
			$windowTitle = 'menu_title_'.$this->actionName.'_'.$this->actionConfig[$this->subActionName]['menu'];

		global $conf;
		global $REQ;
		global $PHP_SELF;
		global $HTTP_SERVER_VARS;
		global $image_dir;
		       
		$tplName = str_replace( '_','/',$tplName );
		
		$tplFileName = $tplName.'.tpl.'.PHP_EXT;
		$conf_php = PHP_EXT;
	
		// ?bertragen der Array-Variablen in den aktuellen Kontext
		//
		extract( $this->templateVars );

		// Falls Eingabefehler, dann Uebertragen der Request-Variablen in den aktuellen Kontext
		if	( count($errors)>0 )
			foreach( $REQ as $requestVar=>$dummy )
				if	( !isset($$requestVar) )
					// Aber achtung, hier geben wir die Request-Variablen einfach so wieder raus!
					$$requestVar = $this->getRequestVar( $requestVar );
				
		// Setzen einiger Standard-Variablen
		//
		$tpl_dir    = OR_THEMES_DIR.$conf['interface']['theme'].'/pages/html/';
		$image_dir  = OR_THEMES_EXT_DIR.$conf['interface']['theme'].'/images/';
	
		$user = Session::getUser();
		
		$root_stylesheet = OR_THEMES_EXT_DIR.$conf['interface']['theme'].'/css/base.css';
			
		if	( !is_object($user) )
			$user_stylesheet = OR_THEMES_EXT_DIR.$conf['interface']['theme'].'/css/'.$conf['interface']['style']['default'].'.css';
		else
			$user_stylesheet = OR_THEMES_EXT_DIR.$conf['interface']['theme'].'/css/'.$user->style.'.css';
		
		$self = $HTTP_SERVER_VARS['PHP_SELF'];
	
		$tplFileName = str_replace( '_','/',$tplFileName );

		if	( !empty($conf['interface']['override_title']) )
			$cms_title = $conf['interface']['override_title'];
		else
			$cms_title = OR_TITLE.' '.OR_VERSION;

		$charset = $this->getCharset();
			
		$showDuration = $conf['interface']['show_duration'];

		$subActionName = $this->subActionName;
		$actionName    = $this->actionName;
		$requestId     = $this->getRequestId();
		
		if	( $conf['theme']['compiler']['enable'] )
		{
			$te = new TemplateEngine();
			$te->compile( $tplName );
			unset($te);
		}

		// Einbinden des Templates
		require( $tpl_dir.$tplFileName );
		
	}
	
	
	/**
	 * Ruft eine weitere Subaction auf.
	 *
	 * @param String $subActionName Name der n�chsten Subaction. Es muss eine Methode mit diesem Namen geben.
	 */
	function callSubAction( $subActionName )
	{
		if	( in_array($this->actionName,array('page','file','link','folder')) )
			Session::setSubaction( $subActionName );

		$this->subActionName = $subActionName;		

		Logger::trace("next subaction is '$subActionName'");
		
		$this->$subActionName();
	}


	/**
	 * Ermitteln, ob Benutzer Administratorrechte besitzt
	 * @return Boolean TRUE, falls der Benutzer ein Administrator ist.
	 */
	function userIsAdmin()
	{
		$user = Session::getUser();
		return $user->isAdmin;
	}



	/**
	 * Ermitteln des Benutzerobjektes aus der Session
	 * @return User
	 */
	function getUserFromSession()
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
	 * Ggf. kann das Benutzen dieses Mechanismus zu unerw�nschten
	 * Effekten f�hren, dann muss "conditional GET" in der
	 * Konfiguration deaktiviert werden.
	 *
	 * Credits: Danke an Charles Miller
	 * @see http://fishbowl.pastiche.org/2002/10/21/http_conditional_get_for_rss_hackers
	 *
	 * Gefunden auf:
	 * @see http://simon.incutio.com/archive/2003/04/23/conditionalGet
	 *
	 * @param Timestamp Letztes Aenderungsdatum dieser Seite
	 */
	function lastModified( $time )
	{
		$user = Session::getUser();
		if	( $user->loginDate > $time && !isset($this->actionConfig[$this->subActionName]['direct']) )
			// Falls Benutzer-Login nach letzter �nderung.
			// Zweck: Nach einem Login sollte mind. 1x jede Seite neu geladen werden, dies
			// Ist z.B. nach einer Style-�nderung durch den Benutzer notwendig.
			// Falls aus Versehen doch einmal zuviel gecacht wurde, kann man das durch ein
			// Neu-Login beheben. 
			$time = $user->loginDate;

		// Conditional-Get eingeschaltet?
		global $conf;
		if	( ! $conf['cache']['conditional_get'] )
			return;

		$lastModified = substr(date('r',$time -date('Z')),0,-5).'GMT';
		$etag         = '"'.md5($lastModified).'"';

		// Header senden
		header('Last-Modified: '.$lastModified );
		header('ETag: '         .$etag         );
		
		// Die vom Interpreter sonst automatisch gesetzten
		// Header uebersteuern
		header('Cache-Control: must-revalidate');
		header('Pragma:');

		// See if the client has provided the required headers
		$if_modified_since = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? stripslashes($_SERVER['HTTP_IF_MODIFIED_SINCE']) : false;
		$if_none_match     = isset($_SERVER['HTTP_IF_NONE_MATCH']    ) ? stripslashes($_SERVER['HTTP_IF_NONE_MATCH']    ) :	false;

		if	( !$if_modified_since && !$if_none_match )
			return;

		// At least one of the headers is there - check them
		if	( $if_none_match && $if_none_match != $etag )
			return; // etag is there but doesn't match


		if	( $if_modified_since && $if_modified_since != $lastModified )
			return; // if-modified-since is there but doesn't match

		// Der entfernte Browser bzw. Proxy holt die Seite nun aus seinem Cache 
		header('HTTP/1.0 304 Not Modified');
		exit;  // Sofortiges Skript-Ende
	}



	/**
	 * @param max Anzahl der Sekunden, die die Seite im Browsercache bleiben darf
	 */
	function maxAge( $max=3600 ) 
	{
		// Die Header "Last-Modified" und "ETag" wurden bereits in der
		// Methode "lastModified()" gesetzt.
		
		header('Expires: '.substr(date('r',time()-date('Z')+$max),0,-5).'GMT' );
		header('Pragma: '); // 'Pragma' ist Bullshit und
		                    // wird von den meisten Browsern ignoriert.
		header('Cache-Control: public, max-age='.$max.", s-maxage=".$max);
	}	
	
	
	
	function setMenu()
	{
		if	(!isset($this->actionConfig[$this->subActionName]['menu']))
			return;
		$windowMenu = array();
		$name       = $this->actionConfig[$this->subActionName]['menu'];
		$menuList   = explode(',',$this->actionConfig['menu'][$name]);

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
			
//			Logger::trace("testing menu $menuName");
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
	function checkMenu( $name )
	{
		// Standard: Alle Men�punkt sind aktiv.
		return true;
	}
	
	
	
	/**
	 * Ermitelt den Zeichensatz fuer die Ausgabe.
	 * 
	 * Falls für die Datenbank-Verbindung ein Zeichensatz angegeben ist, so wird
	 * dieser genommen und in HTTP-Response-Header sowieso auch im HTML-Kopf verwendet.
	 * 
	 * Falls nicht vorhanden, wird der Zeichensatz aus der geladenen Sprachdatei verwendet. Diese
	 * ergibt sich dann aus der Sprache, die der Browser anfordert. 
	 *
	 * @return String Zeichensatz
	 */
	function getCharset()
	{
		$db = db_connection();
		
		if	( isset($db->conf['charset']) )
			return $db->conf['charset'];
		else
			return lang('CHARSET');
	}
	
	
	/**
	 * Stellt fest, ob die Anzeige dieser Aktion editierbar ist.
	 *
	 * @return boolean
	 */
	function isEditable()
	{
		return isset($this->actionConfig[$this->subActionName]['editable']) && $this->actionConfig[$this->subActionName]['editable']; 
	}

	
	/**
	 * Stellt fest, ob sich die Anzeige im Editier-Modus befindet.
	 *
	 * @return boolean
	 */
	function isEditMode()
	{
		if	( readonly() )
			return false;
			
		return !$this->isEditable() || $this->getRequestVar('mode')=='edit' || isset($_COOKIE['or_always_edit']) || (isset($this->templateVars) && $this->templateVars['mode']=='edit'); 
	}
}

?>