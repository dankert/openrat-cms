<?php
namespace cms\ui\action\index;
use cms\action\Method;
use cms\base\Configuration;
use cms\base\Configuration as C;
use cms\model\User;
use cms\ui\action\IndexAction;
use cms\ui\themes\ThemeStyle;
use util\ArrayUtils;
use util\text\Converter;

class IndexThemeAction extends IndexAction implements Method {

	const CSS_VARIABLE_PREFIX = '--cms-';

	public function view() {

        //$this->lastModified( Config::filemtime($themeLessFile));

		$styleId = $this->getUserStyle($this->currentUser);
		$schemaId  = $this->getUserScheme($this->currentUser);
		switch ( $schemaId ) {
			case User::STYLE_SCHEME_AUTO:
				$css = [
					':root' => $this->getThemeCSSVariables( $styleId,'light' ),
					'@media (prefers-color-scheme: dark)' => [
						':root' => $this->getThemeCSSVariables( $styleId,'dark' )
					]
				];
				break;
			case User::STYLE_SCHEME_LIGHT:
				$css = [
					':root' => $this->getThemeCSSVariables( $styleId,'light')
				];
				break;
			case User::STYLE_SCHEME_DARK:
				$css = [
					':root' => $this->getThemeCSSVariables( $styleId,'dark')
				];
				break;
			default:
				throw new \LogicException("invalid schema id: ".$schemaId);
		}

        $this->setTemplateVars($css);
        $this->setTemplateVar('name','"'.$styleId.'"');
    }


    public function post() {
    }


	/**
	 * Gets the theme CSS.
	 *
	 * @param $styleId string name of style
	 * @param $schema string schemaId, f.e. 'light','dark'
	 * @return array The css variables for this thema
	 */
	protected function getThemeCSSVariables($styleId, $schema )
	{
		$styleConfig = C::subset( ['style',$styleId] );

		$schemeConfig = $styleConfig->subset('schemes');;
		$config = $schemeConfig->subset($schema);

		$schemeConfig = $config->merge( $styleConfig->subset('defaults') );
		$themeStyle = new ThemeStyle( $schemeConfig->getConfig() );

		$schemesConfig = ArrayUtils::mapKeys( function($prop) {
					return self::CSS_VARIABLE_PREFIX.Converter::camelToUnderscore($prop, '-');
				},$themeStyle->getProperties());

		return $schemesConfig;
	}

}
