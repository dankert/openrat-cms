<?php
#
#  DaCMS Content Management System
#  Copyright (C) 2002 Jan Dankert, jandankert@jandankert.de
#
#  This program is free software; you can redistribute it and/or
#  modify it under the terms of the GNU General Public License
#  as published by the Free Software Foundation; either version 2
#  of the License, or (at your option) any later version.
#
#  This program is distributed in the hope that it will be useful,
#  but WITHOUT ANY WARRANTY; without even the implied warranty of
#  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#  GNU General Public License for more details.
#
#  You should have received a copy of the GNU General Public License
#  along with this program; if not, write to the Free Software
#  Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
#

/**
 * Darstellen einer Baumstruktur mit Administrationfunktionen
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class AdministrationTree extends AbstractTree
{
	/**
	 * Alle Elemente des Baumes
	 */
	var $elements;
	
	function root()
	{
		$treeElement = new TreeElement();
		$treeElement->text        = lang('GLOBAL_ADMINISTRATION');
		$treeElement->description = lang('GLOBAL_ADMINISTRATION');
		$treeElement->type        = 'administration';
		$treeElement->icon        = 'project_list';
		
		$this->addTreeElement( $treeElement );
	}



	function administration()
	{
		$treeElement = new TreeElement();
		$treeElement->text        = lang('GLOBAL_PROJECTS');
		$treeElement->description = lang('GLOBAL_PROJECTS');
		$treeElement->url         = Html::url('main','project');
		$treeElement->icon        = 'project_list';
		$treeElement->type        = 'projects';
		$treeElement->target      = 'cms_main';
		
		$this->addTreeElement( $treeElement );


		$treeElement = new TreeElement();
		$treeElement->text        = lang('USER_AND_GROUPS');
		$treeElement->description = lang('USER_AND_GROUPS');
		$treeElement->icon        = 'group';
		$treeElement->type        = 'userandgroups';
		
		$this->addTreeElement( $treeElement );


		// Wechseln zu: Projekte...
		/*
		foreach( Project::getAll() as $id=>$name )
		{
			$treeElement = new TreeElement();
			
			$treeElement->text         = lang('PROJECT').' '.$name;
			$treeElement->url          = Html::url(array('action'    =>'tree',
		                                                  'subaction' =>'reload',
			                                             'projectid' =>$id       ));
			$treeElement->icon         = 'project';
			$treeElement->description  = '';
			$treeElement->target       = 'cms_tree';

			$this->addTreeElement( $treeElement );
		}
		*/
	}



	function userandgroups( $id )
	{
		$treeElement = new TreeElement();
		$treeElement->text        = lang('GLOBAL_USER');
		$treeElement->description = lang('GLOBAL_USER');
		$treeElement->url         = Html::url('main','user');
		$treeElement->icon        = 'user';
		$treeElement->target      = 'cms_main';
		$treeElement->type        = 'users';
		
		$this->addTreeElement( $treeElement );

		$treeElement = new TreeElement();
		$treeElement->text        = lang('GLOBAL_GROUPS');
		$treeElement->description = lang('GLOBAL_GROUPS');
		$treeElement->url         = Html::url('main','group');
		$treeElement->icon        = 'group';
		$treeElement->target      = 'cms_main';
		$treeElement->type        = 'groups';

		$this->addTreeElement( $treeElement );
	}


	function projects( $id )
	{
		// Schleife ?ber alle Projekte
		foreach( Project::getAll() as $id=>$name )
		{
			$treeElement = new TreeElement();
			
			$treeElement->internalId   = $id;
			$treeElement->text         = $name;
			$treeElement->url          = Html::url('main','project',$id);
			$treeElement->icon         = 'project';
			$treeElement->description  = '';
			$treeElement->target       = 'cms_main';

			$this->addTreeElement( $treeElement );
		}
	}
	
	
	function users( $id )
	{	
		foreach( User::getAllUsers() as $user )
		{
			$treeElement = new TreeElement();
			
			$treeElement->internalId  = $user->userid;
			$treeElement->text        = $user->name;
			$treeElement->url         = Html::url('main','user',$user->userid);
			$treeElement->icon        = 'user';
			
			$desc =  $user->fullname;

			if	( $user->isAdmin )
				$desc .= ' ('.lang('USER_ADMIN').') ';
			if	( $user->desc == "" )
				$desc .= ' - '.lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
			else
				$desc .= ' - '.$user->desc;

			$treeElement->description = $desc;
			$treeElement->target      = 'cms_main';

			$this->addTreeElement( $treeElement );
		}
	}


	function groups( $id )
	{

		foreach( Group::getAll() as $id=>$name )
		{
			$treeElement = new TreeElement();
			
			$g = new Group( $id );
			$g->load();

			$treeElement->internalId  = $id;
			$treeElement->text        = $g->name;
			$treeElement->url         = Html::url('main','group',$id);
			$treeElement->icon        = 'group';
	     	$treeElement->description = lang('GLOBAL_GROUP').' '.$g->name.': '.implode(', ',$g->getUsers());
			$treeElement->target      = 'cms_main';
			$treeElement->type        = 'userofgroup';

			$this->addTreeElement( $treeElement );
		}
	}


	function userofgroup( $id )
	{
		$g = new Group( $id );

		foreach( $g->getUsers() as $id=>$name )
		{
			$treeElement = new TreeElement();
			
			$u = new User( $id );
			$u->load();
			$treeElement->text        = $u->name;
			$treeElement->url         = Html::url('main','user',$id);
			$treeElement->icon        = 'user';
			$treeElement->description = $u->fullname;
			$treeElement->target      = 'cms_main';

			$this->addTreeElement( $treeElement );
		}
	}
}

?>