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
// Revision 1.13  2004-12-30 21:44:03  dankert
// Subaction-Wechsel speichern
//
// Revision 1.12  2004/12/26 21:57:16  dankert
// Feststellen, ob Request-Dauer ausgegeben werden soll
//
// Revision 1.11  2004/12/19 14:40:18  dankert
// neue Methode hasRequestVar()
//
// Revision 1.10  2004/12/15 23:22:26  dankert
// Konstanten, getRequestid()
//
// Revision 1.9  2004/11/29 21:08:13  dankert
// neue Methode hasRequestVar()
//
// Revision 1.8  2004/11/28 21:27:52  dankert
// addNotice()
//
// Revision 1.7  2004/11/27 13:05:37  dankert
// Einzelne Funktionen verlagert
//
// Revision 1.6  2004/11/10 22:35:23  dankert
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


	function hasRequestVar( $varName )
	{
		global $REQ;

		return( !empty($REQ[$varName]) );
	}


	function getRequestId()
	{
		return intval( $this->getRequestVar('id') );
	}



	function setTemplateVar( $varName,$value )
	{
		$this->templateVars[ $varName ] = $value;
	}


	function addNotice( $type,$name,$text,$status='ok' )
	{
		if	( !isset($this->templateVars['notices']) )
			$this->templateVars['notices'] = array();

		$this->templateVars['notices'][] = array('type'=>$type,
                                                 'name'=>$name,
		                                         'text'=>lang('NOTICE_'.$text),
		                                       'status'=>$status);
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
		global $conf;
		global $PHP_SELF;
		global $HTTP_SERVER_VARS;
		       
		$tplFileName = $tplName.'.tpl.'.PHP_EXT;
		$conf_php = PHP_EXT;
	
		// ?bertragen der Array-Variablen in den aktuellen Kontext
		//
		extract( $this->templateVars );
	
		// Setzen einiger Standard-Variablen
		//
		$tpl_dir    = OR_THEMES_DIR.$conf['interface']['theme'].'/templates/';
		$image_dir  = OR_THEMES_DIR.$conf['interface']['theme'].'/images/';
	
		$user = Session::getUser();
		if	( !is_object($user) )
			$stylesheet = OR_THEMES_DIR.$conf['interface']['theme'].'/css/default.css';
		else $stylesheet = OR_THEMES_DIR.$conf['interface']['theme'].'/css/'.$user->style.'.css';
		
		$self = $HTTP_SERVER_VARS['PHP_SELF'];
	
		$tplFileName = str_replace( '_','/',$tplFileName );
		$cms_title = OR_TITLE.' '.OR_VERSION;

		$showDuration = $conf['interface']['show_duration'];

		// Einbinden des Templates
		//
		require( 'themes/default/templates/'.$tplFileName );
		
		exit;
	}
	
	
	function callSubAction( $subActionName )
	{
		if	( in_array($this->actionName,array('page','file','link','folder')) )
			Session::setSubaction( $subActionName );		

		Logger::trace("next subaction is '$subActionName'");
		
		global $SESS;

		$this->$subActionName();
	}


	/**
	 * Verschieben eines Objektes
	 * @access protected
	 */
//	function move()
//	{
//		if   ( $this->getRequestVar('targetobjectid') != '' )
//		{
//			$o = new Object( $this->getSessionVar('objectid') );
//			
//			if	( $o->hasRight('prop') )
//				$o->setParentId( $this->getRequestVar('targetobjectid') );
//		}
//
//		$this->callSubAction('prop');
//	}


	/**
	 * Kopieren eines Objektes
	 * @access protected
	 */
//	function copy()
//	{
//		if   ( $this->getRequestVar('targetobjectid') != '' )
//		{
//			$o = new Object( $this->getSessionVar('objectid') );
//			
//			if	( $o->hasRight('prop') )
//				$o->setParentId( $this->getRequestVar('movetoobjectid') );
//
//			$o->name = lang('GLOBAL_COPY_OF').' '.$o->name;
//			$o->add();
//		}
//
//		$this->callSubAction('prop');
//	}


	/**
	 * Erzeugen einer Verknuepfung auf das aktuelle Objekt
	 * @access protected
	 */
//	function link()
//	{
//		$link = new Link();
//		$link->parentid       = $this->getRequestVar('targetobjectid');
//
//		$o = new Object( $this->getSessionVar('objectid') );
//		$o->load();
//		$link->linkedObjectId = $o->objectid;
//		$link->isLinkToObject = true;
//		$link->name           = lang('GLOBAL_LINK_TO').' '.$o->name;
//		$link->add();
//
//		$this->callSubAction('prop');
//	}




	/**
	 * Ermitteln, ob Benutzer Administratorrechte besitzt
	 * @return Boolean
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
}