<?php

namespace cms\action;

namespace cms\action;
use cms\model\Acl;
use cms\model\Element;
use cms\model\Project;
use cms\model\Template;
use cms\model\Page;


use cms\model\TemplateModel;
use cms\generator\PublishPublic;
use language\Messages;
use util\exception\ValidationException;
use util\Session;
use util\Html;
use util\Text;

// OpenRat Content Management System
// Copyright (C) 2002-2009 Jan Dankert
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
 * Action-Klasse zum Bearbeiten einer Seitenvorlage.
 * 
 * @author Jan Dankert
 * @package openrat.actions
 */

class TemplateAction extends BaseAction
{
	public $security = Action::SECURITY_USER;
	
	var $defaultSubAction = 'show';

    /**
     * @var Template
     */
	private $template;
	private $element;


	function __construct()
	{
        parent::__construct();

    }


    public function init()
    {
		$this->template = new Template( $this->getRequestId() );

		$this->template->load();

		$this->setTemplateVar( 'templateid',$this->template->templateid );

		if	( intval($this->getRequestVar('elementid')) != 0 )
		{
			$this->element = new Element( $this->getRequestVar('elementid') );
			$this->element->load();
			$this->setTemplateVar( 'elementid',$this->element->elementid );
		}
	}


    /**
     * Save the new template source into the database.
     */
	public function srcPost()
	{
        $modelId = $this->getRequestId('modelid');

        $templatemodel = new TemplateModel($this->template->templateid, $modelId);
        $templatemodel->load();

        $newSource = $this->request->getRequestVar('source',OR_FILTER_RAW);

        /*
        // Not useful any more. Technical name of a element should not be changed.
        foreach ($this->template->getElementNames() as $elid => $elname) {
            $newSource = str_replace('{{' . $elname . '}}', '{{' . $elid . '}}', $newSource);
            $newSource = str_replace('{{->' . $elname . '}}', '{{->' . $elid . '}}', $newSource);
            $newSource = str_replace('{{' . \cms\base\Language::lang('TEMPLATE_SRC_IFEMPTY') . ':' . $elname . ':' . \cms\base\Language::lang('TEMPLATE_SRC_BEGIN') . '}}', '{{IFEMPTY:' . $elid . ':BEGIN}}', $newSource);
            $newSource = str_replace('{{' . \cms\base\Language::lang('TEMPLATE_SRC_IFEMPTY') . ':' . $elname . ':' . \cms\base\Language::lang('TEMPLATE_SRC_END') . '}}', '{{IFEMPTY:' . $elid . ':END}}', $newSource);
            $newSource = str_replace('{{' . \cms\base\Language::lang('TEMPLATE_SRC_IFNOTEMPTY') . ':' . $elname . ':' . \cms\base\Language::lang('TEMPLATE_SRC_BEGIN') . '}}', '{{IFNOTEMPTY:' . $elid . ':BEGIN}}', $newSource);
            $newSource = str_replace('{{' . \cms\base\Language::lang('TEMPLATE_SRC_IFNOTEMPTY') . ':' . $elname . ':' . \cms\base\Language::lang('TEMPLATE_SRC_END') . '}}', '{{IFNOTEMPTY:' . $elid . ':END}}', $newSource);
        }
        */

        $templatemodel->src = $newSource;

       $templatemodel->save();

		$this->addNotice('template',$this->template->name,'SAVED',OR_NOTICE_OK);
	}




	function srcelementPost()
	{
		$tplModel = $this->template->loadTemplateModelFor( $this->request->getRequestVar(REQ_PARAM_MODEL_ID));

		$elementToAdd = new Element( $this->getRequestVar('elementid') );
		$elementToAdd->load();

		switch( $this->getRequestVar('type') )
		{
			case 'addelement':
				$tplModel->src .= "\n".'{{'.$elementToAdd->name.'}}';
				break;
		
			default:
				throw new ValidationException('type');
		}
		
		$tplModel->save();

		$this->addNoticeFor($this->template,Messages::SAVED);
	}


