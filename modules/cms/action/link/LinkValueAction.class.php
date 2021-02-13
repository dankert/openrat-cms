<?php
namespace cms\action\link;
use cms\action\Action;
use cms\action\LinkAction;
use cms\action\Method;
use cms\model\BaseObject;
use language\Messages;


class LinkValueAction extends LinkAction implements Method {

    public function view() {
		$this->setTemplateVars( $this->link->getProperties() );

		// Typ der Verknuepfung
		$this->setTemplateVar('type'            ,$this->link->getType()     );

		if   ( $this->link->linkedObjectId ) {

			$target = new BaseObject( $this->link->linkedObjectId );
			$target->load();

			$this->setTemplateVar('target'  ,$target->getProperties() );
			$this->setTemplateVar('targetobjectid'  ,$target->objectid  );
			$this->setTemplateVar('targetobjectname',$target->getName() );
			$this->setTemplateVar('targetobjecttype',$target->getType() );
		}
    }


    public function post() {

        $this->link->linkedObjectId = $this->getRequestVar('targetobjectid');
        $this->link->save();

        $this->addNoticeFor( $this->link, Messages::SAVED);
    }
}
