<?php
namespace cms\action\object;
use cms\action\Method;
use cms\action\ObjectAction;
use cms\model\Language;
use language\Messages;
use util\exception\ValidationException;


class ObjectNameAction extends ObjectAction implements Method {
    public function view() {
        $name = $this->baseObject->getNameForLanguage( $this->getRequestId('languageid') );

        $nameProps = $name->getProperties();

        $language = new Language( $name->languageid );
        $language->load();
        $nameProps[ 'languageName' ] = $language->name;
        $this->setTemplateVars( $nameProps );
    }
    public function post() {
        if   ( ! $this->hasRequestVar('name' ) )
            throw new ValidationException('name');

        $name = $this->baseObject->getNameForLanguage( $this->getRequestId('languageid'));

        $name->name        = $this->getRequestVar( 'name' );
        $name->description = $this->getRequestVar( 'description' );

        $name->persist();

        $this->addNoticeFor($this->baseObject, Messages::SAVED);
    }
}
