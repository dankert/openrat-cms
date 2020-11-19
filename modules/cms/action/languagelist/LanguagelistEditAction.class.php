<?php
namespace cms\action\languagelist;
use cms\action\LanguagelistAction;
use cms\action\Method;
use cms\base\Configuration;
use cms\model\Language;
use util\Html;


class LanguagelistEditAction extends LanguagelistAction implements Method {

	public function view() {
		$countryList = Configuration::Conf()->get('countries',[]);

		$list = array();

		$this->setTemplateVar('act_languageid',0 );



		foreach( $this->project->getLanguageIds() as $id )
		{
			$l = new Language( $id );
			$l->load();

			unset( $countryList[strtoupper($l->isoCode)] );

			$list[$id] = array();
			$list[$id]['name'   ] = $l->name;
			$list[$id]['isocode'] = $l->isoCode;
			$list[$id]['id'     ] = $id;

			$list[$id]['is_default'] = $l->isDefault;

			$list[$id]['select_url']  = Html::url( 'index','language',$id );
		}

		$this->setTemplateVar('el',$list);
	}

    public function post() {
    }
}
