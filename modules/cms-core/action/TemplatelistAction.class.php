<?php

namespace cms\action;

use cms\model\Element;
use cms\model\Project;
use cms\model\Template;
use Session;

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

class TemplatelistAction extends Action
{
	public $security = SECURITY_USER;

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
        $this->project = new Project( $this->request->getProjectId());
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
		global $conf_php;

		$list = array();

		$template = new Template();
		$template->projectid = $this->project->projectid;

		foreach( $this->project->getTemplates() as $id=>$name )
		{
			$list[$id] = array();
			$list[$id]['name'] = $name;
			$list[$id]['id'  ] = $id;
		}
		
//		$var['templatemodelid'] = htmlentities( $id   );
//		$var['text']            = htmlentities( $text );
		$this->setTemplateVar('templates',$list);
	}

	
	
	/**
	 * Vorlage hinzuf�gen.
	 */
	function addView()
	{
		$this->setTemplateVar( 'templates',array() /*Template::getAll()*/ );

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
		$this->setTemplateVar( 'templateid','' );
		$this->setTemplateVar( 'example','' );
	}
	
	
	
	function addPost()
	{
		// Hinzufuegen eines Templates
		if   ( $this->getRequestVar('name') == '' )
			throw new \ValidationException('name');

		// Hinzufuegen eines Templates
		switch( $this->getRequestVar('type') )
		{
			case 'empty':

				// Neues Template anlegen.
				$template = new Template();
				$template->add( $this->getRequestVar('name') );
				$this->addNotice('template',$template->name,'ADDED','ok');
				break;
				
			case 'copy':
				
				$copy_templateid = intval($this->getRequestVar('templateid') );
				
				if	( $copy_templateid == 0 )
				{
					$this->addValidationError('templateid');
					return;
				}

				// Neues Template anlegen.
				$template = new Template();
				$template->add( $this->getRequestVar('name') );
				$this->addNotice('template',$template->name,'ADDED','ok');

				// Template kopieren.
				$copy_template = new Template( $copy_templateid );
				$copy_template->load();
				$elementMapping = array();
				foreach( $copy_template->getElements() as $element )
				{
				    /* @type $element Element */
					$element->load();
					$oldelementId = $element->elementid;
					$element->templateid = $template->templateid;
					$element->add();
					$element->save();
					
					$elementMapping[$oldelementId] = $element->elementid;
				}
				
				$project = new Project( $this->getRequestId('projectid') );
				foreach( $project->getModelIds() as $modelid )
				{
					// Template laden
					$copy_template->modelid = $modelid;
					$copy_template->load();
					
					$template->modelid   = $modelid;
					$src                 = $copy_template->src;
					
					// Elemente im Quelltext an die geänderten Element-Idn anpassen.
					foreach( $elementMapping as $oldId=>$newId)
						$src = str_replace('{{'.$oldId.'}}','{{'.$newId.'}}',$src);
						
					$template->src       = $src;
					$template->extension = $copy_template->extension;
					$template->save();
				}
				
				$this->addNotice('template',$copy_template->name,'COPIED','ok');

				break;

			case 'example':

				// Neues Template anlegen.
				$template = new Template();

				$template->modelid = $this->project->getDefaultModelId();
				
				$template->add( $this->getRequestVar('name') );

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
//						Html::debug($element,"Element");
					}
				}
//				Html::debug($template,"Template");
				$template->name = $this->getRequestVar('name');
				$template->src = str_replace(';',"\n",$template->src);
				
				foreach( $template->getElementNames() as $elid=>$elname )
				{
					$template->src = str_replace('{{'.$elname.'}}'  ,'{{'.$elid.'}}'  ,$template->src );
					$template->src = str_replace('{{->'.$elname.'}}','{{->'.$elid.'}}',$template->src );
				}
				
				$template->save();
				$this->addNotice('template',$template->name,'ADDED','ok');

				break;
			default:
				$this->addValidationError('type');
				$this->callSubAction('add');
				return;
		}


		$this->setTemplateVar('tree_refresh',true);
	}

	
}