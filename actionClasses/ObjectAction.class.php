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
// Revision 1.2  2004-11-28 16:55:20  dankert
// Berechtigungen f?r "alle" hinzufuegen
//
// Revision 1.1  2004/11/27 13:08:22  dankert
// Neu: Beinhaltet objekt?bergreifende Methoden. Die Klassen File,Page,Link und Folder erben nun von dieser Klasse
//
// Revision 1.9  2004/11/10 22:36:16  dankert
// Dateioperationen, Verschieben/Kopieren/Verknuepfen von mehreren Objekten in einem Arbeitsschritt
//
// Revision 1.8  2004/10/14 22:57:44  dankert
// Neue Verknuepfungen mit dem Linknamen als Url vorbelegen
//
// Revision 1.7  2004/10/13 21:18:50  dankert
// Neue Links zum Verschieben nach ganz oben/unten
//
// Revision 1.6  2004/05/07 21:30:59  dankert
// Korrektur up_url
//
// Revision 1.5  2004/05/07 21:29:16  dankert
// Url ?ber Html::url erzeugen
//
// Revision 1.4  2004/05/02 14:49:37  dankert
// Einf?gen package-name (@package)
//
// Revision 1.3  2004/04/28 20:01:52  dankert
// Ordner l?schen erm?glichen
//
// Revision 1.2  2004/04/24 16:57:13  dankert
// Korrektur: pub()
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


/**
 * Action-Klasse zum Bearbeiten eines Ordners
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class ObjectAction extends Action
{
	var $objectid;

	/**
	  * ACL zu einem Objekt setzen
	  * @access protected
	  */
	function addacl()
	{
		$acl = new Acl();

		$acl->objectid = $this->getSessionVar('objectid');
		
		switch( $this->getRequestVar('type') )
		{
			case 'user':
				$acl->userid  = $this->getRequestVar('userid' );
				break;
			case 'group':
				$acl->groupid = $this->getRequestVar('groupid');
				break;
			default:
		}

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
		$o = Session::getObject();
		$o->objectLoadRaw();

		$acllist = array();	
		foreach( $o->getAllInheritedAclIds() as $aclid )
		{
			$acl = new Acl( $aclid );
			$acl->load();
			$key = 'au'.$acl->username.'g'.$acl->groupname.'a'.$aclid;
			$acllist[$key] = $acl->getProperties();
		}

		foreach( $o->getAllAclIds() as $aclid )
		{
			$acl = new Acl( $aclid );
			$acl->load();
			$key = 'bu'.$acl->username.'g'.$acl->groupname.'a'.$aclid;
			$acllist[$key] = $acl->getProperties();
			$acllist[$key]['delete_url'] = Html::url(array('action'=>$this->actionName,'subaction'=>'delacl','id'=>$o->objectid,'aclid'=>$aclid));
		}
		ksort( $acllist );

		$this->setTemplateVar('acls',$acllist );

		$this->setTemplateVars( $o->getAssocRelatedAclTypes() );
		$this->setTemplateVar( 'show',$o->getRelatedAclTypes() );

		$this->setTemplateVar('users'    ,User::listAll()   );
		$this->setTemplateVar('groups'   ,Group::getAll()   );

		$languages = array(0=>lang('ALL_LANGUAGES'));
		$languages += Language::getAll();
		$this->setTemplateVar('languages',$languages       );
		$this->setTemplateVar('objectid' ,$o->objectid     );
		$this->setTemplateVar('action'   ,$this->actionName);

		$this->forward('object_rights');
	}


	/**
	 * Entfernen einer ACL
	 * @access protected
	 */
	function delacl()
	{
		$acl = new Acl( $this->getRequestVar('aclid') );
		$acl->delete();

		$this->callSubAction('rights');
	}

}