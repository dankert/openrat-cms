<?php

use cms\model\Element;
use cms\model\File;
use cms\model\Link;
use cms\model\BaseObject;
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
class Tree
{
    public $treeElements = array();

    private $userIsAdmin  = false;

    /**
     * Alle Elemente des Baumes
     */
    var $elements;
    var $confCache = array();

    // Konstruktor

    function __construct()
    {
        // Feststellen, ob der angemeldete Benutzer ein Administrator ist
        $user = Session::getUser();
        $this->userIsAdmin = $user->isAdmin;
    }

    function root()
    {
        $this->overview();
    }


    function overview()
    {
        $treeElement = new TreeElement();
        $treeElement->id = 0;
        $treeElement->text = lang('GLOBAL_PROJECTS');
        $treeElement->description = lang('GLOBAL_PROJECTS');
        $treeElement->action = 'projectlist';
        $treeElement->icon = 'projectlist';
        $treeElement->type = 'projects';

        $this->addTreeElement($treeElement);

        if ($this->userIsAdmin)
        {

            $treeElement = new TreeElement();
            $treeElement->text = lang('USER_AND_GROUPS');
            $treeElement->description = lang('USER_AND_GROUPS');
            $treeElement->icon = 'userlist';
            $treeElement->type = 'userandgroups';

            $this->addTreeElement($treeElement);
        }


        if ($this->userIsAdmin)
        {
            $treeElement = new TreeElement();
            $treeElement->text = lang('PREFERENCES');
            $treeElement->description = lang('PREFERENCES');
            $treeElement->icon = 'configuration';
            $treeElement->action = 'configuration';

            $this->addTreeElement($treeElement);
        }

    }


    function userandgroups()
    {
        if ( !$this->userIsAdmin )
            throw new SecurityException();

        $treeElement = new TreeElement();
        $treeElement->text = lang('GLOBAL_USER');
        $treeElement->description = lang('GLOBAL_USER');
        $treeElement->action = 'userlist';
        $treeElement->icon = 'userlist';
        $treeElement->type = 'users';

        $this->addTreeElement($treeElement);

        $treeElement = new TreeElement();
        $treeElement->text = lang('GLOBAL_GROUPS');
        $treeElement->description = lang('GLOBAL_GROUPS');
        $treeElement->action = 'grouplist';
        $treeElement->icon = 'userlist';
        $treeElement->type = 'groups';

        $this->addTreeElement($treeElement);
    }


    function projects()
    {
        // Schleife ueber alle Projekte
        foreach (Project::getAllProjects() as $id => $name) {

            $project = new Project( $id );
            $rootFolder = new Folder( $project->getRootObjectId() );
            $rootFolder->load();

            // Berechtigt für das Projekt?
            if  ( $rootFolder->hasRight( ACL_READ ) )
            {
                $treeElement = new TreeElement();

                $treeElement->internalId = $id;
                $treeElement->id = $id;
                $treeElement->text = $name;
                $treeElement->icon = 'project';
                $treeElement->action = 'project';
                $treeElement->type = 'project';
                $treeElement->description = '';

                $this->addTreeElement($treeElement);
            }
        }
    }


