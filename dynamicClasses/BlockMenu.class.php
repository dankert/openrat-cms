<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// OpenRat Content Management System
// Copyright (C) 2002 Jan Dankert, jandankert@jandankert.de
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
// Revision 1.1  2004-10-14 21:16:12  dankert
// Erzeugen eines Menues in Bloecken
//
// ---------------------------------------------------------------------------



/**
 * Erstellen eines Hauptmenues
 * @author Jan Dankert
 */
class BlockMenu /*extends DynamicElement*/
{
	/**
	 * Bitte immer alle Parameter in dieses Array schreiben, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $parameters  = Array(
		'arrowChar'=>'String between menu entries, default: "&middot;"'
		);


	var $arrowChar = ' &middot; ';

	/**
	 * Bitte immer eine Beschreibung benutzen, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $description = 'Creates a main menu.';
	var $version     = '$Id$';
	var $api;

	// Erstellen des Hauptmenues
	function execute()
	{
		// Erstellen des Hauptmenues
		
		// Lesen des Root-Ordners
		$folder = new Folder( $this->api->getRootObjectId() );
		
		// Schleife ueber alle Inhalte des Root-Ordners
		foreach( $folder->getObjectIds() as $id )
		{
			$o = new Object( $id );
			$o->languageid = $this->page->languageid;
			$o->load();
			if ( $o->isFolder ) // Nur wenn Ordner
			{
				$f = new Folder( $id );
				
				// Ermitteln eines Objektes mit dem Dateinamen index
				$oid = $f->getObjectIdByFileName('index');
				
				if	( count($f->getLinks())+count($f->getPages()) > 0 )
				{
					$this->api->output( '
			<!-- sidebox -->
		     <table bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%">
		      <tr>
		       <td>
		        <table border="0" cellpadding="3" cellspacing="1" width="100%">
		         <tr>
		          <td bgcolor="#cccccc"><span class="title"> '.$o->name.'</span></a>
		          </td>
		         </tr>
		         <tr>
		          <td bgcolor="#ffffff">
	');
					// Untermenue
					// Schleife ber alle Objekte im aktuellen Ordner
					foreach( $f->getObjectIds() as $xid )
				    {
						$o = new Object( $xid );
						$o->languageid = $this->page->languageid;
						$o->load();
				
						// Nur Seiten anzeigen
						if (!$o->isPage && !$o->isLink ) continue;
						
						// Wenn aktuelle Seite, dann markieren, sonst Link
						if ( $this->api->getObjectId() == $xid )
						{
							// aktuelle Seite
							$this->api->output( '            <span class="small">o</span>
							<strong class="nav">'.$o->name.'</strong>
							<br />' );
						}
						else
						{
							$this->api->output( '            <span class="small">o</span>
						       <a class="nav" href="'.$this->page->path_to_object($xid).'">'.$o->name.'</a>
						       <br />' );
						}
					//Api::output( '<br/>' );
					}
			
					$this->api->output( '
			          </td>
			         </tr>
			        </table>
			       </td>
			      </tr>
			     </table>
			     <!-- end sidebox -->
		     <br />
					' );
				}
			}
		}
	}
}