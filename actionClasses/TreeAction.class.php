<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// DaCMS Content Management System
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
// Revision 1.1  2004-04-24 15:14:52  dankert
// Initiale Version
//
// Revision 1.1  2003/09/29 18:19:48  dankert
// erste Version
//
// ---------------------------------------------------------------------------


class TreeAction extends Action
{
	var $defaultSubAction = 'reload';


	function open()
	{
		global $SESS;
		array_push($SESS['tree_open'][$this->getSessionVar('projectid')],$this->getRequestVar('open'));

		$this->callSubAction('show');
	}
	
	
	function close()
	{
		global $SESS;
		$key = array_search( $this->getRequestVar('close'),$SESS['tree_open'][$this->getSessionVar('projectid')] );
		if	( !is_null($key) && $key!==false )
			unset( $SESS['tree_open'][$this->getSessionVar('projectid')][$key] );

		$this->callSubAction('show');
	}
	
		
	function reload()
	{
		// Hinzufügen eines Ordners incl. Unterelemente zur Projektstruktur
		function add_folder( $objectid )
		{
			global
			$SESS,
			$projectid;

			$f = new Folder( $objectid );
			$t = time();
		
			foreach( $f->getObjectIds() as $id )
			{
				$o = new Object( $id );
		
				// Wenn keine Leseberechtigung	
				if	( !$o->hasRight('read') )
					continue;
		
				$o->load();
		
				if   ( $o->isFolder )
				{
					$SESS['tree']['o'.$id] = array('text'   => Text::maxLaenge( 25,$o->name ),
					                                   'desc'   => lang('FOLDER').' '.$id.' '.$o->desc,
					                                   'url'    => Html::url(array('action'       =>'main',
			                                                                         'callAction'   =>'folder',
			                                                                         'objectid'       =>$id )),
					                                   'icon'   => 'folder',
					                                   'parent' => "o$objectid",
					                                   'target' => 'cms_main' );
					add_folder( $id );
				}
				if   ( $o->isPage )
				{
					$SESS['tree']['o'.$id] = array('text'   => Text::maxLaenge( 25,$o->name ),
					                                   'desc'   => lang('PAGE').' '.$id.' '.$o->desc,
					                                   'url'    => Html::url(array('action'       =>'main',
			                                                                         'callAction'   =>'page',
			                                                                         'objectid'       =>$id )),
					                                   'icon'   => 'page',
					                                   'parent' => "o$objectid",
					                                   'target' => 'cms_main' );
		
					// Nur wenn die Seite beschreibbar ist, werden die
					// Elemente im Baum angezeigt
					if   ( $o->hasRight('write') )
						add_page_elements( $id );
				}
				if   ( $o->isFile )
				{
					$file = new File( $id );
					$file->load();
					if	( substr($file->mimeType(),0,6) == 'image/' )
						$icon = 'image';
					else	$icon = 'file';

					$SESS['tree']['o'.$id] = array('text'   => Text::maxLaenge( 25,$o->name ),
					                                   'desc'   => lang('FILE').' '.$id.' '.$o->desc,
					                                   'url'    => Html::url(array('action'       =>'main',
			                                                                         'callAction'   =>'file',
			                                                                         'objectid'       =>$id )),
					                                   'icon'   => $icon,
					                                   'parent' => "o$objectid",
					                                   'target' => 'cms_main' );
				}
				if   ( $o->isLink )
				{
					$SESS['tree']['o'.$id] = array('text'   => Text::maxLaenge( 25,$o->name ),
					                                   'desc'   => lang('LINK').' '.$id.' '.$o->desc,
					                                   'url'    => Html::url(array('action'       =>'main',
			                                                                         'callAction'   =>'link',
			                                                                         'objectid'       =>$id )),
					                                   'icon'   => 'link',
					                                   'parent' => "o$objectid",
					                                   'target' => 'cms_main' );
				}
			}
		}
		
		
		
		function add_page_elements( $objectid )
		{
			global $SESS,$conf_php,$t_element;
		
			$page = new Page( $objectid );
			$page->load();
		
			$template = new Template( $page->templateid );
		
			foreach( $template->getElementIds() as $elementid )
			{
				$element = new Element( $elementid );
				$element->load();
		
				if	( $element->isWritable() )
				{
					$SESS['tree']['o'.$objectid.'el'.$elementid ] = array('text'   => $element->name,
					                                   'url'    => Html::url(array('action'  =>'main',
			                                                                 'callAction'      =>'pageelement',
			                                                                 'callSubaction'   =>'edit',
			                                                                 'objectid'        =>$objectid,
			                                                                 'elementid'       =>$elementid       )),
					                                   'icon'   => 'el_'.$element->type,
					                                   'desc'   => Text::maxLaenge( 25,$element->desc ),
					                                   'parent' => "o$objectid",
					                                   'target' => 'cms_main' );
				}
			}
		}
		global $SESS;
		$projectid = $this->getSessionVar('projectid');

		if	( $this->getRequestVar('projectid') != '' )
		{
			// Beim Laden eines neuen Projektes die bisherigen
			// Sprach- und Projektmodelleinstellungen entfernen
			unset( $SESS['modelid'] );
			unset( $SESS['languageid'    ] );
		}
		
		if   (!isset($SESS['tree_open']))
		     $SESS['tree_open'] = array();
		
		if   ( !isset($SESS['tree_open'][$projectid]) )
		     $SESS['tree_open'][$projectid] = array();
		
		
		// Erzeugen des Menue-Baums
		//
		language_read(); // TODO Beim 1. stable-Release entfernen!
	
		$SESS['tree'] = array();
	
		if ( $projectid == 0 )
		{
		}
		elseif	( $projectid == -1 )
		{
			// Administration wurde ausgewählt!
	
		     $SESS['tree']['projects'] = array('text'  => lang('PROJECTS'),
		                                    'url'   => Html::url(array('action'=>'main','callAction'=>'project','projectid'=>'0')),
		                                    'icon'  => 'project_list',
		                                    'desc'  => '',
		                                    'target'=> 'cms_main' );
		                                    
			// Schleife über alle Projekte
			foreach( Project::getAll() as $id=>$name )
			{
			     $SESS['tree']['prj'.$id] = array('text'  => $name,
			                                      'parent'=> 'projects',
			                                      'url'   => Html::url(array('action'       =>'main',
			                                                                 'callAction'   =>'project',
			                                                                 'callSubaction'=>'edit',
			                                                                 'projectid'    =>$id       )),
			                                      'icon'  => 'project',
				                                 'desc'  => '',
			                                      'target'=> 'cms_main' );
			}
	
			$SESS['tree']['usergroups']   = array('text'  => lang('USER_AND_GROUPS'),
		                                   'desc'  => '',
		                                   'icon'  => 'group' );
	
			$SESS['tree']['user']     = array('text'  => lang('USER'),	
		                                   'parent'=> 'usergroups',
		                                   'desc'  => '',
		                                   'url'   => Html::url(array('action'       =>'main',
			                                                                   'callAction'   =>'user',
			                                                                   'userid'       =>'0',
			                                                                   'callSubaction'=>'listing' )),
	                                        'icon'  => 'user',
		                                   'target'=> 'cms_main' );
	
			foreach( User::listAll() as $id=>$name )
			{
				$u = new User( $id );
				$u->load();
				$SESS['tree']['user'.$id] = array('text'   => $u->name,
				                                  'url'    => Html::url(array('action'       =>'main',
			                                                                   'callAction'   =>'user',
			                                                                   'callSubaction'=>'edit',
			                                                                   'userid'       =>$id )),
				                                  'icon'   => 'user',
				                                  'desc'   => $u->fullname,
				                                  'parent' => "user",
				                                  'target' => 'cms_main' );
			}
	
		     $SESS['tree']['group']    = array('text'  => lang('GROUPS'),
		                                    'parent'=> 'usergroups',
		                                    'desc'  => '',
		                                    'url'   => Html::url(array('action'       =>'main',
			                                                                 'callAction'   =>'group',
			                                                                 'callSubaction'=>'listing',
			                                                                 'groupid'      =>'0' )),
	                                        'icon'  => 'group',
		                                    'target'=> 'cms_main' );
	
			foreach( Group::getAll() as $id=>$name )
			{
				$g = new Group( $id );
				$g->load();
				$SESS['tree']['group'.$id] = array('text'   => $g->name,
				                                   'url'    => Html::url(array('action'       =>'main',
			                                                                 'callAction'   =>'group',
			                                                                 'groupid'    =>$id       )),
				                                   'icon'   => 'group',
		                                             'desc'  => lang('GROUP').' '.$g->name,
				                                   'parent' => "group",
				                                   'target' => 'cms_main' );
	
				foreach( $g->getUsers() as $id=>$name )
				{
					$u = new User( $id );
					$u->load();
					$SESS['tree']['groupuser'.$id] = array('text'   => $u->name,
					                                  'url'    => Html::url(array('action'       =>'main',
			                                                                 'callAction'   =>'user',
			                                                                 'userid'    =>$id       )),
					                                  'icon'   => 'user',
					                                  'desc'   => $u->fullname,
					                                  'parent' => 'group'.$g->groupid,
					                                  'target' => 'cms_main' );
				}
			}
		}
		else
		{
			// Projektstruktur
			// --------------------------------------------------
			
			if	( !isset($SESS['languageid']) || intval($SESS['languageid']) == 0 )
				// Ermitteln Default-Sprache
				$SESS['languageid'] = Language::getDefaultId();
		
			// Ermitteln Default-Projektmodell
			if	( !isset($SESS['modelid']) || intval($SESS['modelid']) == 0 )
				$SESS['modelid'] = Model::getDefaultId();
	
	
			// Den Highlander-Ordner lesen (es kann nur einen geben)
			
			
			$f      = new Folder();
			$f->projectid = $projectid;
			$folder = new Folder( $f->getRootObjectId() );
			unset( $f );
			$folder->load();
			if   ( $folder->hasRight('read') )
			{
				$SESS['tree']['o'.$folder->objectid ] = array('text'   => $folder->name,
				                                   'desc'   => $folder->desc,
				                                   'icon'   => 'folder',
				                                   'url'    => Html::url(array('action'       =>'main',
			                                                                 'callAction'   =>'folder',
			                                                                 'objectid'    =>$folder->objectid       )),
				                                   'target' => 'cms_main' );
				add_folder( $folder->objectid );
			}
	
	
	
			// Templates anzeigen
			//
			if   ( $SESS['user']['is_admin'] == '1' )
			{
				$SESS['tree']['tpl'] = array('text'   => lang('TEMPLATES'),
				                          'url'    => Html::url(array('action'       =>'main',
			                                                                 'callAction'   =>'template',
			                                                                 'callSubaction'=>'listing',
			                                                                 'templateid'   =>'0' )),
		                                    'desc'  => '',
				                          'icon'   => 'tpl_list',
				                          'target' => 'cms_main' );
				foreach( Template::getAll() as $id=>$name )
				{
					$t = new Template( $id );
					$t->load();
					$SESS['tree']['tpl'.$id ] = array('text'   => $t->name,
					                                  'url'    => Html::url(array('action'       =>'main',
			                                                                 'callAction'   =>'template',
			                                                                 'templateid'    =>$id       )),
					                                  'parent' => "tpl",
		                                                 'icon'   => 'tpl',
					                                  'desc'  => '',
					                                  'target' => 'cms_main' );
					// Anzeigen der Template-Elemente
					//
					foreach( $t->getElementIds() as $elementid )
					{
						$e = new Element( $elementid );
						$e->load();
						$SESS['tree']['tpl'.$id.'el'.$elementid] = array('text'   => $e->name,
						                                                 'url'    => Html::url(array('action'       =>'main',
			                                                                 'callAction'   =>'element',
			                                                                 'callSubaction'=>'edit',
			                                                                 'templateid'=>$id,
			                                                                 'elementid'    =>$elementid       )),
				                                                           'icon'   => 'el_'.$e->type,
						                                                 'desc'  => '',
						                                                 'parent' => 'tpl'.$id,
						                                                 'target' => 'cms_main' );
					}
				}
			}
	
	
	          // Sprachvarianten
	          //
	          $l = new Language();
			$l->projectid = $projectid;
			$languages = $l->getAll();

			if	( $this->userIsAdmin() || count($languages) > 1 )
			{
				$SESS['tree']['lang'] = array('text'   => lang('LANGUAGES'),
				                           'url'    => Html::url(array('action'       =>'main',
				                                                                 'callAction'   =>'language',
				                                                                 'callSubaction'=>'listing' )),
				                           'icon'   => 'lang_list',
		                                    'desc'  => '',
				                           'target' => 'cms_main' );
		
				if	( $this->userIsAdmin() )
				{
					foreach( $languages as $languageid=>$name )
					{
						$SESS['tree']['lang'.$languageid] = array('text'   => $name,
						                                      'url'    => Html::url(array('action'       =>'main',
					                                                                 'callAction'   =>'language',
					                                                                 'callSubaction'=>'edit',
					                                                                 'languageid'    =>$languageid       )),
						                                      'parent' => 'lang',
			                                                     'icon'   => 'lang',
			                                    'desc'  => '',
						                                      'target' => 'cms_main' );
					}
				}
			}
	
	
	          // Projektvarianten
	          //
			$m = new Model();
			$m->projectid = $projectid;
		
			$models = $m->getAll();

			if	( $this->userIsAdmin() || count($models) > 1 )
			{
				$SESS['tree']['pvar'] = array('text'=> lang('MODELS'),
				                           'url'    => Html::url(array('action'       =>'main',
				                                                                 'callAction'   =>'model',
				                                                                 'callSubaction'=>'listing')),
				                           'icon'   => 'model_list',
		                                     'desc'   => '',
				                           'target' => 'cms_main' );

				if	( $this->userIsAdmin() )
				{
					foreach( $models as $id=>$name )
					{
						$SESS['tree']['pvar'.$id] = array('text'   => $name,
						                                      'url'    => Html::url(array('action'       =>'main',
					                                                                 'callAction'   =>'model',
					                                                                 'callSubaction'=>'edit',
					                                                                 'modelid'    =>$id       )),
						                                      'parent' => "pvar",
			                                                     'icon'   => 'model',
			                                    'desc'  => '',
						                                      'target' => 'cms_main' );
					}
				}
			}
	
			$SESS['tree']['other']   = array('text'  => lang('OTHER'),
		                                    'desc'  => '',
		                                   'icon'  => 'other' );
	
			if	( $SESS['user']['is_admin'] )
			{
			     $SESS['tree']['transfer'] = array('text'  => lang('FILE_TRANSFER'),
			                                   'parent'=> 'other',
			                                    'desc'  => '',
			                                   'url'   => Html::url(array('action'       =>'main',
			                                                                 'callAction'   =>'transfer')),
		                                        'icon'  => 'transfer',
			                                   'target'=> 'cms_main' );
			}
	
			$SESS['tree']['search'] = array('text'   => lang('SEARCH'),
		                                   'parent'=> 'other',
			                             'url'    => Html::url(array('action'       =>'main',
			                                                                 'callAction'   =>'search' )),
	                                       'icon'   => 'search',
		                                    'desc'  => '',
			                             'target' => 'cms_main' );
		}
			
			
		// Zu jedem Baumelement werden die Kinder ermittelt
		// Ziel: Performancesteigerung, schnellere Baumanzeige.
		
		// Wir benötigen eine Kopie von $SESS['tree'], weil innerhalb einer foreach()-Schleife
		// nicht das gleiche Array nochmal mit foreach() durchlaufen werden kann.
		$SESS['tree_kopie'] = $SESS['tree'];
		
		foreach( $SESS['tree'] as $idx=>$inh )
		{
			$SESS['tree'][$idx]['children'] = array();
			
			foreach( $SESS['tree_kopie'] as $name=>$val )
			{
				if   ( isset($val['parent']) && $val['parent'] == $idx )
				{
					$SESS['tree'][$idx]['children'][] = $name;
				}
			}
		}
		unset( $SESS['tree_kopie'] );
			
			//print_r( $SESS['tree'] ); // Debug
		
		
		
		// Ausgabe des Templates
		//
		$this->callSubAction('show');
	}


