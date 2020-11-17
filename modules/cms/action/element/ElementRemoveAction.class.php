<?php
namespace cms\action\element;
use cms\action\Action;
use cms\action\ElementAction;
use cms\action\Method;


class ElementRemoveAction extends ElementAction implements Method {
    public function view() {
		$this->setTemplateVar( 'name' ,$this->element->name );
    }

    public function post() {
		if	( !$this->hasRequestVar('confirm') )
			throw new \util\exception\ValidationException('confirm');

		$type = $this->getRequestVar('type','abc');
		
		if ( $type == 'value' )
		{
		    // Nur Inhalte löschen
			$this->element->deleteValues();
			$this->addNotice('element', 0, $this->element->name, 'DELETED', Action::NOTICE_OK);
		}
		elseif ( $type == 'all' )
		{
		    // Element löschen
			$this->element->delete();
			$this->addNotice('element', 0, $this->element->name, 'DELETED', Action::NOTICE_OK);
		}
    }
}
