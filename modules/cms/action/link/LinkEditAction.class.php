<?php
namespace cms\action\link;
use cms\action\Action;
use cms\action\LinkAction;
use cms\action\Method;


class LinkEditAction extends LinkAction implements Method {
    public function view() {
		$this->setTemplateVars( $this->link->getProperties() );

		// Typ der Verknuepfung
		$this->setTemplateVar('type'            ,$this->link->getType()     );
		$this->setTemplateVar('targetobjectid'  ,$this->link->linkedObjectId);
		$this->setTemplateVar('targetobjectname',$this->link->name          );
    }
    public function post() {
        $this->link->linkedObjectId = $this->getRequestVar('targetobjectid');
        $this->link->save();

        $this->addNotice('link', 0, $this->link->name, 'SAVED', Action::NOTICE_OK);
    }
}
