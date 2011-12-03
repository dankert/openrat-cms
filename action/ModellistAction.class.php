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
// Revision 1.10  2007-05-08 20:25:58  dankert
// Erweiterung der Methode "checkmenu()"
//
// Revision 1.9  2007-05-08 20:21:03  dankert
// ?berschreiben der Methode "checkmenu()"
//
// Revision 1.8  2007-04-08 21:18:16  dankert
// Korrektur URL in listing()
//
// Revision 1.7  2007/01/21 22:27:49  dankert
// Direkt Punkt "Bearbeiten" ?ffnen.
//
// Revision 1.6  2006/01/29 17:18:58  dankert
// Steuerung der Aktionsklasse ?ber .ini-Datei, dazu umbenennen einzelner Methoden
//
// Revision 1.5  2004/12/19 14:55:27  dankert
// Anpassung von urls
//
// Revision 1.4  2004/12/13 22:17:51  dankert
// URL-Korrektur
//
// Revision 1.3  2004/05/07 21:37:31  dankert
// Url ?ber Html::url erzeugen
//
// Revision 1.2  2004/05/02 14:49:37  dankert
// Einf?gen package-name (@package)
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


/**
 * Action-Klasse zum Bearbeiten eines Projetmodells
 * 
 * @author Jan Dankert
 * @package openrat.actions
 */
class ModellistAction extends Action
{
	function ModellistAction()
	{
		if	( $this->getRequestId() != 0 )
		{
			$this->model = new Model( $this->getRequestId() );
			$this->model->load();
		}
		
		$this->project = Session::getProject();
	}


	function showView()
	{
		global $conf_php;
		$actModel = Session::getProjectModel();

//		$var['act_modelid'] = $this->getSessionVar('modelid');
	
		$list = array();
		foreach( $this->project->getModelIds() as $id )
		{
			$m = new Model( $id );
			$m->load();

			$list[$id]['name'] = $m->name;
			
			if	( $this->userIsAdmin() )
				$list[$id]['url' ] = Html::url('model','edit',$id,
				                               array() );

			if	( ! $m->isDefault && $this->userIsAdmin() )
				$list[$id]['default_url'] = Html::url('model','setdefault',$id);

			if	( $actModel->modelid != $m->modelid )
				$list[$id]['select_url' ] = Html::url('index','model',$id);
		}
		$this->setTemplateVar( 'el',$list );
		$this->setTemplateVar( 'add',$this->userIsAdmin() );
	}


	/**
	 * Bearbeiten der Variante.
	 * Ermitteln aller Eigenschaften der Variante.
	 */
	function editView()
	{
		$this->nextSubActionsetTemplateVars('show');
	}
}