<?php
namespace cms\action\projectlist;
use cms\action\Action;
use cms\action\Method;
use cms\action\ProjectlistAction;
use cms\base\Configuration;
use cms\model\Element;
use cms\model\Folder;
use cms\model\Language;
use cms\model\Model;
use cms\model\Page;
use cms\model\PageContent;
use cms\model\Project;
use cms\model\Template;
use cms\model\Text;
use cms\model\Value;
use configuration\Config;
use language\Messages;
use util\exception\SecurityException;

class ProjectlistAddAction extends ProjectlistAction implements Method {

    public function view() {

    }


	/**
	 * Add a new project.
	 */
    public function post() {

		$name = $this->request->getNotEmptyText('name');

		$project = new Project();
		$project->name = $name;
		$project->persist();

		$this->addNoticeFor( $project,Messages::ADDED );

		switch( $this->request->getText('type') ) {
			case '':
			case 'empty':
				break;

			case 'example':
				$this->createSamplesInProject( $project );
				break;

			default:
				// Unknown type value, no action.
		}
    }


    public function checkAccess()
	{
		if   ( ! $this->userIsAdmin() )
			throw new SecurityException();
	}


	/**
	 * Create example data in the new project.
	 *
	 * @param $project Project
	 */
	protected function createSamplesInProject($project ) {

		$exampleConfig = Configuration::subset(['project','examples']);

		$rootFolderId = $project->getRootObjectId();

		// Modell anlegen
		$model = new Model();
		$model->projectid = $project->getId();
		$model->name = 'html';
		$model->persist();;

		// Sprache anlegen
		$language = new Language();
		$language->projectid = $project->getId();
		$language->isoCode = 'en';
		$language->name    = 'english';
		$language->persist();


		// Template anlegen
		$template = new Template();
		$template->projectid  = $project->getId();
		$template->name       = 'Standard';
		$template->persist();

		$element = new Element();
		$element->templateid = $template->templateid;
		$element->typeid     = Element::ELEMENT_TYPE_LONGTEXT;
		$element->writable   = true;
		$element->format     = Element::ELEMENT_FORMAT_MARKDOWN;
		$element->label      = 'Text';
		$element->name       = 'text';
		$element->persist();

		// Template anlegen
		$templateModel = $template->loadTemplateModelFor( $model->modelid );
		$templateModel->extension  = 'html';
		$templateModel->src        =  $exampleConfig->get('html',<<<HTML
<html>
  <head>
    <link rel="stylesheet" href="{{style}}" />
    <script src="{{script}}" defer="defer"></script>
  </head>
  <body>
    <h1>My first page</h1>
    <hr>
    <p>{{text}}</p>
  </body>
</html>
HTML
		);
		$templateModel->public = true;
		$templateModel->persist();

		$scriptFolder = new Folder();
		$scriptFolder->parentid = $rootFolderId;
		$scriptFolder->projectid = $project->getId();
		$scriptFolder->filename = 'script';
		$scriptFolder->persist();

		$script = new Text();
		$script->validFromDate = time();
		$script->settings = <<<SETTINGS
# Sample configuration for this script
# filter:
SETTINGS;
		$script->parentid = $scriptFolder->getId();
		$script->projectid = $project->getId();
		$script->filename = 'script.js';
		$script->value = $exampleConfig->get('script',<<<SCRIPT
// Sample Javascript
SCRIPT
		);
		$script->persist();
		$script->public = true;
		$script->saveValue();

		$scriptElement = new Element();
		$scriptElement->templateid = $template->templateid;
		$scriptElement->typeid     = Element::ELEMENT_TYPE_LINK;
		$scriptElement->writable   = false;
		$scriptElement->defaultObjectId = $script->getId();
		$scriptElement->label      = 'Script';
		$scriptElement->name       = 'script';
		$scriptElement->persist();

		$style = new Text();
		$style->parentid = $scriptFolder->getId();
		$style->projectid = $project->getId();;
		$style->filename = 'style.css';
		$style->value = $exampleConfig->get('style',<<<STYLE
/* Theme CSS */
background-color: white;
STYLE
		);
		$style->persist();
		$style->public = true;
		$style->saveValue();

		$styleElement = new Element();
		$styleElement->templateid = $template->templateid;
		$styleElement->typeid     = Element::ELEMENT_TYPE_LINK;
		$styleElement->writable   = false;
		$styleElement->label      = 'Stylesheet';
		$styleElement->name       = 'style';
		$styleElement->defaultObjectId = $style->getId();
		$styleElement->persist();

		// Beispiel-Seite anlegen
		$page = new Page();
		$page->parentid   = $rootFolderId;
		$page->projectid  = $project->getId();
		$page->templateid = $template->templateid;
		$page->filename   = 'start';
		$page->getDefaultName()->name = 'Sample page';
		$page->persist();

		$pageContent = new PageContent();
		$pageContent->pageId     = $page->pageid;
		$pageContent->elementId  = $element->elementid;
		$pageContent->languageid = $language->languageid;
		$pageContent->persist();

		$value = new Value();
		$value->contentid = $pageContent->contentId;
		$value->text = $exampleConfig->get('text',<<<TEXT
# Congratulations

## Congratulations, this is your first page.

This is your first page in OpenRat CMS. You may edit the page and change this text.
TEXT
		);
		$value->format = Element::ELEMENT_FORMAT_MARKDOWN;
		$value->publish = true;
		$value->persist();

	}
}
