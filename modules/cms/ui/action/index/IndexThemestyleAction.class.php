<?php
namespace cms\ui\action\index;
use cms\action\Method;
use cms\base\Configuration as C;
use cms\ui\action\IndexAction;
use cms\ui\themes\ThemeStyle;
use util\ArrayUtils;
use util\text\Converter;

class IndexThemestyleAction extends IndexAction implements Method {

    public function view() {

        //$this->lastModified( Config::filemtime($themeLessFile));

        $styleName = $this->request->getText('style');

        $this->setTemplateVar('style',$this->getThemeProperties( $styleName) );
    }


    public function post() {
    }


	/**
	 * Gets the theme CSS.
	 *
	 * @param $styleId string name of style
	 * @return array The theme properties
	 */
	protected function getThemeProperties($styleId )
	{
		$styleConfig = C::subset( ['style',$styleId] );
		$scheme = 'light';

		$schemeConfig = $styleConfig->subset('defaults')->merge( $styleConfig->subset('schemes')->subset($scheme) );

		$themeStyle = new ThemeStyle( $schemeConfig->getConfig() );

		return ArrayUtils::mapKeys( function($prop) {
			return Converter::camelToUnderscore($prop, '-');
		},$themeStyle->getProperties());

	}

}
