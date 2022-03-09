<?php
namespace cms\action\object;
use cms\action\Method;
use cms\action\ObjectAction;
use cms\model\Language;
use cms\model\Permission;
use language\Messages;
use util\exception\ValidationException;


class ObjectNameAction extends ObjectAction implements Method {
    public function view() {
        $name = $this->baseObject->getNameForLanguage( $this->request->getLanguageId() );

        $nameProps = $name->getProperties();

        $language = new Language( $name->languageid );
        $language->load();
        $nameProps[ 'languageName' ] = $language->name;
        $this->setTemplateVars( $nameProps );
    }


    public function post() {
        $name = $this->baseObject->getNameForLanguage( $this->request->getLanguageId() );

		$this->request->handleText('name',function($value) use ($name) {
			$name->name = $value;
		});

		$this->request->handleText('description',function($value) use ($name) {
			$name->description = $value;
		});

        $name->persist();

        $this->addNoticeFor($this->baseObject, Messages::SAVED);
    }


	/**
	 * @return int Permission-flag.
	 */
	public function getRequiredPermission() {
		return Permission::ACL_WRITE;
	}
}
