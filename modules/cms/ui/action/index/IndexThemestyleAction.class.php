<?php
namespace cms\ui\action\index;
use cms\action\Method;
use cms\base\Configuration as C;
use cms\base\Startup;
use cms\ui\action\IndexAction;
use cms\action\RequestParams;
use cms\auth\Auth;
use cms\auth\AuthRunner;
use cms\base\Configuration;
use cms\model\BaseObject;
use cms\model\Project;
use cms\model\User;
use cms\model\Value;
use cms\ui\themes\Theme;
use cms\ui\themes\ThemeStyle;
use Exception;
use language\Messages;
use util\Html;
use util\json\JSON;
use logger\Logger;
use util\Less;
use util\text\Converter;
use util\UIUtils;
use \util\exception\ObjectNotFoundException;
use util\Session;
class IndexThemestyleAction extends IndexAction implements Method {

	const DEFAULT_COLOR_SCHEME = 'light';

    public function view() {

        $themeLessFile = Startup::THEMES_DIR . 'default/style/theme/openrat-theme.less';
        $this->lastModified(filemtime($themeLessFile));

        $styleName = $this->request->getText('style');

        $this->setTemplateVar('style',$this->getThemeCSS( $styleName) );
    }


    public function post() {
    }


	/**
	 * Gets the theme CSS.
	 *
	 * @param $styleId string name of style
	 * @return string The ready to use CSS
	 */
	protected function getThemeCSS( $styleId )
	{
		// Je Theme die Theme-CSS-Datei ausgeben.
		$lessFile = Startup::THEMES_DIR . 'default/style/theme/openrat-theme.less';
		$css      = '';

		$styleConfig = C::subset( ['style',$styleId] );
		foreach( ['light','dark'] as $scheme ) {

			$schemeConfig = $styleConfig->subset('defaults')->merge( $styleConfig->subset('schemes')->subset($scheme) );

			$colorScheme = $scheme!=self::DEFAULT_COLOR_SCHEME ? $scheme : ''; // "Light" is the default

			if   ( $colorScheme )
				$css .= '@media screen and (prefers-color-scheme: '.$scheme.') {';
			try
			{
				$themeStyle = new ThemeStyle( $schemeConfig->getConfig() );

				if   ( DEVELOPMENT )
					$css .= "\n".'/* Theme: '.$styleId.' */'."\n";

				$lessVars = array(
					'cms-theme-id'   => strtolower($styleId),
					'cms-image-path' => '"'.Startup::THEMES_DIR.'default/images/'.'"',
				);

				foreach ( $themeStyle->getProperties() as $styleSetting => $value)
					$lessVars['cms-' . Converter::camelToUnderscore($styleSetting, '-')] = $value;

				if   ( DEVELOPMENT )
					$css .= "\n".'/* Theme-Properties: '.print_r( $lessVars,true).' */'."\n";

				// we must create a new instance here, because the less parser is buggy when changing vars.
				$parser = new Less(array(
					'sourceMap'         => DEVELOPMENT,
					'indentation'       => DEVELOPMENT?"\t":'',
					'outputSourceFiles' => false,
					'compress'          => PRODUCTION
				));
				$parser->parseFile($lessFile,basename($lessFile));
				$parser->modifyVars($lessVars);
				$css .= $parser->getCss();
			}
			catch (Exception $e)
			{
				Logger::warn( new \RuntimeException("LESS Parser failed on file '$lessFile'.", 0,$e) );

				// For not confusing the browser we are displaying a CSS with a comment.
				if   ( DEVELOPMENT )
					$css .= "\n\n/* ERROR!\n   LESS Parser failed on file '$lessFile'. Reason: " . $e->__toString() . " */\nhtml { content: \"Theme not available\";}\n";
			}

			if   ( $colorScheme )
				$css .= '}';
		}

		return $css;
	}

}