    function project($projectid)
    {
        $project = new Project($projectid);

        // Hoechster Ordner der Projektstruktur
        $folder = new Folder($project->getRootObjectId());
        $folder->load();

        $defaultLanguageId = $project->getDefaultLanguageId();
        $defaultModelId = $project->getDefaultModelId();

        // Ermitteln, ob der Benutzer Projektadministrator ist
        // Projektadministratoren haben das Recht, im Root-Ordner die Eigenschaften zu aendern.
        if ($folder->hasRight(ACL_PROP))
            $userIsProjectAdmin = true;

        if ($folder->hasRight(ACL_READ)) {
            $treeElement = new TreeElement();
            $treeElement->id = $folder->objectid;
            //			$treeElement->text        = $folder->name;
            $treeElement->text = lang('FOLDER_ROOT');
            $treeElement->description = lang('FOLDER_ROOT_DESC');
            $treeElement->extraId[REQ_PARAM_LANGUAGE_ID] = $defaultLanguageId;
            $treeElement->extraId[REQ_PARAM_MODEL_ID] = $defaultModelId;
            $treeElement->icon = 'folder';
            $treeElement->action = 'folder';
//			$treeElement->url         = Html::url( 'folder','',$folder->objectid,array(REQ_PARAM_TARGET=>'content') );
            $treeElement->type = 'folder';
            $treeElement->internalId = $folder->objectid;
            $this->addTreeElement($treeElement);
        }


        // Templates
        if ($userIsProjectAdmin) {
            $treeElement = new TreeElement();
            $treeElement->id = $projectid;
            $treeElement->extraId[REQ_PARAM_PROJECT_ID] = $projectid;
            $treeElement->extraId[REQ_PARAM_MODEL_ID] = $defaultModelId;
            $treeElement->extraId[REQ_PARAM_LANGUAGE_ID] = $defaultLanguageId;
            $treeElement->internalId = $projectid;
            $treeElement->text = lang('GLOBAL_TEMPLATES');
//			$treeElement->url        = Html::url('template','listing',0,array(REQ_PARAM_TARGETSUBACTION=>'listing',REQ_PARAM_TARGET=>'content'));
            $treeElement->description = lang('GLOBAL_TEMPLATES_DESC');
            $treeElement->icon = 'templatelist';
            $treeElement->action = 'templatelist';
            $treeElement->type = 'templates';
            $this->addTreeElement($treeElement);
        }


        // Sprachen
        $treeElement = new TreeElement();
        $treeElement->description = '';
        $treeElement->id = $projectid;
        $treeElement->extraId[REQ_PARAM_PROJECT_ID] = $projectid;
        $treeElement->internalId = $projectid;
        $treeElement->action = 'languagelist';
        $treeElement->text = lang('GLOBAL_LANGUAGES');
//		$treeElement->url        = Html::url('language','listing',0,array(REQ_PARAM_TARGETSUBACTION=>'listing',REQ_PARAM_TARGET=>'content'));
        $treeElement->icon = 'languagelist';
        $treeElement->description = lang('GLOBAL_LANGUAGES_DESC');

        // Nur fuer Projekt-Administratoren aufklappbar
        if ($userIsProjectAdmin)
            $treeElement->type = 'languages';

        $this->addTreeElement($treeElement);


        // Projektmodelle
        $treeElement = new TreeElement();
        $treeElement->description = '';

        // Nur fuer Projekt-Administratoren aufklappbar
        if ($userIsProjectAdmin)
            $treeElement->type = 'models';

        $treeElement->id = $projectid;
        $treeElement->internalId = $projectid;
        $treeElement->extraId[REQ_PARAM_PROJECT_ID] = $projectid;
        $treeElement->description = lang('GLOBAL_MODELS_DESC');
        $treeElement->text = lang('GLOBAL_MODELS');
//		$treeElement->url        = Html::url('model','listing',0,array(REQ_PARAM_TARGETSUBACTION=>'listing',REQ_PARAM_TARGET=>'content'));
        $treeElement->action = 'modellist';
        $treeElement->icon = 'modellist';
        $this->addTreeElement($treeElement);


/*        // Suche
        $treeElement = new TreeElement();
        $treeElement->id = $projectid;
        $treeElement->internalId = $projectid;
        $treeElement->extraId[REQ_PARAM_PROJECT_ID] = $projectid;
        $treeElement->text = lang('GLOBAL_SEARCH');
//		$treeElement->url         = Html::url('search','',0,array(REQ_PARAM_TARGET=>'content'));
        $treeElement->action = 'search';
        $treeElement->icon = 'search';
        $treeElement->description = lang('GLOBAL_SEARCH_DESC');
        $this->addTreeElement($treeElement);*/

    }


    function users()
    {
        if ( !$this->userIsAdmin )
            throw new SecurityException();


        foreach (User::getAllUsers() as $user) {
            $treeElement = new TreeElement();
            $treeElement->id = $user->userid;
            $treeElement->internalId = $user->userid;
            $treeElement->text = $user->name;
            $treeElement->action = 'user';
            $treeElement->icon = 'user';

            $desc = $user->fullname;

            if ($user->isAdmin)
                $desc .= ' (' . lang('USER_ADMIN') . ') ';
            if ($user->desc == "")
                $desc .= ' - ' . lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
            else
                $desc .= ' - ' . $user->desc;

            $treeElement->description = $desc;

            $this->addTreeElement($treeElement);
        }
    }


    function groups()
    {
        if ( !$this->userIsAdmin )
            throw new SecurityException();


        foreach (Group::getAll() as $id => $name) {
            $treeElement = new TreeElement();

            $g = new Group($id);
            $g->load();

            $treeElement->id = $id;
            $treeElement->internalId = $id;
            $treeElement->text = $g->name;
            $treeElement->icon = 'group';
            $treeElement->description = lang('GLOBAL_GROUP') . ' ' . $g->name . ': ' . implode(', ', $g->getUsers());
            $treeElement->type = 'userofgroup';
            $treeElement->action = 'group';

            $this->addTreeElement($treeElement);
        }
    }


