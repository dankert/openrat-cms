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
// Revision 1.4  2004-10-13 22:13:24  dankert
// Auswerten der Berechtigungen
//
// Revision 1.3  2004/05/02 14:49:37  dankert
// Einf?gen package-name (@package)
//
// Revision 1.2  2004/04/25 17:35:42  dankert
// openall_url setzen
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------

/**
 * Action-Klasse zur Darstellung des Projekt-Auswahlmenues
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class TreemenuAction extends Action
{
	var $defaultSubAction = 'show';


	function show()
	{
		global $SESS;
		$this->setTemplateVar('css_body_class','menu');
		
		$projects = array();

		$user = $this->getUserFromSession();
		
		if	( isset($user) )
		{
			// Lesen aller Projekte, fuer die der Benutzer berechtigt ist.
			$projects = $user->getReadableProjects();

			$projects[0] = lang('SELECT');
		
			// Unterscheidung Administrator/Benutzer
			if   ( $user->isAdmin )
			{
				// Administrator sieht Administrationsbereich
				$projects[-1] = lang('ADMINISTRATION');
			}
			ksort( $projects );

			$this->setTemplateVar( 'act_projectid',intval($this->getSessionVar('projectid')) );
		}
		$this->setTemplateVar('projects',$projects);
		
		// Ausgabe des Templates
		$this->forward('tree_menu');
	}
}

?>