	function tree_show_element( $name,&$var )
	{
		global $SESS,$tree_tiefe,$tree_last,$PHP_SELF;
	
		$open = $SESS['tree_open'][ $SESS['projectid'] ];
		$zeile = array();
	
		$el   = $SESS['tree'][ $name ];
	
		$children = $el['children'];
	
		if   ( !isset($tree_last) )
			$tree_last=array();
	
	     $zeile['cols'] = array();
	
		for ($i=1; $i<=$tree_tiefe; $i++)
		{
			if   ($tree_last[$i-1] == 1 )
				 $zeile['cols'][] = 'blank';
			else $zeile['cols'][] = 'line';
		}
	     
		if   ( count($children) > 0 )
		{
			if   ( !in_array($name,$open) )
			{
	               if   ($tree_last[$i-1] == 1 )
	                    $zeile['image'] = 'plus_end';
	               else $zeile['image'] = 'plus';
	               $zeile['image_url'] = Html::url(array('action'=>'tree','subaction'=>'open','open'=>$name));
	          }
	          else
	          {
	               if   ($tree_last[$i-1] == 1 )
	                    $zeile['image'] = 'minus_end';
	               else $zeile['image'] = 'minus';
	               $zeile['image_url'] = Html::url(array('action'=>'tree','subaction'=>'close','close'=>$name));
	          }
	     }
	     else
	     {
	          if   ($tree_last[$i-1] == 1 )
	               $zeile['image'] = 'none_end';
	          else $zeile['image'] = 'none';
	     }
	          
	
		if   (isset($el['icon'])) $zeile['icon'] = $el['icon'];
		
		$zeile['text'] = $el['text'];
		$zeile['name'] = $name;
		$zeile['desc'] = $el['desc'];
	
		if   ( isset($el['url']) )
		{
			$zeile['url']  = $el['url' ];
			//$zeile['add']  = $el['add'];
		      
			if   ( isset($el['target']) )
				 $zeile['target'] = $el['target'];
			else $zeile['target'] = 'cms_main';
		     
		}
		
		$var['zeilen'][] = $zeile;
		
		if   ( in_array($name,$open) )
		{
			$nr = 0;
			$tree_tiefe++;
			foreach( $children as $id )
			{
				$nr++;
	
				if   ( $nr == count( $children ) )
					 $tree_last[$tree_tiefe]=1;
				else $tree_last[$tree_tiefe]=0;
	
				$this->tree_show_element( $id,&$var );
			}
			$tree_tiefe--;
		}
	}
	
	
	/**
	 * Anzeigen des Baumes
	 */
	function show()
	{
		global $tree_tiefe,$SESS,$tree_last,$var;
	
		$tree_tiefe = 0;
	
		// Unterpunkte ermitteln
		$children = array();
		foreach( $SESS['tree'] as $id=>$el )
		{
			if   ( !isset($el['parent']) )
			{
				$children[] = $id;
			}
		}
	     
		$anz=0;
		$var['zeilen']=array();
	
		foreach( $children as $child )
		{
	
			$anz++;
			if   ( $anz == count($children) )
				 $tree_last[$tree_tiefe]=1;
			else $tree_last[$tree_tiefe]=0;
	
			$this->tree_show_element( $child,&$var );
		}

		$this->setTemplateVars( $var );
		$this->forward('tree');
	}
}

?>