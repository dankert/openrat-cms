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
// Revision 1.7  2004-11-28 18:23:55  dankert
// Anpassen an neue Sprachdatei-Konventionen
//
// Revision 1.6  2004/11/27 13:09:17  dankert
// Ermitteln und Anzeige von Sprache,Modell
//
// Revision 1.5  2004/11/10 22:41:36  dankert
// Neue Ermittlung der Projekte, Entfernen des Punktes "Bitte auswaehlen"
//
// Revision 1.4  2004/10/13 22:13:24  dankert
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
		$this->setTemplateVar('css_body_class','menu');
		
		$user     = Session::getUser();
		$projects = $user->projects;

		// Administrator sieht Administrationsbereich
		if   ( $user->isAdmin )
			$projects = array("-1"=>lang('GLOBAL_ADMINISTRATION')) + $projects;

		$this->setTemplateVar('projects',$projects);

		// Das aktuelle Projekt voreinstellen		
		$project = Session::getProject();
		if	( is_object( $project ) )
			$this->setTemplateVar( 'act_projectid',$project->projectid );

		// Ermitteln Sprache
		$language = Session::getProjectLanguage();
		$this->setTemplateVar('language_name',$language->name);
		$this->setTemplateVar('language_url' ,Html::url( array('action'=>'main','callAction'=>'language','callSubaction'=>'listing') ));

		// Ermitteln Projektmodell
		$model = Session::getProjectModel();
		$this->setTemplateVar('projectmodel_name',$model->name);
		$this->setTemplateVar('projectmodel_url' ,Html::url( array('action'=>'main','callAction'=>'model','callSubaction'=>'listing')));


		// Ausgabe des Templates
		$this->forward('tree_menu');
	}
}

?>