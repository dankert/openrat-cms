<?php
namespace cms\action\element;
use cms\action\Action;
use cms\action\ElementAction;
use cms\action\Method;
use language\Messages;


class ElementRemoveAction extends ElementAction implements Method {
    public function view() {
		$this->setTemplateVar( 'name' ,$this->element->name );
    }

    public function post() {
		if	( !$this->request->has('confirm') )
			throw new \util\exception\ValidationException('confirm');

		$type = $this->request->getAlphanum('type');
		
		if ( $type == 'value' )
		{
		    // Nur Inhalte löschen
			$this->element->deleteValues();
			$this->addNoticeFor( $this->element, Messages::DELETED);
		}
		elseif ( $type == 'all' )
		{
		    // Element löschen
			$this->element->delete();
			$this->addNoticeFor( $this->element, Messages::DELETED);
		}
    }
}
