<?php
namespace cms\ui\action\index;
use cms\action\Method;
use cms\ui\action\IndexAction;
use util\Session;
use cms\action\RequestParams;
use cms\auth\Auth;
use cms\auth\AuthRunner;
use cms\base\Configuration;
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
        $user = Session::getUser();

        if   ( $user )
            $this->lastModified( C::subset('config')->get('last_modification_time',time() ) );
        else
            $this->lastModified( time() );

        $style = $this->getUserStyle( $user );

        $styleConfig     = C::Conf()->subset('style-default' ); // default style config
        $userStyleConfig = C::subset('style')->subset( $style ); // user style config

        if ( $userStyleConfig->hasContent() )
            $styleConfig->merge( $userStyleConfig ); // Merging user style into default style
        else
            ; // Unknown style name, we are ignoring this.

        // Theme base color for smartphones colorizing their status bar.
        $themeColor = UIUtils::getColorHexCode($styleConfig->get('title_background_color','white'));


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
		$json = new JSON();
		$this->setTemplateVar( 'manifest',$json->encode($value) );
    }


    public function post() {
    }
}
