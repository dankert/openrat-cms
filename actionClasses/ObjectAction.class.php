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
// Revision 1.12  2009-03-22 21:13:22  dankert
// Rechte-Seite auch für Nicht-Ordner editierbar, damit Rechte löschbar sind.
//
// Revision 1.11  2009-03-19 04:36:42  dankert
// Neue Methode "inherit()".
//
// Revision 1.10  2009-03-19 02:02:43  dankert
// Keine ererbten Rechte anzeigen.
//
// Revision 1.9  2009-03-06 13:00:40  dankert
// Zeichenketten 'action' und 'subaction' durch Konstanten ersetzt.
//
// Revision 1.8  2007-11-09 20:41:51  dankert
// Hinweismeldungen setzen.
//
// Revision 1.7  2007-10-29 23:29:17  dankert
// Konstanten f?r Request-Variablen.
//
// Revision 1.6  2006/01/29 17:25:07  dankert
// Methode setWindowMenu() entfernt
//
// Revision 1.5  2006/01/23 23:10:46  dankert
// *** empty log message ***
//
// Revision 1.4  2004/12/19 14:56:33  dankert
// Abfrage von Rechten
//
// Revision 1.3  2004/11/28 19:25:38  dankert
// Anpassen an neue Sprachdatei-Konventionen
//
// Revision 1.2  2004/11/28 16:55:20  dankert
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
	  *
	  * @access public
	  */
	function addacl()
	{
		$acl = new Acl();

		$acl->objectid = $this->getRequestId();
		
		// Nachschauen, ob der Benutzer ueberhaupt berechtigt ist, an
		// diesem Objekt die ACLs zu aendern.
		$o = new Object( $acl->objectid );

		if	( !$o->hasRight( ACL_GRANT ) )
			die('uh?'); // Scheiss Hacker.
		
		// Handelt es sich um eine Benutzer- oder Gruppen ACL?
		switch( $this->getRequestVar('type') )
		{
			case 'user':
				$acl->userid  = $this->getRequestVar('userid' );
				
				if	( $acl->userid <= 0 )
				{
					$this->addValidationError('type'     );
					$this->addValidationError('userid','');
					$this->callSubAction('aclform');
					return;
				}
				break;
			case 'group':
				$acl->groupid = $this->getRequestVar('groupid');
				if	( $acl->groupid <= 0 )
				{
					$this->addValidationError('type'      );
					$this->addValidationError('groupid','');
					$this->callSubAction('aclform');
					return;
				}
				break;
			case 'all':
				break;
			default:
				$this->addValidationError('type');
				$this->callSubAction('aclform');
				return;
		}

		$acl->languageid    = $this->getRequestVar(REQ_PARAM_LANGUAGE_ID);

		$acl->write         = ( $this->hasRequestVar('write'        ) );
		$acl->prop          = ( $this->hasRequestVar('prop'         ) );
		$acl->delete        = ( $this->hasRequestVar('delete'       ) );
		$acl->release       = ( $this->hasRequestVar('release'      ) );
		$acl->publish       = ( $this->hasRequestVar('publish'      ) );
		$acl->create_folder = ( $this->hasRequestVar('create_folder') );
		$acl->create_file   = ( $this->hasRequestVar('create_file'  ) );
		$acl->create_link   = ( $this->hasRequestVar('create_link'  ) );
		$acl->create_page   = ( $this->hasRequestVar('create_page'  ) );
		$acl->grant         = ( $this->hasRequestVar('grant'        ) );
		$acl->transmit      = ( $this->hasRequestVar('transmit'     ) );

		$acl->add();
		
		$this->addNotice('','','ADDED',OR_NOTICE_OK);
		
		$o->setTimestamp();
	}



	/**
	 * Alle Rechte anzeigen
	 */
	function rights()
	{
//		$this->actionName = 'object';
		$o = Session::getObject();
		$o->objectLoadRaw();
		$this->setTemplateVar( 'show',$o->getRelatedAclTypes() );
		$this->setTemplateVar( 'type',$o->getType() );
		
		$acllist = array();

		/*
		foreach( $o->getAllInheritedAclIds() as $aclid )
		{
			$acl = new Acl( $aclid );
			$acl->load();
			$key = 'au'.$acl->username.'g'.$acl->groupname.'a'.$aclid;
			$acllist[$key] = $acl->getProperties();
		}
		*/

		foreach( $o->getAllAclIds() as $aclid )
		{
			$acl = new Acl( $aclid );
			$acl->load();
			$key = 'bu'.$acl->username.'g'.$acl->groupname.'a'.$aclid;
			$acllist[$key] = $acl->getProperties();
			$acllist[$key]['delete_url'] = Html::url($this->actionName,'delacl',$o->objectid,array('aclid'=>$aclid));
		}
		ksort( $acllist );

		$this->setTemplateVar('acls',$acllist );

		$this->setTemplateVars( $o->getAssocRelatedAclTypes() );
	}

	
	
	/**
	 * 
	 * @return unknown_type
	 */
	function inherit()
	{
		$log = array();
		
		if	( ! $this->hasRequestVar('inherit') )
		{
			$this->addNotice('folder',$this->name,'NOTHING_DONE',OR_NOTICE_WARN);
			return;
		}
		
		
		$folder = $this->folder;
		$aclids = $folder->getAllAclIds();
		
		$newAclList = array();
		foreach( $aclids as $aclid )
		{
			$acl = new Acl( $aclid );
			$acl->load();
			if	( $acl->transmit )
				$newAclList[] = $acl;
		}
		$log[] = 'inheriting '.count($newAclList).' acls';
		
		$oids = $folder->getObjectIds();
		
		foreach( $folder->getAllSubfolderIds() as $sfid )
		{
			$subfolder = new Folder( $sfid );
			
			$oids = array_merge($oids,$subfolder->getObjectIds());
		}
		
		foreach( $oids as $oid )
		{
			$object = new Object( $oid );
		
			// Die alten ACLs des Objektes löschen.
			foreach( $object->getAllAclIds() as $aclid )
			{
				$acl = new Acl( $aclid );
				$acl->objectid = $oid;
				$acl->delete();
				$log[] = 'removing acl '.$aclid.' for object '.$oid;
			}
			
			// Vererbbare ACLs des aktuellen Ordners anwenden.
			foreach( $newAclList as $newAcl )
			{
				$newAcl->objectid = $oid;
				$newAcl->add();
				$log[] = 'adding new acl '.$newAcl->aclid.' for object '.$oid;
			}
		}
		
		$this->addNotice('folder',$this->name,'SAVED',OR_NOTICE_OK,array(),$log);
	}


	/**
	 * Formular anzeigen, um Rechte hinzufuegen
	 */
	function aclform()
	{
		$o = Session::getObject();
		$o->objectLoadRaw();

		$this->setTemplateVars( $o->getAssocRelatedAclTypes() );
		$this->setTemplateVar( 'show',$o->getRelatedAclTypes() );

		$this->setTemplateVar('users'    ,User::listAll()   );
		$this->setTemplateVar('groups'   ,Group::getAll()   );

		$languages = array(0=>lang('GLOBAL_ALL_LANGUAGES'));
		$languages += Language::getAll();
		$this->setTemplateVar('languages',$languages       );
		$this->setTemplateVar('objectid' ,$o->objectid     );
		$this->setTemplateVar('action'   ,$this->actionName);
	}



	/**
	 * Entfernen einer ACL
	 * 
	 * @access protected
	 */
	function delacl()
	{
		$acl = new Acl($this->getRequestVar('aclid'));
		$acl->objectid = $this->getRequestId();

		// Nachschauen, ob der Benutzer ueberhaupt berechtigt ist, an
		// diesem Objekt die ACLs zu aendern.
		$o = new Object( $this->getRequestId() );

		if	( !$o->hasRight( ACL_GRANT ) )
			die('ehm?'); // Da wollte uns wohl einer vereimern.

		$acl->delete(); // Weg mit der ACL
		
		$this->addNotice('','','DELETED',OR_NOTICE_OK);
	}
}