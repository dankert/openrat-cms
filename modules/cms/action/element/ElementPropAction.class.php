<?php
namespace cms\action\element;
use cms\action\Action;
use cms\action\ElementAction;
use cms\action\Method;
use cms\action\RequestParams;
use cms\model\Element;
use language\Messages;


class ElementPropAction extends ElementAction implements Method {
    public function view() {
        // Name und Beschreibung
        $this->setTemplateVar('name'       ,$this->element->name);
        $this->setTemplateVar('label'      ,$this->element->label);

        $this->setTemplateVar('description',$this->element->desc);

        // Die verschiedenen Element-Typen
        $types = array();

        foreach( Element::getAvailableTypes() as $typeId=>$typeKey )
            $types[ $typeId ] = 'EL_'.$typeKey;

        // Code-Element nur fuer Administratoren (da voller Systemzugriff!)
        if	( !$this->userIsAdmin() )
            unset( $types['code'] );

        // Liste aller Elementtypen
        $this->setTemplateVar('types',$types);

        // Aktueller Typ
        $this->setTemplateVar('typeid',$this->element->typeid);
    }


    public function post() {
        if	( !$this->userIsAdmin() && $this->request->getText('type') == 'code' )
            // Code-Elemente fuer Nicht-Administratoren nicht benutzbar
            throw new \util\exception\ValidationException('type');

        $this->element->typeid = $this->request->getNumber('typeid');

        $this->element->name = $this->request->getAlphanum('name'   );
        $this->element->label= $this->request->getText('label'      );
        $this->element->desc = $this->request->getText('description');

        $this->element->save();

        $this->addNoticeFor( $this->element, Messages::SAVED);
    }
}
