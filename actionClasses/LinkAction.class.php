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
// Revision 1.2  2004-04-30 20:31:47  dankert
// Berechtigungen anzeigen
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


/**
 * Action-Klasse für Verknüpfungen
 * @version $Id$
 * @author $Author$
 */
class LinkAction extends Action
{
	var $link;
	var $defaultSubAction = 'prop';

	/**
	 * Konstruktor
	 */
	function LinkAction()
	{
		$this->link = new Link( $this->getSessionVar('objectid') );
		$this->link->load();
	}


	/**
	 * Verschieben der Verknüpfung
	 */
	function move()
	{
		$this->objectMove();
		$this->link->load();

		$this->callSubAction('prop');
	}


	function addACL()
	{
		$this->objectAddACL();

		$this->callSubAction('rights');
	}


	function delACL()
	{
		$this->objectDelACL();

		$this->callSubAction('rights');
	}


	/**
	 * Abspeichern der Eigenschaften
	 */
	function save()
	{
		// Wenn Name gefüllt, dann Datenbank-Update
		if   ( $this->getRequestVar('name') != '' )
		{
			if   ( $this->getRequestVar('delete') != '' )
			{
				// Verknuepfung löschen
				$this->link->delete();

				$this->getRequestVar('tree_refresh',true);
				$this->forward('blank');
			}
			else
			{
				// Eigenschaften speichern
				$this->link->name      = $this->getRequestVar('name');
				$this->link->desc      = $this->getRequestVar('desc');
				
				if	( $this->getRequestVar('type') == 'link' )
				{
					$this->link->isLinkToObject = true;
					$this->link->isLinkToUrl    = false;
					$this->link->linkedObjectId = $this->getRequestVar('linkobjectid');
				}
				else
				{
					$this->link->isLinkToObject = false;
					$this->link->isLinkToUrl    = true;
					$this->link->url            = $this->getRequestVar('url');
				}
				
				$this->link->save();
			}
		}

		$this->getRequestVar('tree_refresh',true);

		$this->callSubAction('prop');
	}


	function prop()
	{
		$this->setTemplateVars( $this->link->getProperties() );

		if	( is_numeric($this->link->lastchange_userid) )
		{
			$user = new User( $this->link->lastchange_userid );
			$user->load();
			$this->setTemplateVar('lastchange_user',array('name'=>$user->name,
			                                              'url' =>Html::url(array('action'=>'user',
			                                                                      'userid'=>$user->userid))));
		}
		else
		{
			$this->setTemplateVar('lastchange_user',array('name'=>lang('UNKNOWN')));
		}
	
		if	( is_numeric($this->link->create_userid) )
		{
			$user = new User( $this->link->create_userid );
			$user->load();
			$this->setTemplateVar('create_user',array('name'=>$user->name,
			                                          'url' =>Html::url(array('action'=>'user',
			                                                                  'userid'=>$user->userid))));
		}
		else
		{
			$this->setTemplateVar('create_user',array('name'=>lang('UNKNOWN')));
		}



		// Typ der Verknüpfung
		$this->setTemplateVar('type'            ,$this->link->getType()     );
		$this->setTemplateVar('act_linkobjectid',$this->link->linkedObjectId);
		$this->setTemplateVar('url'             ,$this->link->url           );

		// Alle verlinkbaren Objekte anzeigen
		$list = array();
		
		foreach( Object::getAllObjectIds() as $oid )
		{
			$o = new Object( $oid );
			$o->load();
			
			if	( $o->isFile ||
			       $o->isPage    )
			{
				$folder = new Folder( $o->parentid );
				$folder->linknames = false;
				$folder->load();
				$list[$oid]  = lang( $o->getType() );
				$list[$oid] .= implode(' &raquo; ',$folder->parentObjectNames( false,true ) );
				$list[$oid] .= ' &raquo; '.$o->name;
			}
		}
		asort( $list );
		$this->setTemplateVar('objects',$list);		


		// Alle Ordner ermitteln
		$this->setTemplateVar('act_objectid',$this->link->parentid);
		$list = array();
		
		$f = new Folder( $this->link->parentid );
		foreach( $f->getOtherFolders() as $oid )
		{
			$folder = new Folder( $oid );
			$list[$oid] = implode(' &raquo; ',$folder->parentObjectNames( true,true ) );
		}
		asort( $list );
		$this->setTemplateVar('folder',$list);
		$this->forward('link_prop');
	}


	function rights()
	{
		global $SESS;
		global $conf_php;
		if   ($SESS['user']['is_admin'] != '1') die('nice try');

		$acllist = array();	
		foreach( $this->link->getAllInheritedAclIds() as $aclid )
		{
			$acl = new Acl( $aclid );
			$acl->load();
			$key = 'au'.$acl->username.'g'.$acl->groupname.'a'.$aclid;
			$acllist[$key] = $acl->getProperties();
		}

		foreach( $this->link->getAllAclIds() as $aclid )
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

		$this->forward('link_rights');
	}

}