	// Speichern der Template-Eigenschaftens
	//
	function propPost()
	{
		
		if	($this->getRequestVar('name') == "")
		{
			$this->addValidationError('name');
			$this->callSubAction('name');
			return;
		}
		else
		{
			$this->template->name = $this->getRequestVar('name');
			$this->template->save();
			$this->addNotice('template',$this->template->name,'SAVED',OR_NOTICE_OK);
		}
	}


	// Speichern der Template-Eigenschaftens
	//
	function removePost()
	{
		if   ( $this->getRequestVar('delete') != '' )
		{
			$this->template->delete();
			$this->addNotice('template',$this->template->name,'DELETED',OR_NOTICE_OK);
		}
		else
		{
			$this->addNotice('template',$this->template->name,'CANCELED',OR_NOTICE_WARN);
		}
	}


	/**
	 * Entfernen der Vorlage
	 */
	function removeView()
	{
		$this->setTemplateVar('name',$this->template->name);
	}


	/**
	 * Anzeigen aller Seiten der Vorlage.
	 */
	function infoView()
	{
		$pages = array();
		$pageids = $this->template->getDependentObjectIds();
		
		foreach( $pageids as $pageid )
		{
			$page = new Page($pageid);
			$page->load();
			
			$pages[$pageid] = $page->name;
		}
		
		$this->setTemplateVar('pages',$pages);
		$this->setTemplateVar('id'   ,$this->template->templateid);
	}


	/**
     * Speichern der Dateiendung
     */
	public function extensionPost()
	{
        $project = new Project( $this->template->projectid );
        $models = $project->getModels();

        $extensions = array();
        foreach( $models as $modelId => $modelName ) {

            $input = $this->getRequestVar( $modelName );

            // Validierung: Werte dürfen nicht doppelt vorkommen.
            if ( in_array($input, $extensions) )
            {
                $this->addNotice('template',$this->template->name,'DUPLICATE_INPUT','error');
                throw new \util\exception\ValidationException( $modelName );
            }

            $extensions[ $modelId ] = $input;
        }

        foreach( $models as $modelId => $modelName ) {

            $templatemodel = new TemplateModel($this->template->templateid, $modelId);
            $templatemodel->load();

            $templatemodel->extension = $extensions[ $modelId ];

            $templatemodel->save();
        }

		$this->addNotice('template',$this->template->name,'SAVED','ok');
	}



	function addelView()
	{
		// Die verschiedenen Element-Typen
		$types = array();

		foreach( Element::getAvailableTypes() as $typeid => $t )
		{
			$types[ $typeid ] = 'EL_'.$t;
		}

		// Code-Element nur fuer Administratoren (da voller Systemzugriff!)		
		if	( !$this->userIsAdmin() )
			unset( $types[Element::ELEMENT_TYPE_CODE] );

		// Auswahlmoeglichkeiten:
		$this->setTemplateVar('types',$types);

		// Vorbelegung:
		$this->setTemplateVar('typeid',Element::ELEMENT_TYPE_TEXT);
	}
	
	
	
	/*
	 * Neues Element hinzufuegen.
	 */
	function addelPost()
	{

		$name = $this->getRequestVar('name',OR_FILTER_ALPHANUM);

		if  ( empty($name) )
		    throw new \util\exception\ValidationException('name');

		$newElement = $this->template->addElement( $name,$this->getRequestVar('description'),$this->getRequestVar('typeid') );

		if	( $this->hasRequestVar('addtotemplate') )
		{
		    $project  = new Project( $this->template->projectid);
		    $modelIds = $project->getModelIds();

		    foreach( $modelIds as $modelId )
            {
                $template = new Template( $this->template->templateid );
                $templateModel = $template->loadTemplateModelFor( $modelId );
                $templateModel->load();
                $templateModel->src .= "\n".'{{'.$newElement->name.'}}';
                $templateModel->save();
            }

		}

		$this->addNotice('template',$this->template->name,'SAVED',OR_NOTICE_OK);
	}


	
	/**
	 * Eigenschaften einer Vorlage anzeigen
	 */
	function propView()
	{
		$this->setTemplateVar('name'     , $this->template->name       );
		$this->setTemplateVar('extension','' );
		$this->setTemplateVar('mime_type','' );
	}