    function userofgroup($id)
    {
        if ( !$this->userIsAdmin )
            throw new SecurityException();


        $g = new Group($id);

        foreach ($g->getUsers() as $id => $name) {
            $treeElement = new TreeElement();

            $u = new User($id);
            $u->load();
            $treeElement->id = $u->userid;
            $treeElement->internalId = $u->userid;
            $treeElement->text = $u->name;
            $treeElement->icon = 'user';
            $treeElement->action = 'user';
            $treeElement->description = $u->fullname;

            $this->addTreeElement($treeElement);
        }
    }


    function page($id)
    {
        $page = new Page($id);
        $page->languageid = $_REQUEST[REQ_PARAM_LANGUAGE_ID];
        $page->modelid = $_REQUEST[REQ_PARAM_MODEL_ID];

        $page->load();

        $template = new Template($page->templateid);

        foreach ($template->getElementIds() as $elementid) {
            $element = new Element($elementid);
            $element->load();

            if ($element->isWritable()) {
                $treeElement = new TreeElement();
                $treeElement->id = $id . '_' . $elementid;
                $treeElement->internalId = $id . '_' . $elementid;
                $treeElement->text = $element->name;
                $treeElement->action = 'pageelement';
                $treeElement->icon = 'el_' . $element->type;
                $treeElement->extraId = array('elementid' => $elementid, REQ_PARAM_LANGUAGE_ID => $page->languageid, REQ_PARAM_MODEL_ID => $page->modelid);


                $treeElement->description = lang('EL_' . $element->type);
                if ($element->desc != '')
                    $treeElement->description .= ' - ' . Text::maxLaenge(25, $element->desc);
                else
                    $treeElement->description .= ' - ' . lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');

                if (in_array($element->type, array('link', 'list', 'include'))) {
                    $treeElement->type = 'value';
                    $value = new Value();
                    $value->pageid = $page->pageid;
                    $value->element = $element;
                    $value->languageid = $page->languageid;
                    $value->publisher = new \cms\publish\PublishPreview();
                    $value->load();
                    $treeElement->internalId = $value->valueid;
                }

                $this->addTreeElement($treeElement);
            }
        }
    }


    function value($id)
    {
        //echo "id: $id";
        if ($id != 0) {
            $value = new Value();
            $value->loadWithId($id);

            $objectid = intval($value->linkToObjectId);
            if ($objectid != 0) {
                $object = new BaseObject($objectid);
                $object->load();

                $treeElement = new TreeElement();
                $treeElement->id = $id;
                $treeElement->internalId = $id;
                $treeElement->text = $object->name;
                if (in_array($object->getType(), array('page', 'folder'))) {
                    $treeElement->type = $object->getType();
                    $treeElement->internalId = $object->objectid;
                }
                $treeElement->action = $object->getType();
                $treeElement->icon = $object->getType();
                $treeElement->extraId = array(REQ_PARAM_LANGUAGE_ID => $value->languageid);

                $treeElement->description = lang('GLOBAL_' . $object->getType());
                if ($object->desc != '')
                    $treeElement->description .= ' - ' . Text::maxLaenge(25, $object->desc);
                else
                    $treeElement->description .= ' - ' . lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');

                $this->addTreeElement($treeElement);
            }
        }
    }


    function link($id)
    {
        $link = new Link($id);
        $link->load();

        $o = new BaseObject($link->linkedObjectId);
        $o->load();

        $treeElement = new TreeElement();
        $treeElement->id = $o->objectid;
        $treeElement->internalId = $o->objectid;
        $treeElement->text = $o->name;
        $treeElement->description = lang('GLOBAL_' . $o->getType()) . ' ' . $id;

        if ($o->desc != '')
            $treeElement->description .= ': ' . $o->desc;
        else
            $treeElement->description .= ' - ' . lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');

        $treeElement->action = $o->getType();
        $treeElement->icon = $o->getType();
        $treeElement->extraId = array(REQ_PARAM_LANGUAGE_ID => $_REQUEST[REQ_PARAM_LANGUAGE_ID], REQ_PARAM_MODEL_ID => $_REQUEST[REQ_PARAM_MODEL_ID]);

        // Besonderheiten fuer bestimmte Objekttypen

        if ($o->isPage) {
            // Nur wenn die Seite beschreibbar ist, werden die
            // Elemente im Baum angezeigt
            if ($o->hasRight(ACL_WRITE))
                $treeElement->type = 'pageelements';
        }
        $this->addTreeElement($treeElement);
    }


