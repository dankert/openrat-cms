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
// ---------------------------------------------------------------------------
// $Log$
// Revision 1.6  2004-11-10 22:35:23  dankert
// Unbenennen einzelner Methoden
//
// Revision 1.5  2004/10/10 17:42:52  dankert
// Neue Methode: getUserFromSession()
//
// Revision 1.4  2004/10/04 19:58:05  dankert
// Logging hinzugef?gt
//
// Revision 1.3  2004/05/02 14:49:37  dankert
// Einf?gen package-name (@package)
//
// Revision 1.2  2004/04/30 20:31:57  dankert
// Berechtigung: freigeben
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


/**
 * Eltern-Klasse fuer alle Actions.
 *
 * Diese Klasse stellt grundlegende action-uebergreifende Methoden
 * bereit.
 * Dienst als Ueberklasse fuer alle abgeleiteten Action-Klassen in
 * diesem Package bzw. Verzeichnis.
 *
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */
class Action
{
	var $db;
	var $templateVars = Array();
	var $actionName;
	var $subActionName;


	function Action()
	{
		global $SESS;
//		if	( $SESS['action'] != 'login')
//			$db = db_connection();
	}


	function getSessionVar( $varName )
	{
		global $SESS;

		if	( !isset($SESS[ $varName ]) )
			return '';
		else	return $SESS[ $varName ];
	}


	function setSessionVar( $varName,$value )
	{
		global $SESS;

		$SESS[ $varName ] = $value;
	}


	function getRequestVar( $varName )
	{
		global $REQ;

		if	( !isset($REQ[ $varName ]) )
			return '';
		else	return $REQ[ $varName ];
	}


	function setTemplateVar( $varName,$value )
	{
		$this->templateVars[ $varName ] = $value;
	}


	function setTemplateVars( $varList )
	{
		foreach( $varList as $name=>$value )
		{
			$this->setTemplateVar( $name,$value );
		}
	}


	function message( $title='ERROR',$add_info='' )
	{
		Logger::warn( 'creating error message, info='.$add_info );

		$this->setTemplateVar( 'title',lang( $title         ) );
		$this->setTemplateVar( 'text' ,lang( $title.'_DESC' ) );
		$this->setTemplateVar( 'info' ,$add_info );
		
		$this->forward('message');
	}


	/** Ausgabe des Templates
	 *
	 * Es wird das gew?nschte Template auf die Standardausgabe
	 * ausgegeben.
	 *
	 * @param String Dateiname des Templates
	 */
	function forward( $tplName )
	{
		global $title,
		       $cms_name,
		       $cms_version,
		       $PHP_SELF,
		       $SESS,
		       $HTTP_SERVER_VARS,
		       $cms_title,
		       $conf_php,
		       $conf_themedir;
		       
//		$tpl .= $this->actionName-'_'.$this->subActionName.'.tpl.'.$conf_php;
		$tplFileName = $tplName.'.tpl.'.$conf_php;
	
		// ?bertragen der Array-Variablen in den aktuellen Kontext
		//
		extract( $this->templateVars );
	
		// Setzen einiger Standard-Variablen
		//
		$tpl_dir    = $conf_themedir.'/templates/';
		$image_dir  = $conf_themedir.'/images/';
	
		if   ( !isset($SESS['user']) || $SESS['user']['style']=='')
			 $stylesheet = $conf_themedir.'/css/default.css';
		else $stylesheet = $conf_themedir.'/css/'.$SESS['user']['style'].'.css';
		
		$self = $HTTP_SERVER_VARS['PHP_SELF'];
	
		// Einbinden des Templates
		//
		require( 'themes/default/templates/'.$tplFileName );
		
		exit;
	}
	
	
	function callSubAction( $subActionName )
	{
		//global $conf;
		//if	( strtoupper($conf['log']['level']) == 'TRACE' )
		
		Logger::trace("next subaction is '$subActionName'");
		
		global $SESS;
		
		$SESS[ $this->actionName.'action' ] = $subActionName;

		$this->$subActionName();
	}


	/**
	 * Verschieben eines Objektes
	 * @access protected
	 */
	function move()
	{
		if   ( $this->getRequestVar('targetobjectid') != '' )
		{
			$o = new Object( $this->getSessionVar('objectid') );
			
			if	( $o->hasRight('prop') )
				$o->setParentId( $this->getRequestVar('targetobjectid') );
		}

		$this->callSubAction('prop');
	}


