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
// Revision 1.10  2009-03-22 21:49:08  dankert
// Subaction "showprop" entfernt, da in "prop" mit aufgegangen.
//
// Revision 1.9  2006/06/02 19:49:06  dankert
// Bearbeiten von Verkn?pfungen
//
// Revision 1.8  2006/01/29 17:18:58  dankert
// Steuerung der Aktionsklasse ?ber .ini-Datei, dazu umbenennen einzelner Methoden
//
// Revision 1.7  2006/01/23 23:10:45  dankert
// *** empty log message ***
//
// Revision 1.6  2004/12/20 22:04:25  dankert
// kein Lesen der Benutzer
//
// Revision 1.5  2004/12/15 23:23:11  dankert
// Anpassung an Session-Funktionen
//
// Revision 1.4  2004/11/24 21:28:36  dankert
// "Verschieben" entfernt
//
// Revision 1.3  2004/05/02 14:49:37  dankert
// Einf?gen package-name (@package)
//
// Revision 1.2  2004/04/30 20:31:47  dankert
// Berechtigungen anzeigen
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


/**
 * Action-Klasse f?r Verkn?pfungen
 * @version $Id$
 * @author $Author$
 * @package openrat.actions
 */
class LinkAction extends ObjectAction
{
	var $link;
	var $defaultSubAction = 'prop';

	/**
	 * Konstruktor
	 */
	function LinkAction()
	{
		if	( $this->getRequestId() != 0  )
		{
			$this->link = new Link( $this->getRequestId() );
			$this->link->load();
			Session::setObject( $this->link );
		}
		else
		{
			$this->link = Session::getObject();
		}
	}



	function remove()
	{
		$this->setTemplateVars( $this->link->getProperties() );
	}
	


	function delete()
	{
		if	( $this->hasRequestVar("delete") )
		{
			$this->link->delete();
			$this->addNotice('link',$this->link->name,'DELETED');
		}
	}
	


	/**
	 * Abspeichern der Eigenschaften
	 */
	function saveprop()
	{
		// Wenn Name gefuellt, dann Datenbank-Update
		if   ( $this->getRequestVar('name') != '' )
		{
			// Eigenschaften speichern
			$this->link->name      = $this->getRequestVar('name'       ,'full');
			$this->link->desc      = $this->getRequestVar('description','full');

			$this->link->save();
			$this->link->setTimestamp();
			Session::setObject( $this->link );
		}
	}


	/**
	 * Abspeichern der Eigenschaften
	 */
	function save()
	{
		if( $this->getRequestVar('type') != '' )
		{
			if	( $this->getRequestVar('type') == 'link' )
			{
				$this->link->isLinkToObject = true;
				$this->link->isLinkToUrl    = false;
				$this->link->linkedObjectId = $this->getRequestVar('targetobjectid');
			}
			else
			{
				$this->link->isLinkToObject = false;
				$this->link->isLinkToUrl    = true;
				$this->link->url            = $this->getRequestVar('url');
			}
			
			$this->link->save();
			$this->link->setTimestamp();
			Session::setObject( $this->link );
			
			$this->addNotice('link',$this->link->name,'SAVED',OR_NOTICE_OK);
		}
		else
		{
			$this->addNotice('link',$this->link->name,'NOT_SAVED',OR_NOTICE_WARN);
		}
	}


	function showprop()
	{
		$this->setTemplateVars( $this->link->getProperties() );
	}



	function edit()
	{
		$this->setTemplateVars( $this->link->getProperties() );

		// Typ der Verkn?pfung
		$this->setTemplateVar('type'            ,$this->link->getType()     );
		$this->setTemplateVar('targetobjectid',$this->link->linkedObjectId);
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
				$list[$oid]  = lang( 'GLOBAL_'.$o->getType() ).': ';
				$list[$oid] .= implode( FILE_SEP,$folder->parentObjectNames( false,true ) );
				$list[$oid] .= FILE_SEP.$o->name;
			}
		}
		asort( $list );
		$this->setTemplateVar('objects',$list);		
	}



	function prop()
	{
		$this->setTemplateVars( $this->link->getProperties() );
		$this->setTemplateVar('act_linkobjectid',$this->link->linkedObjectId);
	}
}