    /**
     * Laedt Elemente zu einem Ordner
     */
    function folder($id)
    {
        $f = new Folder($id);
        $t = time();
        $f->languageid = $_REQUEST[REQ_PARAM_LANGUAGE_ID];
        $f->modelid = $_REQUEST[REQ_PARAM_MODEL_ID];

        foreach ($f->getObjects() as $o) {
            // Wenn keine Leseberechtigung
            if (!$o->hasRight(ACL_READ))
                continue;

            $treeElement = new TreeElement();
            $treeElement->id = $o->objectid;
            $treeElement->internalId = $o->objectid;
            $treeElement->extraId = array(REQ_PARAM_LANGUAGE_ID => $f->languageid, REQ_PARAM_MODEL_ID => $f->modelid);
            $treeElement->text = $o->name;
            $treeElement->description = lang('GLOBAL_' . $o->getType()) . ' ' . $o->objectid;

            if ($o->desc != '')
                $treeElement->description .= ': ' . $o->desc;
            else
                $treeElement->description .= ' - ' . lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');

            $treeElement->action = $o->getType();
            $treeElement->icon = $o->getType();

            // Besonderheiten fuer bestimmte Objekttypen

            if ($o->isLink) {
                $treeElement->type = 'link';
            }

            if ($o->isPage) {
                // Nur wenn die Seite beschreibbar ist, werden die
                // Elemente im Baum angezeigt
                if ($o->hasRight(ACL_WRITE))
                    $treeElement->type = 'page';
            }

            if ($o->isFile) {
                $file = new File($o->objectid);
                $file->load();

                if (substr($file->mimeType(), 0, 6) == 'image/')
                    $treeElement->icon = 'image';
                else    $treeElement->icon = 'file';
            }

            if ($o->isFolder) {
                $treeElement->type = 'folder';
            }


            $this->addTreeElement($treeElement);
        }
    }


    function templates($projectid)
    {
        $project = new Project($projectid);

        foreach ($project->getTemplates() as $id => $name) {
            $treeElement = new TreeElement();

            $t = new Template($id);
            $t->load();
            $treeElement->text = $t->name;
            $treeElement->id = $id;
            $treeElement->icon = 'template';
            $treeElement->action = 'template';
            $treeElement->internalId = $id;
            $treeElement->extraId = array(REQ_PARAM_LANGUAGE_ID => $_REQUEST[REQ_PARAM_LANGUAGE_ID], REQ_PARAM_MODEL_ID => $_REQUEST[REQ_PARAM_MODEL_ID]);
            $treeElement->type = 'template';
            $treeElement->description = $t->name . ' (' . lang('GLOBAL_TEMPLATE') . ' ' . $id . '): ' . htmlentities(Text::maxLaenge(40, $t->src));
            $this->addTreeElement($treeElement);
        }
    }


    function template($id)
    {

        $t = new Template($id);
        $t->load();

        // Anzeigen der Template-Elemente
        //
        foreach ($t->getElementIds() as $elementid) {
            $e = new Element($elementid);
            $e->load();

            // "Code"-Element nur fuer Administratoren
            if ($e->type == 'code' && !$this->userIsAdmin)
                continue;

            $treeElement = new TreeElement();
            $treeElement->id = $elementid;
            $treeElement->internalId = $elementid;
            $treeElement->extraId = array(REQ_PARAM_LANGUAGE_ID => $_REQUEST[REQ_PARAM_LANGUAGE_ID], REQ_PARAM_MODEL_ID => $_REQUEST[REQ_PARAM_MODEL_ID]);
            $treeElement->text = $e->name;
            $treeElement->icon = 'el_' . $e->type;
            $treeElement->action = 'element';

            if ($e->desc == '')
                $desc = lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
            else
                $desc = $e->desc;
            $treeElement->description = $e->name . ' (' . lang('EL_' . $e->type) . '): ' . Text::maxLaenge(40, $desc);
            $this->addTreeElement($treeElement);
        }
    }


    /**
     * Sprachen
     */
    function languages($projectid)
    {
        // Sprachvarianten
        //
        $project = new Project($projectid);

        foreach ($project->getLanguages() as $languageid => $name) {
            $treeElement = new TreeElement();
            $treeElement->id = $languageid;
            $treeElement->internalId = $languageid;
            $treeElement->text = $name;
            $treeElement->icon = 'language';
            $treeElement->action = 'language';
            $treeElement->description = '';
            $this->addTreeElement($treeElement);
        }
    }


    // Projektvarianten
    //
    function models($projectid)
    {

        $project = new Project($projectid);

        foreach ($project->getModels() as $id => $name) {
            $treeElement = new TreeElement();
            $treeElement->id = $id;
            $treeElement->internalId = $id;
            $treeElement->text = $name;
            $treeElement->action = 'model';
            $treeElement->icon = 'model';
            $treeElement->description = '';
            $this->addTreeElement($treeElement);
        }
    }


    /**
     * Hinzufuegen eines Baum-Elementes
     * @param TreeElement Hinzuzufuegendes Baumelement
     */
    private function addTreeElement( $treeElement )
    {
        $this->treeElements[] = $treeElement;
    }
}

?>