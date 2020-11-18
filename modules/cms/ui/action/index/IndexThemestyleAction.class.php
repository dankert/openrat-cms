<?php
namespace cms\ui\action\index;
use cms\action\Method;
use cms\base\Startup;
use cms\ui\action\IndexAction;
use cms\action\RequestParams;
use cms\auth\Auth;
use cms\auth\AuthRunner;
use cms\base\Configuration;
use cms\base\Configuration as C;
use cms\model\BaseObject;
use cms\model\Project;
use cms\model\User;
use cms\model\Value;
use cms\ui\themes\Theme;
use Exception;
use language\Messages;
use util\Html;
use util\json\JSON;
use logger\Logger;
use util\Less;
use util\UIUtils;
use \util\exception\ObjectNotFoundException;
use util\Session;
class IndexThemestyleAction extends IndexAction implements Method {
    public function view() {
        $themeLessFile = Startup::THEMES_DIR . 'default/style/theme/openrat-theme.less';
        $this->lastModified(filemtime($themeLessFile));

        header('Content-Type: text/css');

        $this->setTemplateVar('style',$this->getThemeCSS() );
    }
    public function post() {
    }


	/**
	 * Gets the theme CSS.
	 *
	 * @return string
	 */
	protected function getThemeCSS()
	{
		// Je Theme die Theme-CSS-Datei ausgeben.
		$lessFile = Startup::THEMES_DIR . 'default/style/theme/openrat-theme.less';
		$css      = '';


		foreach ( C::subset('style')->subsets() as $styleId => $styleConfig)
		{
			try
			{
				$styleConfig = C::Conf()->subset('style-default')->merge( $styleConfig );

				if   ( DEVELOPMENT )
					$css .= "\n".'/* Theme: '.$styleId.' */'."\n";

				$lessVars = array(
					'cms-theme-id'   => strtolower($styleId),
					'cms-image-path' => '"'.Startup::THEMES_DIR.'default/images/'.'"',
				);

				foreach ($styleConfig->getConfig() as $styleSetting => $value)
					$lessVars['cms-' . strtolower(strtr($styleSetting, '_', '-'))] = $value;

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
					$css .= "\n\n/* ERROR!\n   LESS Parser failed on file '$lessFile'. Reason: " . $e->__toString() . " */\n\n";
			}
		}

		return $css;
	}

}
