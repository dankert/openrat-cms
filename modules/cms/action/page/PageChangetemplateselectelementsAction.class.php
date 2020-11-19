<?php
namespace cms\action\page;
use cms\action\Action;
use cms\action\Method;
use cms\action\PageAction;
use cms\model\Element;
use cms\model\Template;

class PageChangetemplateselectelementsAction extends PageAction implements Method {

    public function view() {
		$newTemplateId = $this->getRequestVar( 'newtemplateid' );

		if   ( $newTemplateId != 0  )
		{
			$this->setTemplateVar('newtemplateid',$newTemplateId );

			$oldElements = array();
			$oldTemplate = new Template( $this->page->templateid );
			$newTemplate = new Template( $newTemplateId );

			foreach( $oldTemplate->getElementIds() as $elementid )
			{
				$e = new Element( $elementid );
				$e->load();

				if	( !$e->isWritable() )
					continue;

				$oldElement = array();
				$oldElement['name'] = $e->name.' - '.\cms\base\Language::lang('EL_'.$e->type );
				$oldElement['id'  ] = $e->elementid;

				$newElements = Array();
				$newElements[0] = \cms\base\Language::lang('ELEMENT_DELETE_VALUES');

				foreach( $newTemplate->getElementIds() as $newelementid )
				{
					$ne = new Element( $newelementid );
					$ne->load();

					// Nur neue Elemente anbieten, deren Typ identisch ist
					if	( $ne->type == $e->type )
						$newElements[$newelementid] = \cms\base\Language::lang('ELEMENT').': '.$ne->name.' - '.\cms\base\Language::lang('EL_'.$e->type );
				}
				$oldElement['newElementsName'] = 'from'.$e->elementid;
				$oldElement['newElementsList'] = $newElements;
				$oldElements[$elementid] = $oldElement;
			}
			$this->setTemplateVar('elements',$oldElements );
		}
    }


    public function post() {
		$newTemplateId = $this->getRequestVar('newtemplateid');
		$replaceElementMap = Array();

		$oldTemplate = new Template( $this->page->templateid );
		foreach( $oldTemplate->getElementIds() as $elementid )
			$replaceElementMap[$elementid] = $this->getRequestVar('from'.$elementid);

		if	( $newTemplateId != 0  )
		{
			$this->page->replaceTemplate( $newTemplateId,$replaceElementMap );
			$this->addNotice('page', 0, $this->page->name, 'SAVED', Action::NOTICE_OK);
		}
		else
			$this->addNotice('page', 0, $this->page->name, 'NOT_SAVED', Action::NOTICE_WARN);
    }
}
