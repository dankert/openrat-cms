<?php
namespace cms\action\languagelist;
use cms\action\LanguagelistAction;
use cms\action\Method;
use cms\base\Configuration;
use cms\model\Language;
use language\Messages;


class LanguagelistAddAction extends LanguagelistAction implements Method {
    public function view() {
		$countryList = Configuration::subset('countries')->getConfig();
		
		foreach( $this->project->getLanguageIds() as $id )
		{

			$l = new Language( $id );
			$l->load();

			unset( $countryList[$l->isoCode] );
		}

		asort( $countryList );

		$this->setTemplateVar('isocodes'  ,$countryList );
		$this->setTemplateVar('isocode'  ,'' );
    }
    public function post() {

		$countryList = Configuration::Conf()->get('countries',[]);
		
		$iso = 	$this->getRequestVar('isocode');
		$language = new Language();
		$language->projectid = $this->project->projectid;
		$language->isoCode   = $iso;
		$language->name      = @$countryList[$iso];
		$language->add();
		
		$this->addNoticeFor($language, Messages::ADDED);
    }
}
