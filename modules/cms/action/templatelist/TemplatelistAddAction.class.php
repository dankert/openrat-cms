<?php
namespace cms\action\templatelist;
use cms\action\Method;
use cms\action\TemplatelistAction;
use cms\model\Element;
use cms\model\Template;
use language\Messages;

class TemplatelistAddAction extends TemplatelistAction implements Method {


    public function view() {
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


    public function post() {

    	$name = $this->getRequestVar('name');

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
