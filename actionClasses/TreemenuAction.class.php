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
// Revision 1.3  2004-05-02 14:49:37  dankert
// Einfügen package-name (@package)
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

		if   (isset($SESS['user']))
		{
			// Lesen der verfügbaren Projekte
			$projekte = Project::getAll();

			$projects[0] = lang('SELECT');
		
			// Unterscheidung Administrator/Benutzer
			if   ( $SESS['user']['is_admin'] == '1' )
			{
				// Administrator sieht Administrationsbereich
				$projects[-1] = lang('ADMINISTRATION');
				
				// Administrator sieht alle Projekte
				foreach( $projekte as $projectid=>$name )
				{
					$projects[$projectid] = $name;
				}
			}
			else
			{
				// Bereitstellen der Projekte, für die der Benutzer berechtigt ist
				foreach( $projekte as $projectid=>$projectname )
				{
					$project = new Project( $projectid );
					 
					$rootObject = new Object( $project->getRootObjectId() );
					$rootObject->load();
					 
					if   ( $rootObject->hasRight('read') )
						$projects[$projectid] = $projectname;
				}
			}
			$this->setTemplateVar( 'act_projectid',intval($this->getSessionVar('projectid')) );
		}
		$this->setTemplateVar('projects',$projects);

		$this->setTemplateVar('reload_url'  ,Html::url( array('action'   =>'tree',
		                                                      'subaction'=>'reload') ));
		$this->setTemplateVar('openall_url' ,Html::url( array('action'   =>'tree',
		                                                      'subaction'=>'openall') ));
		
		// Ausgabe des Templates
		$this->forward('tree_menu');
	}
}

?>