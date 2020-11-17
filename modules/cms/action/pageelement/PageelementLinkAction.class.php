<?php
namespace cms\action\pageelement;
use cms\action\Method;
use cms\action\PageelementAction;
use cms\model\Acl;
use cms\model\BaseObject;
use cms\model\Folder;
use cms\model\Page;
use cms\model\Project;
use cms\model\Template;

class PageelementLinkAction extends PageelementAction implements Method {
    public function view() {
		$this->value->languageid = $this->page->languageid;
		$this->value->objectid   = $this->page->objectid;
		$this->value->pageid     = $this->page->pageid;
		$this->value->element = &$this->element;
		$this->value->element->load();
		$this->value->load();

		$this->setTemplateVar('name'     ,$this->value->element->name     );
		$this->setTemplateVar('desc'     ,$this->value->element->desc     );

        $project = new Project($this->page->projectid);
        $this->setTemplateVar('rootfolderid'     ,$project->getRootObjectId() );
		
		// Ermitteln, welche Objekttypen verlinkt werden d�rfen.
		if	( empty($this->value->element->subtype) )
		$types = array('page','file','link'); // Fallback: Alle erlauben :)
		else
		$types = explode(',',$this->value->element->subtype );

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
			$objects[ $id ] .= \util\Text::FILE_SEP.$o->name;
			//			}
		}

        asort( $objects ); // Sortieren

        $this->setTemplateVar('objects'         ,$objects);
        $this->setTemplateVar('linkobjectid',$this->value->linkToObjectId);

        $this->value->page             = new Page( $this->page->objectid );
        $this->value->page->languageid = $this->value->languageid;
        $this->value->page->load();

        $this->setTemplateVar( 'release',$this->value->page->hasRight(Acl::ACL_RELEASE) );
        $this->setTemplateVar( 'publish',$this->value->page->hasRight(Acl::ACL_PUBLISH) );

        $this->setTemplateVar( 'objectid',$this->value->page->objectid );
    }


    public function post() {
    }
}