	/**
	 * Kopieren eines Objektes
	 * @access protected
	 */
	function copy()
	{
		if   ( $this->getRequestVar('targetobjectid') != '' )
		{
			$o = new Object( $this->getSessionVar('objectid') );
			
			if	( $o->hasRight('prop') )
				$o->setParentId( $this->getRequestVar('movetoobjectid') );

			$o->name = lang('GLOBAL_COPY_OF').' '.$o->name;
			$o->add();
		}

		$this->callSubAction('prop');
	}


	/**
	 * Erzeugen einer Verknuepfung auf das aktuelle Objekt
	 * @access protected
	 */
	function link()
	{
		$link = new Link();
		$link->parentid       = $this->getRequestVar('targetobjectid');

		$o = new Object( $this->getSessionVar('objectid') );
		$o->load();
		$link->linkedObjectId = $o->objectid;
		$link->isLinkToObject = true;
		$link->name           = lang('GLOBAL_LINK_TO').' '.$o->name;
		$link->add();

		$this->callSubAction('prop');
	}


	/**
	  * ACL zu einem Objekt setzen
	  * @access protected
	  */
	function addACL()
	{
		$acl = new Acl();

		$acl->objectid = $this->getSessionVar('objectid');
		
		if   ( $this->getRequestVar('type') == 'user' )
			$acl->userid  = $this->getRequestVar('userid' );
		else	$acl->groupid = $this->getRequestVar('groupid');

		$acl->languageid    = $this->getRequestVar('languageid');

		$acl->write         = ( $this->getRequestVar('write'        ) != '' );
		$acl->prop          = ( $this->getRequestVar('prop'         ) != '' );
		$acl->delete        = ( $this->getRequestVar('delete'       ) != '' );
		$acl->release       = ( $this->getRequestVar('release'      ) != '' );
		$acl->publish       = ( $this->getRequestVar('publish'      ) != '' );
		$acl->create_folder = ( $this->getRequestVar('create_folder') != '' );
		$acl->create_file   = ( $this->getRequestVar('create_file'  ) != '' );
		$acl->create_link   = ( $this->getRequestVar('create_link'  ) != '' );
		$acl->create_page   = ( $this->getRequestVar('create_page'  ) != '' );
		$acl->grant         = ( $this->getRequestVar('grant'        ) != '' );
		$acl->transmit      = ( $this->getRequestVar('transmit'     ) != '' );

		$acl->add();
		
		$this->callSubAction('rights');
	}


	function rights()
	{
		$o = new Object( $this->getSessionVar('objectid') );

		global $SESS;
		global $conf_php;
		if   ($SESS['user']['is_admin'] != '1') die('nice try');

		$acllist = array();	
		foreach( $this->folder->getAllInheritedAclIds() as $aclid )
		{
			$acl = new Acl( $aclid );
			$acl->load();
			$key = 'au'.$acl->username.'g'.$acl->groupname.'a'.$aclid;
			$acllist[$key] = $acl->getProperties();
		}

//		$this->setTemplateVar('inherited_acls',$acllist );
//		$acllist = array();	

		foreach( $this->folder->getAllAclIds() as $aclid )
		{
			$acl = new Acl( $aclid );
			$acl->load();
			$key = 'bu'.$acl->username.'g'.$acl->groupname.'a'.$aclid;
			$acllist[$key] = $acl->getProperties();
			$acllist[$key]['delete_url'] = Html::url(array('subaction'=>'delACL','aclid'=>$aclid));
		}
		ksort( $acllist );

		$this->setTemplateVar('acls',$acllist );

		$this->setTemplateVar('users'    ,User::listAll()   );
		$this->setTemplateVar('groups'   ,Group::getAll()   );

		$languages = Language::getAll();
		$languages[0] = lang('ALL_LANGUAGES');
		$this->setTemplateVar('languages',$languages);

		$this->forward('object_rights');
	}


	/**
	 * Ermitteln, ob Benutzer Administratorrechte besitzt
	 * @return Boolean
	 */
	function userIsAdmin()
	{
		$user = $this->getSessionVar('user');
		if	( $user['is_admin'] )
			return true;
		else	return false;
	}



	/**
	 * Ermitteln des Benutzerobjektes aus der Session
	 * @return User
	 */
	function getUserFromSession()
	{
		return $this->getSessionVar('userobject');
	}



	/**
	 * Entfernen einer ACL
	 * @access protected
	 */
	function delACL()
	{
		$acl = new Acl( $this->getRequestVar('aclid') );
		$acl->delete();

		$this->callSubAction('rights');
	}
}