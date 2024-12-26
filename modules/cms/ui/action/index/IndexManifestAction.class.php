<?php
namespace cms\ui\action\index;
use cms\action\Method;
use cms\base\Configuration;
use cms\ui\action\IndexAction;
use cms\ui\themes\ThemeStyle;
use util\Session;
use cms\action\RequestParams;
use cms\auth\Auth;
use cms\auth\AuthRunner;
use cms\base\Configuration as C;
use cms\base\Startup;
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


/**
 * Creating the website manifest.
 *
 * See https://developer.mozilla.org/de/docs/Web/Manifest
 */
class IndexManifestAction extends IndexAction implements Method {

    public function view() {
        $user = $this->currentUser;

        if   ( $user )
            $this->lastModified( C::subset('config')->get('last_modification_time',time() ) );
        else
            $this->lastModified( time() );

        $currentStyle = $this->getUserStyle( $user );

		$themeStyle = new ThemeStyle( Configuration::subset('style')->get($currentStyle,[]) ); // user style config


		// Theme base color for smartphones colorizing their status bar.
        $themeColor = $themeStyle->getThemeColor();

        $appName = C::subset(['application'])->get('name',Startup::TITLE);

        $value = array(
            'name'        => $appName,
            'description' => $appName,
            'short_name'  => 'CMS',
            'display'     => 'standalone',
            'orientation' => 'landscape',
            'background_color' => $themeColor,
            'theme_color' => $themeColor,
			'start_url'   => './',
        );

        header("Content-Type: application/manifest+json");
		$this->setTemplateVar( 'manifest',JSON::encode($value) );
    }


    public function post() {
    }
}