	/**
	 * Extension einer Vorlage anzeigen
	 */
	function extensionView()
	{
        $project = new Project( $this->template->projectid );
        $models = $project->getModels();

        $modelSrc = array();

        foreach( $models as $modelId => $modelName )
        {
            $templatemodel = new TemplateModel( $this->template->templateid, $modelId );
            $templatemodel->load();

            $modelSrc[ $modelId ] = array(
                'name'     =>$modelName,
                'extension'=>$templatemodel->extension
            );
        }

        $this->setTemplateVar( 'extension',$modelSrc );
	}

	
	
	/**
	 * Anzeigen des Inhaltes, der Inhalt wird samt Header direkt
	 * auf die Standardausgabe geschrieben
	 */
	function previewView()
	{
	    $project = new Project( $this->template->projectid);

        $this->setTemplateVar('models',$project->getModels() );

		$modelId = $this->request->getRequestVar(REQ_PARAM_MODEL_ID);
		if   ( ! $modelId )
			$modelId = Project::create( $this->template->projectid )->getDefaultModelId();

        $this->setTemplateVar('modelid'   ,$modelId);

		$this->setTemplateVar('preview_url',Html::url('template','show',$this->template->templateid,array('target'=>'none','modelid'=>$modelId ) ) );
	}
	
	


	/**
	 * Voransicht einer Vorlage
	 */
	function showView()
	{
		$modelId = $this->request->getRequestVar(REQ_PARAM_MODEL_ID);
		if   ( ! $modelId )
			$modelId = Project::create( $this->template->projectid )->getDefaultModelId();

		$templatemodel = new TemplateModel($this->template->templateid, $modelId);
		$templatemodel->load();

		header('Content-Type: '.$templatemodel->mimeType().'; charset=UTF-8' );
		$text = $templatemodel->src;
	
		foreach( $this->template->getElementIds() as $elid )
		{
			$element = new Element( $elid );
			$element->load();

			$text = str_replace('{{'.$elid.'}}',$element->name,
			                    $text );
			$text = str_replace('{{->'.$elid.'}}','',
			                    $text );

			$text = str_replace('{{IFEMPTY:'.$elid.':BEGIN}}','',
			                    $text );
			$text = str_replace('{{IFEMPTY:'.$elid.':END}}','',
			                    $text );

			$text = str_replace('{{IFNOTEMPTY:'.$elid.':BEGIN}}','',
			                    $text );
			$text = str_replace('{{IFNOTEMPTY:'.$elid.':END}}','',
			                    $text );
			                    
			unset( $element );
		}
	
		$this->setTemplateVar('text',$text);
	}


	/**
	 * Bearbeiten einer Vorlage
	 */
	function editView()
	{
		// Elemente laden 
		$list = array();
	
		foreach( $this->template->getElementIds() as $elid )
		{
			$element = new Element( $elid );
			$element->load();

			$list[$elid] = array();
			$list[$elid]['id'         ] = $elid;
			$list[$elid]['name'       ] = $element->name;
			$list[$elid]['description'] = $element->desc;
			$list[$elid]['type'       ] = $element->getTypeName();
			$list[$elid]['typeid'     ] = $element->typeid;

			unset( $element );
		}
		$this->setTemplateVar('elements',$list);	
		
		
        $project = new Project( $this->template->projectid );


        $models = array();

        foreach( $project->getModels() as $modelId => $modelName )
        {
            $templatemodel = new TemplateModel( $this->template->templateid, $modelId );
            $templatemodel->load();

            $text = $templatemodel->src;

            foreach( $this->template->getElementIds() as $elid )
            {
                $element = new Element( $elid );
                $element->load();

                // Fix old stuff:
                $text = str_replace('{{'.$elid.'}}',
                    '{{'.$element->name.'}}',
                    $text );
                $text = str_replace('{{->'.$elid.'}}',
                    '{{goto.'.$element->name.'}}',
                    $text );
                $text = str_replace('{{IFEMPTY:'.$elid.':BEGIN}}',
                    '{{^'.$element->name.'}}',
                    $text );
                $text = str_replace('{{IFEMPTY:'.$elid.':END}}',
                    '{{/'.$element->name.'}}',
                    $text );
                $text = str_replace('{{IFNOTEMPTY:'.$elid.':BEGIN}}',
                    '{{#'.$element->name.'}}',
                    $text );
                $text = str_replace('{{IFNOTEMPTY:'.$elid.':END}}',
                    '{{/'.$element->name.'}}',
                    $text );
            }

            $models[ $modelId ] = array(
                'name'    => $modelName,
                'source'  => $text,
                'modelid' => $modelId
            );
        }

        $this->setTemplateVar( 'models',$models );


    }


