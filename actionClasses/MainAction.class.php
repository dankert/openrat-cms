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
// Revision 1.7  2006-01-11 22:52:24  dankert
// URLs f?r neue Frames setzen
//
// Revision 1.6  2005/01/14 21:41:23  dankert
// Aufruf von lastModified() fuer Conditional-GET
//
// Revision 1.5  2004/12/19 14:55:50  dankert
// Bestimmte Paramer weiterleiten
//
// Revision 1.4  2004/12/15 23:23:47  dankert
// Html::url()-Parameter angepasst
//
// Revision 1.3  2004/11/27 13:07:05  dankert
// *** empty log message ***
//
// Revision 1.2  2004/05/02 14:49:37  dankert
// Einf?gen package-name (@package)
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


/**
 * Action-Klasse fuer die Darstellung des Unter-Framesets
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class MainAction extends Action
{
	var $defaultSubAction = 'show';
	
	function show()
	{
		$user = Session::getUser();
		if	( is_object($user) && isset($user->loginDate) )
			$this->lastModified( $user->loginDate );

		// Bestimmte Paramer weiterleiten
		$params = array(); 
		
		foreach( array('elementid') as $p )
		{
			if	( $this->getRequestVar( $p ) != '' )
				$params[ $p ] = $this->getRequestVar( $p );
		}

		// Variablen fuellen
		$this->setTemplateVar('frame_src_main_menu',Html::url( 'mainmenu'                       ,$this->getRequestVar('subaction'),$this->getRequestId(),$params ) );
		$this->setTemplateVar('frame_src_main_main',Html::url( $this->getRequestVar('subaction'),''                               ,$this->getRequestId(),$params ) );
		$this->setTemplateVar( 'frame_src_border'    ,Html::url( 'border'         ) );
		$this->setTemplateVar( 'frame_src_background',Html::url( 'background'     ) );
		
		$this->forward('frameset_main'); // Forward auf View
	}

}


?>