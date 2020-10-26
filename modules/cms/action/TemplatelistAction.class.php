<?php

namespace cms\action;

use cms\model\Element;
use cms\model\Project;
use cms\model\Template;
use cms\model\TemplateModel;
use language\Messages;
use util\exception\ValidationException;
use util\Session;

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

class TemplatelistAction extends BaseAction
{
	public $security = Action::SECURITY_USER;

    /**
     * @var Project
     */
    private $project;


    function __construct()
	{
        parent::__construct();

    }


    public function init()
    {
        $this->project = new Project( $this->request->getRequestId());
    }



	/**
	 * Bearbeiten einer Vorlage
	 */
	function editView()
	{
		$this->nextSubAction('show');
	}


	
	// Anzeigen aller Templates
	//
	function showView()
	{
		$list = array();

		foreach( $this->project->getTemplates() as $id=>$name )
		{
			$list[$id] = array();
			$list[$id]['name'] = $name;
			$list[$id]['id'  ] = $id;
		}
		
		$this->setTemplateVar('templates',$list);
	}

	
	
	/**
	 * Add a template.
	 */
	public function addView()
	{
		$this->setTemplateVar( 'templates',$this->project->getTemplates() );
		$this->setTemplateVar( 'copytemplateid','' );

		/*
		$examples = array();
		$dir = opendir( 'examples/templates');
		while( $file = readdir($dir) )
		{
			if	( substr($file,0,1) != '.')
			{
				$examples[$file] = $file;
			}
		}
		
		$this->setTemplateVar( 'examples',$examples );
		$this->setTemplateVar( 'example','' );
		*/

	}
	
	
	
	public function addPost( $name )
	{
		// create a new template.
		$template = new Template();
		$template->projectid = $this->project->projectid;
		$template->name = $name;
		$template->add();

		$this->addNoticeFor($template, Messages::ADDED);

		$copytemplateid = $this->getRequestId('copytemplateid');
		if   ( $copytemplateid ) {

			// Template kopieren.
			$copyTemplate = new Template( $copytemplateid );
			$copyTemplate->load();

			// Copy all elements
			foreach( $copyTemplate->getElements() as $element )
			{
				/* @type $element Element */
				$element->load();
				$element->templateid = $template->templateid;
				$element->add();
				$element->save();
			}

			// copy all template models
			foreach( $this->project->getModelIds() as $modelid )
			{
				// Template laden
				$copyTemplate->load();

				$copyTemplateModel = $copyTemplate->loadTemplateModelFor( $modelid );

				$newTemplateModel = $template->loadTemplateModelFor( $modelid );
				$newTemplateModel->src       = $copyTemplateModel->src;
				$newTemplateModel->extension = $copyTemplateModel->extension;
				$newTemplateModel->save();
			}

			$this->addNoticeFor( $copyTemplate, Messages::COPIED);

				/*
			case 'example':

				// Neues Template anlegen.
				$template = new Template();
                $template->projectid = $this->project->projectid;

				$template->add( $this->getRequestVar('name') );

				$templateModel = $template->loadTemplateModelFor( $this->project->getDefaultModelId() );

				// FIXME
				$example = parse_ini_file('examples/templates/'.$this->getRequestVar('example'),true);

				foreach( $example as $exampleKey=>$exampleElement )
				{
					if	( !is_array($exampleElement) )
					{
						$template->$exampleKey = $exampleElement;
					}
					else
					{
						$element = new Element();
						$element->templateid = $template->templateid;
						$element->name       = $exampleKey;
						$element->writable   = true;
						$element->add();

						foreach( $exampleElement as $ePropName=>$ePropValue)
							$element->$ePropName = $ePropValue;
						
						$element->defaultText = str_replace(';',"\n",$element->defaultText);
						$element->save();
					}
				}
				$template->name = $this->getRequestVar('name');
				$templateModel->src = str_replace(';',"\n",$templateModel->src);
				
				foreach( $template->getElementNames() as $elid=>$elname )
				{
					$templateModel->src = str_replace('{{'.$elname.'}}'  ,'{{'.$elid.'}}'  ,$templateModel->src );
					$templateModel->src = str_replace('{{->'.$elname.'}}','{{->'.$elid.'}}',$templateModel->src );
				}
				
				$template->save();
				$templateModel->save();

				$this->addNotice('template', 0, $template->name, 'ADDED', 'ok');

				break;
*/
		}

	}

	
}