	function srcelementView()
	{
		$elements           = array();
		$writable_elements = array();
	
		foreach( $this->template->getElementIds() as $elid )
		{
			$element = new Element( $elid );
			$element->load();

			$elements[$elid] = $element->name;

			if	( $element->isWritable() )
				$writable_elements[$elid] = $element->name;
		}

		$this->setTemplateVar('elements'         ,$elements         );
		$this->setTemplateVar('writable_elements',$writable_elements);
	}
	
	
	
	/**
	  * Anzeigen des Template-Quellcodes
	  */
	function srcView()
	{
	    $project = new Project( $this->template->projectid );
	    $modelId = $this->getRequestId('modelid');

	    $modelSrc = array();

        $templatemodel = new TemplateModel( $this->template->templateid, $modelId );
        $templatemodel->load();

        $text = $templatemodel->src;

        foreach( $this->template->getElementIds() as $elid )
        {
            $element = new Element( $elid );
            $element->load();

            // Fix old stuff:
            $text = str_replace('{{'.$elid.'}}',
                '{{'.$element->name.'}}',
                $text );
            $text = str_replace('{{->'.$elid.'}}',
                '{{goto.'.$element->name.'}}',
                $text );
            $text = str_replace('{{IFEMPTY:'.$elid.':BEGIN}}',
                '{{^'.$element->name.'}}',
                $text );
            $text = str_replace('{{IFEMPTY:'.$elid.':END}}',
                '{{/'.$element->name.'}}',
                $text );
            $text = str_replace('{{IFNOTEMPTY:'.$elid.':BEGIN}}',
                '{{#'.$element->name.'}}',
                $text );
            $text = str_replace('{{IFNOTEMPTY:'.$elid.':END}}',
                '{{/'.$element->name.'}}',
                $text );
        }

        $this->setTemplateVar( 'modelid',$modelId );
        $this->setTemplateVar( 'source' ,$text );

    }


	// Anzeigen aller Templates
	//
	function listingView()
	{
		$list = array();

        $project = new Project( $this->template->projectid );

		foreach( $project->getTemplates() as $id=>$name )
		{
			$list[$id] = array();
			$list[$id]['name'] = $name;
			$list[$id]['url' ] = Html::url('template','el',$id,array());
		}
		
//		$var['templatemodelid'] = htmlentities( $id   );
//		$var['text']            = htmlentities( $text );
		$this->setTemplateVar('templates',$list);
	}

	
	/**
	 * Anzeigen der Maske zum Veröffentlichen.
	 */
	public function pubView()
	{
		
	}
	
	
	
	/**
	 * Veröffentlichen.
	 */
	public function pubPost()
	{
		$objectIds = $this->template->getDependentObjectIds();

		Session::close();

		$publisher = new PublishPublic( $this->template->projectid );
		
		foreach( $objectIds as $objectid )
		{
			$page = new Page( $objectid );
			$page->load();
			
			if	( !$page->hasRight( Acl::ACL_PUBLISH ) )
				continue;
			
			$page->publisher = $publisher;
			$page->publish();
        }

        $this->addNotice( 'template',
            $this->template->name,
            'PUBLISHED',
            OR_NOTICE_OK,
            array(),
            array_map( function($obj) {
                return $obj['full_filename'];
            },$publisher->publishedObjects) );

        $publisher->close();
    }
	
	

}