<?php
namespace cms\action\pageelement;
use cms\action\Method;
use cms\action\PageelementAction;
use cms\model\PageContent;
use cms\model\Permission;
use cms\model\BaseObject;
use cms\model\Folder;
use cms\model\Page;
use cms\model\Project;
use cms\model\Template;
use cms\model\Value;

class PageelementLinkAction extends PageelementAction implements Method {

    public function view() {

		$pageContent = new PageContent();
		$pageContent->pageId     = $this->page->pageid;
		$pageContent->languageid = $this->page->getProject()->getDefaultLanguageId();
		$pageContent->elementId  = $this->element->elementid;
		$pageContent->load();

		$value = new Value();
		$value->contentid = $pageContent->contentId;
		$value->load();

		$this->setTemplateVar('name'     ,$this->element->name     );
		$this->setTemplateVar('desc'     ,$this->element->desc     );

        $project = new Project($this->page->projectid);
        $this->setTemplateVar('rootfolderid'     ,$project->getRootObjectId() );
		
		// Ermitteln, welche Objekttypen verlinkt werden d�rfen.
		if	( empty($this->element->subtype) )
			$types = array('page','file','link'); // Fallback: Alle erlauben :)
		else
			$types = explode(',',$this->element->subtype );

		$objects = array();
			
		$objects[ 0 ] = \cms\base\Language::lang('LIST_ENTRY_EMPTY'); // Wert "nicht ausgewählt"

		
		$t = new Template( $this->page->templateid );

		foreach( $t->getDependentObjectIds() as $id )
		{
			$o = new BaseObject( $id );
			$o->load();
				
			//			if	( in_array( $o->getType(),$types ))
			//			{
			$f = new Folder( $o->parentid );
			//					$f->load();

			$objects[ $id ]  = \cms\base\Language::lang( $o->getType() ).': ';
			$objects[ $id ] .=  implode( \util\Text::FILE_SEP,$f->parentObjectNames(false,true) );
			$objects[ $id ] .= \util\Text::FILE_SEP.$o->filename;
			//			}
		}

        asort( $objects ); // Sortieren

        $this->setTemplateVar('objects'         ,$objects);
        $this->setTemplateVar('linkobjectid',$this->value->linkToObjectId);

        $this->setTemplateVar( 'release',$this->page->hasRight(Permission::ACL_RELEASE) );
        $this->setTemplateVar( 'publish',$this->page->hasRight(Permission::ACL_PUBLISH) );

        $this->setTemplateVar( 'objectid',$this->page->objectid );
    }


    public function post() {
    }
}
