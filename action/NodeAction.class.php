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


/**
 * Action-Klasse zum Bearbeiten eines Ordners
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class NodeAction extends Action
{
	public $security = SECURITY_USER;
	
	private $id;


	function NodeAction( $id=null ) 
	{
		if	( $id == null )
			$id = parent::getRequestId();
		
		$this->id = $id;
	}
	
	
	
	/**
	  * ACL zu einem Objekt setzen
	  *
	  * @access public
	  */
	function aclformPost()
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

		// Falls die Berechtigung vererbbar ist, dann diese sofort an
		// Unterobjekte vererben.
		if	( $acl->transmit )
		{
			$folder = new Folder( $acl->objectid );
			$oids = $folder->getObjectIds();
			foreach( $folder->getAllSubfolderIds() as $sfid )
			{
				$subfolder = new Folder( $sfid );
				$oids = array_merge($oids,$subfolder->getObjectIds());
			}
			
			foreach( $oids as $oid )
			{
				$acl->objectid = $oid;
				$acl->add();
			}
		}
		
		
		
		
		$this->addNotice('','','ADDED',OR_NOTICE_OK);
		
		$o->setTimestamp();
	}



	/**
	 * Alle Rechte anzeigen
	 */
	function rightsView()
	{
		$this->actionName = 'object';
		$o = new Object( $this->getRequestId() );
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
			$acllist[$key]['aclid'] = $aclid;
		}
		ksort( $acllist );

		$this->setTemplateVar('acls',$acllist );

		$this->setTemplateVars( $o->getAssocRelatedAclTypes() );
	}

	
	
	/**
	 * Alle Rechte anzeigen
	 */
	function inheritView()
	{
		$this->actionName = 'object';
		
		$o = new Object( $this->getRequestId() );
		$o->objectLoadRaw();
		$this->setTemplateVar( 'type',$o->getType() );
		
		$acllist = array();
		$this->setTemplateVar('acls',$acllist );
	}

	
	
	/**
	 * 
	 * @return unknown_type
	 */
	function inheritPost()
	{
		Session::close();
		
		$folder = new Folder( $this->getRequestId() );
		$folder->load();
		
		if	( ! $this->hasRequestVar('inherit') )
		{
			$this->addNotice('folder',$folder->name,'NOTHING_DONE',OR_NOTICE_WARN);
			return;
		}
		
		
		$aclids = $folder->getAllAclIds();
		
		$newAclList = array();
		foreach( $aclids as $aclid )
		{
			$acl = new Acl( $aclid );
			$acl->load();
			if	( $acl->transmit )
				$newAclList[] = $acl;
		}
		Logger::debug('inheriting '.count($newAclList).' acls');
		
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
				Logger::debug('removing acl '.$aclid.' for object '.$oid);
			}
			
			// Vererbbare ACLs des aktuellen Ordners anwenden.
			foreach( $newAclList as $newAcl )
			{
				$newAcl->objectid = $oid;
				$newAcl->add();
				Logger::debug('adding new acl '.$newAcl->aclid.' for object '.$oid);
			}
		}
		
		$this->addNotice('folder',$folder->name,'SAVED',OR_NOTICE_OK);
	}


	/**
	 * Formular anzeigen, um Rechte hinzufuegen
	 */
	function aclformView()
	{
		$this->actionName = 'object';
		
		$o = new Object( $this->getRequestId() );
		$o->objectLoadRaw();

		$this->setTemplateVars( $o->getAssocRelatedAclTypes() );
		$this->setTemplateVar( 'show',$o->getRelatedAclTypes() );

		$this->setTemplateVar('users'    ,User::listAll()   );
		$this->setTemplateVar('groups'   ,Group::getAll()   );

		$languages = array(0=>lang('ALL_LANGUAGES'));
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
	function delaclPost()
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
	
	
	
	/**
	 * Liefert die Unterelemente zum aktuellen Knoten.
	 */
	public function childrenView()
	{
		parent::setView('node/children');
		
		$node = new Node($this->id);
		$node->load();
		$children = $node->getChildren();
		$listChildren = array();
		
		foreach( $children as $childId => $childName)
		{
			$childNode = new Node($childId);
			$childNode->load();
			$listChildren[] = array(
				'id'  => $childNode->id,
				'name'=> $childNode->name,
				'type'=> $childNode->getType()
			);
		}
		
		parent::setTemplateVar('children'  , $listChildren );
		parent::setTemplateVar('childTypes', $node->getPossibleChildTypes() );
	}
	
	
	
	/**
	 * Liefert die Unterelemente zum aktuellen Knoten.
	 */
	public function childrenPost()
	{
		$node = new Node($this->id);
		$node->load();
		
		$newNode = new Node();
		$newNode->name = parent::getRequestVar('name', OR_FILTER_ALPHANUM);
		$newNode->type = parent::getRequestVar('type', OR_FILTER_NUMBER  );
		
		$node->addNewChild( $newNode );
		
		parent::addNotice($newNode->getType(),$newNode->name,'ADDED');
	}
	
	
	
	public function orderView()
	{
		$ids   = $this->folder->getObjectIds();
		$seq   = 0;
		
		$order = explode(',',$this->getRequestVar('order') );
		
		foreach( $order as $objectid )
		{
			if	( ! in_array($objectid,$ids) )
			{
				Http::serverError('Object-Id '.$objectid.' is not in this folder any more');
			}
			$seq++; // Sequenz um 1 erhoehen
				
			$o = new Object( $objectid );
			$o->setOrderId( $seq );
		
			unset( $o ); // Selfmade Garbage Collection :-)
		}
		
		$this->addNotice($this->folder->getType(),$this->folder->name,'SEQUENCE_CHANGED','ok');
		$this->folder->setTimestamp();
	}
	
}