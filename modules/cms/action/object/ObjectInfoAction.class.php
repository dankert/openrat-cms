<?php
namespace cms\action\object;
use cms\action\Method;
use cms\action\ObjectAction;
use cms\model\BaseObject;
use util\ArrayUtils;

class ObjectInfoAction extends ObjectAction implements Method {
    public function view() {
		$this->setTemplateVars( $this->baseObject->getProperties() );

		$this->setTemplateVar( 'is_valid'     ,$this->baseObject->isValid() );
		$this->setTemplateVar( 'full_filename',$this->baseObject->full_filename() );
		$this->setTemplateVar( 'extension'    , '' );
		$this->setTemplateVar( 'mimetype'     , $this->baseObject->mimeType() );

		$this->setTemplateVar( 'name'         , $this->baseObject->getDefaultName()->name        );
		$this->setTemplateVar( 'description'  , $this->baseObject->getDefaultName()->description );

		$languages = $this->baseObject->getProject()->getLanguages();
		$languagesVars = array();

		foreach( $languages as $languageId => $languageName )
		{
			$name = $this->baseObject->getNameForLanguage( $languageId );


			$languagesVar = [
				'name'         => $name->name,
				'description'  => $name->description,
				'languagename' => $languageName,
				'languageid'   => $languageId,
			];

			$languagesVars[] = $languagesVar;
		}

		$this->setTemplateVar('languages',$languagesVars );

		// Read all objects linking to us.
		$pages = $this->baseObject->getDependentObjectIds();

		$list = array();
		foreach( $pages as $languageid )
		{
			$o = new BaseObject( $languageid );
			$o->load();
			$list[$languageid] = array();
			$list[$languageid]['name'] = $o->filename;
			$list[$languageid]['type'] = $o->getType();
		}

		asort( $list );

		$this->setTemplateVar('pages',$list);

		$this->setTemplateVar('size',number_format($this->baseObject->getSize()/1000,0,',','.').' kB' );

		$pad = str_repeat("\xC2\xA0",5); // Hard spaces
		$totalSettings = $this->baseObject->getTotalSettings();
		$this->setTemplateVar('total_settings', $totalSettings,$pad );
		$this->setTemplateVar('settings', ArrayUtils::dryFlattenArray( $totalSettings,$pad ) );
    }
    public function post() {
    }
}
