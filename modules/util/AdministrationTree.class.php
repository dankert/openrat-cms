<?php

use cms\model\Element;
use cms\model\File;
use cms\model\Link;
use cms\model\Object;
use cms\model\Page;
use cms\model\Template;
use cms\model\User;
use cms\model\Project;
use cms\model\Group;
use cms\model\Folder;
use cms\model\Value;

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
	var $confCache = array();
	
	function root()
	{
		if	( !$this->userIsAdmin )
            throw new \SecurityException('Administration-Tree is only visible for admins.');
			
// 		$treeElement = new TreeElement();
// 		$treeElement->text        = lang('GLOBAL_ADMINISTRATION');
// 		$treeElement->description = lang('GLOBAL_ADMINISTRATION');
// 		$treeElement->type        = 'administration';
// 		$treeElement->icon        = 'administration';
		
		$this->administration();
		
		$this->autoOpen[] = 1;
	}



	function administration()
	{
		global $conf;
		$conf_config = $conf['interface']['config'];

		$treeElement = new TreeElement();
		$treeElement->id          = 0;
		$treeElement->text        = lang('GLOBAL_PROJECTS');
		$treeElement->description = lang('GLOBAL_PROJECTS');
		$treeElement->url         = Html::url('projectlist','show',0,array(REQ_PARAM_TARGET=>'content'));
		$treeElement->action      = 'projectlist'; 
		$treeElement->icon        = 'projectlist';
		$treeElement->type        = 'projects';
		$treeElement->target      = 'cms_main';
		
		$this->addTreeElement( $treeElement );


		$treeElement = new TreeElement();
		$treeElement->text        = lang('USER_AND_GROUPS');
		$treeElement->description = lang('USER_AND_GROUPS');
		$treeElement->icon        = 'userlist';
		$treeElement->type        = 'userandgroups';
		
		$this->addTreeElement( $treeElement );
//		$this->userandgroups(0);;

		if	( $conf_config['enable'] )
		{
			$treeElement = new TreeElement();
			$treeElement->text        = lang('PREFERENCES');
			$treeElement->description = lang('PREFERENCES');
			$treeElement->icon        = 'configuration';
			//$treeElement->type        = 'prefs';
			$treeElement->action      = 'configuration';
			
			$this->addTreeElement( $treeElement );
		}

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



	function userandgroups( )
	{
		$treeElement = new TreeElement();
		$treeElement->text        = lang('GLOBAL_USER');
		$treeElement->description = lang('GLOBAL_USER');
		$treeElement->url         = Html::url('user','listing',0,array(REQ_PARAM_TARGET=>'content'));
		$treeElement->action      = 'userlist'; 
		$treeElement->icon        = 'userlist';
		$treeElement->target      = 'cms_main';
		$treeElement->type        = 'users';
		
		$this->addTreeElement( $treeElement );

		$treeElement = new TreeElement();
		$treeElement->text        = lang('GLOBAL_GROUPS');
		$treeElement->description = lang('GLOBAL_GROUPS');
		$treeElement->url         = Html::url('group','listing',0,array(REQ_PARAM_TARGET=>'content'));
		$treeElement->action      = 'grouplist';
		$treeElement->icon        = 'userlist';
		$treeElement->target      = 'cms_main';
		$treeElement->type        = 'groups';

		$this->addTreeElement( $treeElement );
	}


	function projects( )
	{
		// Schleife ueber alle Projekte
		foreach(Project::getAllProjects() as $id=> $name )
		{
			$treeElement = new TreeElement();
			
			$treeElement->internalId   = $id;
			$treeElement->id           = $id;
			$treeElement->text         = $name;
			$treeElement->url          = Html::url('project','edit',$id,array(REQ_PARAM_TARGET=>'content'));
			$treeElement->icon         = 'project';
			$treeElement->action       = 'project'; 
			$treeElement->type         = 'project'; 
			$treeElement->description  = '';
			$treeElement->target       = 'cms_main';

			$this->addTreeElement( $treeElement );
		}
	}

	
	
	function project( $projectid )
	{
		$project  = new Project( $projectid );
	
		// Hoechster Ordner der Projektstruktur
		$folder = new Folder( $project->getRootObjectId() );
		$folder->load();
	
	
		// Ermitteln, ob der Benutzer Projektadministrator ist
		// Projektadministratoren haben das Recht, im Root-Ordner die Eigenschaften zu aendern.
		if   ( $folder->hasRight( ACL_PROP ) )
			$this->userIsProjectAdmin = true;
	
		if   ( $folder->hasRight( ACL_READ ) )
		{
			$treeElement = new TreeElement();
			$treeElement->id          = $folder->objectid;
			//			$treeElement->text        = $folder->name;
			$treeElement->text        = lang('FOLDER_ROOT');
			$treeElement->description = lang('FOLDER_ROOT_DESC');
			$treeElement->icon        = 'folder';
			$treeElement->action      = 'folder';
			$treeElement->url         = Html::url( 'folder','',$folder->objectid,array(REQ_PARAM_TARGET=>'content') );
			$treeElement->target      = 'content';
			$treeElement->type        = 'folder';
			$treeElement->internalId  = $folder->objectid;
			$this->addTreeElement( $treeElement );
		}
	
	
		if	( $this->userIsProjectAdmin )
		{
			// Templates
			$treeElement = new TreeElement();
			$treeElement->id         = 0;
			$treeElement->text       = lang('GLOBAL_TEMPLATES');
			$treeElement->url        = Html::url('template','listing',0,array(REQ_PARAM_TARGETSUBACTION=>'listing',REQ_PARAM_TARGET=>'content'));
			$treeElement->description= lang('GLOBAL_TEMPLATES_DESC');
			$treeElement->icon       = 'templatelist';
			$treeElement->action     = 'templatelist';
			$treeElement->target     = 'content';
			$treeElement->type       = 'templates';
			$this->addTreeElement( $treeElement );
		}
	
	
		// Sprachen
		$treeElement = new TreeElement();
		$treeElement->description= '';
		$treeElement->id          = 0;
		$treeElement->action     = 'languagelist';
		$treeElement->text       = lang('GLOBAL_LANGUAGES');
		$treeElement->url        = Html::url('language','listing',0,array(REQ_PARAM_TARGETSUBACTION=>'listing',REQ_PARAM_TARGET=>'content'));
		$treeElement->icon       = 'languagelist';
		$treeElement->description= lang('GLOBAL_LANGUAGES_DESC');
		$treeElement->target     = 'content';
	
		// Nur fuer Projekt-Administratoren aufklappbar
		if	( $this->userIsProjectAdmin )
			$treeElement->type   = 'languages';
	
		$this->addTreeElement( $treeElement );
	
	
		// Projektmodelle
		$treeElement = new TreeElement();
		$treeElement->description= '';
	
		// Nur fuer Projekt-Administratoren aufklappbar
		if	( $this->userIsProjectAdmin )
			$treeElement->type   = 'models';
	
		$treeElement->id          = 0;
		$treeElement->description= lang('GLOBAL_MODELS_DESC');
		$treeElement->text       = lang('GLOBAL_MODELS');
		$treeElement->url        = Html::url('model','listing',0,array(REQ_PARAM_TARGETSUBACTION=>'listing',REQ_PARAM_TARGET=>'content'));
		$treeElement->action     = 'modellist';
		$treeElement->icon       = 'modellist';
		$treeElement->target     = 'content';
		$this->addTreeElement( $treeElement );
	
	
		// Sonstiges
		//		$treeElement = new TreeElement();
		//		$treeElement->text       = lang('GLOBAL_OTHER');
		//		$treeElement->description= lang('GLOBAL_OTHER_DESC');
		//		$treeElement->icon       = 'other';
		//		$treeElement->type       = 'other';
		//		$this->addTreeElement( $treeElement );
	
		// Suche
		$treeElement = new TreeElement();
		$treeElement->id          = 0;
		$treeElement->text        = lang('GLOBAL_SEARCH');
		$treeElement->url         = Html::url('search','',0,array(REQ_PARAM_TARGET=>'content'));
		$treeElement->action      = 'search';
		$treeElement->icon        = 'search';
		$treeElement->description = lang('GLOBAL_SEARCH_DESC');
		$treeElement->target      = 'content';
		$this->addTreeElement( $treeElement );
	
	}
	


	function prefs_system( )
	{
		$system = array( 'time'   => date('r'),
		                 'os'     => php_uname('s'),
		                 'host'   => php_uname('n'),
		                 'release'=> php_uname('r'),
		                 'machine'=> php_uname('m'),
		                 'owner'  => get_current_user(),
		                 'pid'    => getmypid()          );
		
		foreach( $system as $key=>$value )
		{
			$treeElement = new TreeElement();
			$treeElement->text = $key.'='.$value;
			$treeElement->icon   = 'config_property';
			$this->addTreeElement( $treeElement );
			$treeElement->description = lang('SETTING')." '".$key."'".(!empty($value)?': '.$value:'');
		}

		if	( function_exists('getrusage') ) // Funktion existiert auf WIN32 nicht.
		{
			foreach( getrusage() as $name=>$value );
			{
				$treeElement = new TreeElement();
				$treeElement->text = $name.':'.$value;
				$treeElement->description = lang('SETTING')." '".$name."'".(!empty($value)?': '.$value:'');
				$treeElement->icon   = 'config_property';
				$this->addTreeElement( $treeElement );
			}
		}
	}
	
	


	function prefs_php( )
	{
		$php_prefs = array( 'version'             => phpversion(),
		                    'SAPI'                => php_sapi_name(),
		                    'session-name'        => session_name(),
		                    'magic_quotes_gpc'    => get_magic_quotes_gpc(),
		                    'magic_quotes_runtime'=> get_magic_quotes_runtime() );

		foreach( array('upload_max_filesize',
		               'file_uploads',
		               'memory_limit',
		               'max_execution_time',
		               'post_max_size',
		               'display_errors',
		               'register_globals'
		               ) as $iniName )
			$php_prefs[ $iniName ] = ini_get( $iniName );
			
		foreach( $php_prefs as $key=>$value )
		{
			$treeElement = new TreeElement();
			$treeElement->text = $key.'='.$value;
			$treeElement->description = lang('SETTING')." '".$key."'".(!empty($value)?': '.$value:'');
			$treeElement->icon   = 'config_property';
			$this->addTreeElement( $treeElement );
		}
	}
		

	
	function prefs_extensions( )
	{
		$extensions = get_loaded_extensions();
		asort( $extensions );
		 
		foreach( $extensions as $id=>$extensionName )
		{
			$treeElement = new TreeElement();
			$treeElement->text       = $extensionName;
			$treeElement->icon       = 'config_property';
			$treeElement->internalId = $id;
			$this->addTreeElement( $treeElement );
		}
	}
	
		
	
	function prefs_extension( $id )
	{
		$extensions = get_loaded_extensions();
		$functions = get_extension_funcs( $extensions[$id] );
		asort( $functions );

		foreach( $functions as $functionName )
		{
			$treeElement = new TreeElement();
			$treeElement->text = $functionName;
			$treeElement->icon   = 'config_property';
			$this->addTreeElement( $treeElement );
		}
	}
	
		
	/**
	 * Anzeigen von Einstellungen.
	 * 
	 * @param $id
	 */
	function prefs( )
	{
		global $conf;
		
		if	( !@$conf['security']['show_system_info'] )
			return;
		
		$conf_config = $conf['interface']['config'];


		$treeElement = new TreeElement();
		
		$treeElement->internalId  = -1;
		$treeElement->text        = 'OpenRat';
		$treeElement->icon        = 'configuration';

		if	( !empty($conf_config['file_manager_url']) )
			$treeElement->url         = $conf_config['file_manager_url'];
		$treeElement->target      = '_blank';
		$treeElement->description = '';
		$treeElement->type        = 'prefs_cms';
		$this->addTreeElement( $treeElement );



		if	( !empty($conf_config['show_system']) )
		{
			$treeElement = new TreeElement();
			
			$treeElement->internalId  = 0;
			$treeElement->text        = lang('GLOBAL_SYSTEM');
			$treeElement->icon        = 'configuration';
			
			$treeElement->description = '';
			$treeElement->target      = 'cms_main';
			$treeElement->type        = 'prefs_system';
			$this->addTreeElement( $treeElement );
		}


		if	( !empty($conf_config['show_interpreter']) )
		{
			$treeElement = new TreeElement();
			
			$treeElement->internalId  = 0;
			$treeElement->text        = lang('GLOBAL_PHP');
			$treeElement->icon        = 'configuration';
			
			$treeElement->description = '';
			$treeElement->target      = 'cms_main';
			$treeElement->type        = 'prefs_php';
			$this->addTreeElement( $treeElement );
		}


		if	( !empty($conf_config['show_extensions']) )
		{
			$treeElement = new TreeElement();
			
			$treeElement->internalId  = 0;
			$treeElement->text        = lang('GLOBAL_EXTENSIONS');
			$treeElement->icon        = 'configuration';
			
			$treeElement->description = '';
			$treeElement->target      = 'cms_main';
			$treeElement->type        = 'prefs_extensions';
			$this->addTreeElement( $treeElement );
		}
	}


	function prefs_cms( $id )
	{
		global $conf;
		
		if	( $id < 0 )
		{
			$tmpConf = $conf;
		}
		else
			$tmpConf = $this->confCache[$id];
			
		if	( !is_array($tmpConf) )
			$tmpConf = array('unknown');
		
		foreach( $tmpConf as $key=>$value )
		{
			if	( is_array($value) )
			{
				$this->confCache[crc32($key)] = $value;

				$treeElement = new TreeElement();
				
				$treeElement->internalId  = crc32($key);
				$treeElement->text        = $key;
//				if	( $id == 0 )
//					$treeElement->url         = Html::url('main','prefs',0,array('conf'=>$key));
				$treeElement->icon        = 'configuration';
				
				$treeElement->description = count($value).' '.lang('SETTINGS');
				$treeElement->target      = 'cms_main';
				$treeElement->type        = 'prefs_cms';
				$this->addTreeElement( $treeElement );
			}
			else
			{
				// Die PHP-funktion 'parse_ini_file()' liefert alle Einstellungen leider nur als String
				// Daher weiß man hier nicht, ob '1' nun '1' oder 'true' heißen soll.
				if	( $value=='' )
					// Anzeige 'Leer'
					$value = lang('EMPTY');
				elseif	( $value=='0' )
					// Anzeige 'Nein'
					$value = $value.' ('.lang('IS_NO').')';
				elseif	( $value=='1' )
					// Anzeige 'Ja'
					$value = '+'.$value.' ('.lang('IS_YES').')';
				elseif	( is_numeric($value) )
					// Anzeige numerische Werte
					$value = ($value>0?'+':'').$value;
				else
					// Anzeige von Zeichenketten
					$value = $value;
					
				$this->confCache[crc32($key)] = $value;

				if	( strpos($key,'pass') !== FALSE )
					$value = '***'; // Kennwörter nicht anzeigen
				
				$treeElement = new TreeElement();
				$treeElement->text        = $key.': '.$value;
				$treeElement->icon        = 'config_property';
				$treeElement->description = lang('SETTING')." '".$key."'".(!empty($value)?': '.$value:'');
					
				$this->addTreeElement( $treeElement );
			}
		}
	}


	function users( )
	{	
		foreach( User::getAllUsers() as $user )
		{
			$treeElement = new TreeElement();
			$treeElement->id          = $user->userid;
			$treeElement->internalId  = $user->userid;
			$treeElement->text        = $user->name;
			$treeElement->url         = Html::url('user','edit',
			                                      $user->userid,array(REQ_PARAM_TARGET=>'content') );
			$treeElement->action      = 'user';
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


	function groups( )
	{

		foreach( Group::getAll() as $id=>$name )
		{
			$treeElement = new TreeElement();
			
			$g = new Group( $id );
			$g->load();

			$treeElement->id          = $id;
			$treeElement->internalId  = $id;
			$treeElement->text        = $g->name;
			$treeElement->url         = Html::url('group','edit',$id,
			                                      array(REQ_PARAM_TARGET=>'content') );
			$treeElement->icon        = 'group';
	     	$treeElement->description = lang('GLOBAL_GROUP').' '.$g->name.': '.implode(', ',$g->getUsers());
			$treeElement->target      = 'cms_main';
			$treeElement->type        = 'userofgroup';
			$treeElement->action      = 'group';

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
			$treeElement->id          = $u->userid;
			$treeElement->text        = $u->name;
			$treeElement->url         = Html::url('user','edit',$id,array(REQ_PARAM_TARGET=>'content'));
			$treeElement->icon        = 'user';
			$treeElement->action      = 'user'; 
			$treeElement->description = $u->fullname;
			$treeElement->target      = 'cms_main';

			$this->addTreeElement( $treeElement );
		}
	}



    function page( $id )
    {
        $page = new Page( $id );
        $page->load();

        $template = new Template( $page->templateid );

        foreach( $template->getElementIds() as $elementid )
        {
            $element = new Element( $elementid );
            $element->load();

            if	( $element->isWritable() )
            {
                $treeElement = new TreeElement();
                $treeElement->id   = $id.'_'.$elementid;
                $treeElement->extraId['elementid'] =  $elementid;
                $treeElement->text = $element->name;
                $treeElement->url  = Html::url('pageelement','edit',
                    $id.'_'.$elementid,
                    array('elementid'=>$elementid,
                        REQ_PARAM_TARGETSUBACTION=>'edit',REQ_PARAM_TARGET=>'content'));
                $treeElement->action = 'pageelement';
                $treeElement->icon = 'el_'.$element->type;

                $treeElement->description = lang('EL_'.$element->type);
                if	( $element->desc != '' )
                    $treeElement->description .= ' - '.Text::maxLaenge( 25,$element->desc );
                else
                    $treeElement->description .= ' - '.lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
                $treeElement->target      = 'content';

                if	( in_array($element->type,array('link','list','include') ) )
                {
                    $treeElement->type = 'value';
                    $value = new Value();
                    $value->pageid  = $page->pageid;
                    $value->element = $element;
                    $value->load();
                    $treeElement->internalId = $value->valueid;
                }

                $this->addTreeElement( $treeElement );
            }
        }
    }


    function value( $id )
    {
        //echo "id: $id";
        if	( $id != 0 )
        {
            $value = new Value();
            $value->loadWithId( $id );

            $objectid = intval($value->linkToObjectId);
            if	( $objectid != 0 )
            {
                $object = new Object( $objectid );
                $object->load();

                $treeElement = new TreeElement();
                $treeElement->id         = $id;
                $treeElement->text       = $object->name;
                if	( in_array($object->getType(),array('page','folder')))
                {
                    $treeElement->type       = $object->getType();
                    $treeElement->internalId = $object->objectid;
                }
                $treeElement->url    = Html::url($object->getType(),'',$objectid,array(REQ_PARAM_TARGET=>'content'));
                $treeElement->action = $object->getType();
                $treeElement->icon   = $object->getType();

                $treeElement->description = lang('GLOBAL_'.$object->getType());
                if	( $object->desc != '' )
                    $treeElement->description .= ' - '.Text::maxLaenge( 25,$object->desc );
                else
                    $treeElement->description .= ' - '.lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
                $treeElement->target      = 'content';

                $this->addTreeElement( $treeElement );
            }
        }
    }


    function link( $id )
    {
        $link = new Link( $id );
        $link->load();

        if	( $link->isLinkToObject )
        {
            $o = new Object( $link->linkedObjectId );
            $o->load();

            $treeElement = new TreeElement();
            $treeElement->id         = $o->objectid;
            $treeElement->internalId = $o->objectid;
            $treeElement->target     = 'content';
            $treeElement->text       = $o->name;
            $treeElement->description= lang( 'GLOBAL_'.$o->getType() ).' '.$id;

            if	( $o->desc != '' )
                $treeElement->description .= ': '.$o->desc;
            else
                $treeElement->description .= ' - '.lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');

            $treeElement->url        = Html::url($o->getType(),'',$o->objectid,array(REQ_PARAM_TARGET=>'content') );
            $treeElement->action     = $o->getType();
            $treeElement->icon       = $o->getType();

            // Besonderheiten fuer bestimmte Objekttypen

            if   ( $o->isPage )
            {
                // Nur wenn die Seite beschreibbar ist, werden die
                // Elemente im Baum angezeigt
                if   ( $o->hasRight( ACL_WRITE ) )
                    $treeElement->type='pageelements';
            }
            $this->addTreeElement( $treeElement );
        }
    }


    /**
     * Laedt Elemente zu einem Ordner
     * @return Array
     */
    function folder( $id )
    {
        global
        $SESS,
        $projectid;

        $f = new Folder( $id );
        $t = time();

        foreach( $f->getObjects() as $o )
        {
            // Wenn keine Leseberechtigung
            if	( !$o->hasRight( ACL_READ ) )
                continue;

            $treeElement = new TreeElement();
            $treeElement->id         = $o->objectid;
            $treeElement->internalId = $o->objectid;
            $treeElement->target     = 'content';
            $treeElement->text       = $o->name;
            $treeElement->description= lang( 'GLOBAL_'.$o->getType() ).' '.$o->objectid;

            if	( $o->desc != '' )
                $treeElement->description .= ': '.$o->desc;
            else
                $treeElement->description .= ' - '.lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');

            $treeElement->url        = Html::url( $o->getType(),'',$o->objectid,array('readit'=>'__OID__'.$o->objectid.'__',REQ_PARAM_TARGET=>'content') );
            $treeElement->action     = $o->getType();
            $treeElement->icon       = $o->getType();

            // Besonderheiten fuer bestimmte Objekttypen

            if   ( $o->isLink )
            {
                $treeElement->type='link';
            }

            if   ( $o->isPage )
            {
                // Nur wenn die Seite beschreibbar ist, werden die
                // Elemente im Baum angezeigt
                if   ( $o->hasRight( ACL_WRITE ) )
                    $treeElement->type='page';
            }

            if   ( $o->isFile )
            {
                $file = new File( $o->objectid );
                $file->load();

                if	( substr($file->mimeType(),0,6) == 'image/' )
                    $treeElement->icon = 'image';
                else	$treeElement->icon = 'file';
            }

            if   ( $o->isFolder )
            {
                $treeElement->type = 'folder';
            }


            $this->addTreeElement( $treeElement );
        }
    }


    function project_old()
    {
        $language = Session::getProjectLanguage();
        $model    = Session::getProjectModel();
        $user     = Session::getUser();

        $project  = Session::getProject();
        $this->projectid = $project->projectid;

        // Hoechster Ordner der Projektstruktur
        $folder = new Folder( $project->getRootObjectId() );
        $folder->load();


        // Ermitteln, ob der Benutzer Projektadministrator ist
        // Projektadministratoren haben das Recht, im Root-Ordner die Eigenschaften zu aendern.
        if   ( $folder->hasRight( ACL_PROP ) )
            $this->userIsProjectAdmin = true;

        if   ( $folder->hasRight( ACL_READ ) )
        {
            $treeElement = new TreeElement();
            $treeElement->id          = $folder->objectid;
            //			$treeElement->text        = $folder->name;
            $treeElement->text        = lang('FOLDER_ROOT');
            $treeElement->description = lang('FOLDER_ROOT_DESC');
            $treeElement->icon        = 'folder';
            $treeElement->action      = 'folder';
            $treeElement->url         = Html::url( 'folder','',$folder->objectid,array(REQ_PARAM_TARGET=>'content') );
            $treeElement->target      = 'content';
            $treeElement->type        = 'folder';
            $treeElement->internalId  = $folder->objectid;
            $this->addTreeElement( $treeElement );
        }


        if	( $this->userIsProjectAdmin )
        {
            // Templates
            $treeElement = new TreeElement();
            $treeElement->id         = 0;
            $treeElement->text       = lang('GLOBAL_TEMPLATES');
            $treeElement->url        = Html::url('template','listing',0,array(REQ_PARAM_TARGETSUBACTION=>'listing',REQ_PARAM_TARGET=>'content'));
            $treeElement->description= lang('GLOBAL_TEMPLATES_DESC');
            $treeElement->icon       = 'templatelist';
            $treeElement->action     = 'templatelist';
            $treeElement->target     = 'content';
            $treeElement->type       = 'templates';
            $this->addTreeElement( $treeElement );
        }


        // Sprachen
        $treeElement = new TreeElement();
        $treeElement->description= '';
        $treeElement->id          = 0;
        $treeElement->action     = 'languagelist';
        $treeElement->text       = lang('GLOBAL_LANGUAGES');
        $treeElement->url        = Html::url('language','listing',0,array(REQ_PARAM_TARGETSUBACTION=>'listing',REQ_PARAM_TARGET=>'content'));
        $treeElement->icon       = 'languagelist';
        $treeElement->description= lang('GLOBAL_LANGUAGES_DESC');
        $treeElement->target     = 'content';

        // Nur fuer Projekt-Administratoren aufklappbar
        if	( $this->userIsProjectAdmin )
            $treeElement->type   = 'languages';

        $this->addTreeElement( $treeElement );


        // Projektmodelle
        $treeElement = new TreeElement();
        $treeElement->description= '';

        // Nur fuer Projekt-Administratoren aufklappbar
        if	( $this->userIsProjectAdmin )
            $treeElement->type   = 'models';

        $treeElement->id          = 0;
        $treeElement->description= lang('GLOBAL_MODELS_DESC');
        $treeElement->text       = lang('GLOBAL_MODELS');
        $treeElement->url        = Html::url('model','listing',0,array(REQ_PARAM_TARGETSUBACTION=>'listing',REQ_PARAM_TARGET=>'content'));
        $treeElement->action     = 'modellist';
        $treeElement->icon       = 'modellist';
        $treeElement->target     = 'content';
        $this->addTreeElement( $treeElement );


        // Sonstiges
//		$treeElement = new TreeElement();
//		$treeElement->text       = lang('GLOBAL_OTHER');
//		$treeElement->description= lang('GLOBAL_OTHER_DESC');
//		$treeElement->icon       = 'other';
//		$treeElement->type       = 'other';
//		$this->addTreeElement( $treeElement );

        // Suche
        $treeElement = new TreeElement();
        $treeElement->id          = 0;
        $treeElement->text        = lang('GLOBAL_SEARCH');
        $treeElement->url         = Html::url('search','',0,array(REQ_PARAM_TARGET=>'content'));
        $treeElement->action      = 'search';
        $treeElement->icon        = 'search';
        $treeElement->description = lang('GLOBAL_SEARCH_DESC');
        $treeElement->target      = 'content';
        $this->addTreeElement( $treeElement );

    }


    function templates()
    {
        foreach( Template::getAll() as $id=>$name )
        {
            $treeElement = new TreeElement();

            $t = new Template( $id );
            $t->load();
            $treeElement->text        = $t->name;
            $treeElement->id          = $id;
            $treeElement->url         = Html::url('template','src',$id,array(REQ_PARAM_TARGETSUBACTION=>'src',REQ_PARAM_TARGET=>'content'));
            $treeElement->icon        = 'template';
            $treeElement->action      = 'template';
            $treeElement->target      = 'content';
            $treeElement->internalId  = $id;
            $treeElement->type        = 'template';
            $treeElement->description = $t->name.' ('.lang('GLOBAL_TEMPLATE').' '.$id.'): '.htmlentities(Text::maxLaenge( 40,$t->src ));
            $this->addTreeElement( $treeElement );
        }
    }


    function template( $id )
    {

        $t = new Template( $id );
        $t->load();

        // Anzeigen der Template-Elemente
        //
        foreach( $t->getElementIds() as $elementid )
        {
            $e = new Element( $elementid );
            $e->load();

            // "Code"-Element nur fuer Administratoren
            if	( $e->type == 'code' && !$this->userIsAdmin )
                continue;

            $treeElement = new TreeElement();
            $treeElement->id          = $elementid;
            $treeElement->text        = $e->name;
            $treeElement->url         = Html::url('element','',$elementid,array(REQ_PARAM_TARGET=>'content') );
            $treeElement->icon        = 'el_'.$e->type;
            $treeElement->action      = 'element';

            if	( $e->desc == '' )
                $desc = lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
            else
                $desc = $e->desc;
            $treeElement->description = $e->name.' ('.lang('EL_'.$e->type).'): '.Text::maxLaenge( 40,$desc );
            $treeElement->target      = 'content';
            $this->addTreeElement( $treeElement );
        }
    }


    /**
     * Sprachen
     */
    function languages()
    {
        // Sprachvarianten
        //
        $l = Session::getProjectLanguage();
        $languages = $l->getAll();

        foreach( $languages as $languageid=>$name )
        {
            $treeElement = new TreeElement();
            $treeElement->id          = $languageid;
            $treeElement->text         = $name;
            $treeElement->url          = Html::url('language','edit',$languageid,
                array(REQ_PARAM_TARGETSUBACTION=>'edit',REQ_PARAM_TARGET=>'content') );
            $treeElement->icon         = 'language';
            $treeElement->action       = 'language';
            $treeElement->description  = '';
            $treeElement->target       = 'content';
            $this->addTreeElement( $treeElement );
        }
    }


    // Projektvarianten
    //
    function models()
    {
        $m = Session::getProjectModel();
        $models = $m->getAll();

        foreach( $models as $id=>$name )
        {
            $treeElement = new TreeElement();
            $treeElement->id          = $id;
            $treeElement->text        = $name;
            $treeElement->url         = Html::url('model','edit',$id,
                array(REQ_PARAM_TARGETSUBACTION=>'edit',REQ_PARAM_TARGET=>'content'));
            $treeElement->action      = 'model';
            $treeElement->icon        = 'model';
            $treeElement->description = '';
            $treeElement->target      = 'content';
            $this->addTreeElement( $treeElement );
        }
    }


    function other()
    {
// Deaktiviert, da
// - Dateien auf den Server laden unverst�ndlich/undurchsichtig erscheint
// - M�glichkeit zum Entpacken von ZIP/TAR online besteht.
//		if	( $this->userIsProjectAdmin )
//		{
//			$treeElement = new TreeElement();
//			$treeElement->text        = lang('GLOBAL_FILE_TRANSFER');
//			$treeElement->description = lang('GLOBAL_FILE_TRANSFER_DESC');
//			$treeElement->url         = Html::url('main','transfer');
//			$treeElement->icon        = 'transfer';
//			$treeElement->target      = 'content';
//			$this->addTreeElement( $treeElement );
//		}

        $treeElement = new TreeElement();
        $treeElement->id          = 0;
        $treeElement->text        = lang('GLOBAL_SEARCH');
        $treeElement->url         = Html::url('search');
        $treeElement->icon        = 'search';
        $treeElement->action      = 'search';
        $treeElement->description = lang('GLOBAL_SEARCH_DESC');
        $treeElement->target      = 'content';
        $this->addTreeElement( $treeElement );


        $treeElement = new TreeElement();
        $treeElement->id          = 0;
        $treeElement->text        = lang('USER_YOURPROFILE');
        $treeElement->url         = Html::url('profile','edit',0,array(REQ_PARAM_TARGET=>'content'));
        $treeElement->icon        = 'user';
        $treeElement->action      = 'profile';
        $treeElement->description = lang('USER_PROFILE_DESC');
        $treeElement->target      = 'content';
        $this->addTreeElement( $treeElement );


        $treeElement = new TreeElement();
        $treeElement->id          = 0;
        $treeElement->text        = lang('GLOBAL_PROJECTS');
        $treeElement->url         = Html::url('index','projectmenu',0,array(REQ_PARAM_TARGET=>'content'));
        $treeElement->icon        = 'project';
        $treeElement->description = lang('GLOBAL_PROJECTS');
        $treeElement->target      = 'content';
        $this->addTreeElement( $treeElement );
    }

}

?>