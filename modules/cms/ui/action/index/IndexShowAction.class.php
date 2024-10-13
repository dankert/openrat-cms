<?php
namespace cms\ui\action\index;
use cms\action\Method;
use cms\model\User;
use cms\ui\action\IndexAction;
use cms\ui\themes\ThemeStyle;
use language\Messages;
use util\Html;
use util\Session;
use util\UIUtils;
use cms\base\Configuration as C;
use cms\action\RequestParams;
use cms\auth\Auth;
use cms\auth\AuthRunner;
use cms\base\Configuration;
use cms\base\Startup;
use cms\model\BaseObject;
use cms\model\Project;
use cms\model\Value;
use cms\ui\themes\Theme;
use Exception;
use util\json\JSON;
use logger\Logger;
use util\Less;
use \util\exception\ObjectNotFoundException;
class IndexShowAction extends IndexAction implements Method {

    public function view() {

		$this->addContentSecurityPolicy();

        $user = $this->currentUser;

        // Is a user logged in?
        if	( !is_object($user) )
		{
		    // Lets try an auto login.
            $this->tryAutoLogin();

            $user = $this->currentUser;
        }

		$configLastModificationTime = C::subset('config')->get('last_modification_time', 0);

        if	( $user )
			$this->lastModified( max( $user->loginDate, $configLastModificationTime) );
        else
            $this->lastModified( $configLastModificationTime );

        // Theme für den angemeldeten Benuter ermitteln
        $style = $this->getUserStyle($user);

        $this->setTemplateVar('style',$style );

		$this->setTemplateVar('scriptLink', $this->getScriptLink() );
		$this->setTemplateVar('scriptModuleLink',$this->getScriptModuleLink() );
		$this->setTemplateVar('jsExt'           ,(PRODUCTION?'.min.js' :'.js' ) );
		$this->setTemplateVar('cssExt'          ,(PRODUCTION?'.min.css':'.css') );
        $this->setTemplateVar('styleLink'       , $this->getStyleLink()  );

        $this->setTemplateVar('themeStyleLink', Html::url('index','themestyle',0,['style'=>$style]) );
        $this->setTemplateVar('manifestLink'  , Html::url('index','manifest',0,['output'=>'json']  ) );

		$themeStyle = new ThemeStyle( Configuration::subset('style')->get($style,[]) ); // user style config

        // Theme base color for smartphones colorizing their status bar.
        $this->setTemplateVar('themeColor', UIUtils::getColorHexCode($themeStyle->getThemeColor()));

        $messageOfTheDay = C::subset('login')->get('motd','');

        if ( $messageOfTheDay )
            $this->addInfoFor( new User(),Messages::MOTD,array('motd' => $messageOfTheDay) );

        if ( DEVELOPMENT )
            $this->addInfoFor( new User(),Messages::DEVELOPMENT_MODE );

		$this->setTemplateVar('favicon_url', C::subset('theme')->get('favicon','modules/cms/ui/themes/default/images/openrat-logo.ico') );

        $vars = $this->getResponse()->getOutputData();
        $this->setTemplateVar( 'notices',$vars['notices'] ); // will be extracted in the included template file.
		$this->setTemplateVar( 'charset','UTF-8' );

		$app = C::subset('application');
		$appName     = $app->get('name'    );
		$appOperator = $app->get('operator');
		$this->setTemplateVar( 'defaultTitle', $appName.(($appOperator!=$appName)?' - '.$appOperator:''));

		$this->setTemplateVar('language',C::subset('language')->get('language_code') );
    }


    public function post() {
    }


	/**
	 * Gets CSS file for displaying the UI.
	 *
	 * @return string
	 */
	protected function getStyleLink()
	{
		// Ok, for now there is only 1 CSS file, which contains all UI styles.
		return Startup::THEMES_DIR . 'default/'.(PRODUCTION?Theme::STYLE_MINIFIED_FILENAME:Theme::STYLE_FILENAME);
	}



	/**
	 * Gets JS file for displaying the UI.
	 *
	 * @return string
	 * @deprecated
	 */
	protected function getScriptLink()
	{
		return Startup::THEMES_DIR . 'default/'.(PRODUCTION?Theme::SCRIPT_MINIFIED_FILENAME:Theme::SCRIPT_FILENAME);
	}

	/**
	 * Gets JS file for displaying the UI.
	 *
	 * @return string
	 */
	protected function getScriptModuleLink()
	{
		return Startup::THEMES_DIR . 'default/script/openrat/init.'.(PRODUCTION?'min.':'').'js';
	}




	protected function tryAutoLogin()
	{
		$username = AuthRunner::getUsername('autologin');

		if	( $username )
		{
			try
			{
				$user = User::loadWithName( $username,User::AUTH_TYPE_INTERNAL );
				$user->setCurrent();
				// Do not update the login timestamp, because this is a readonly request.
				Logger::info('auto-login for user '.$username);
			}
			catch( ObjectNotFoundException $e )
			{
				Logger::warn('Username for autologin does not exist: '.$username);
			}
		}
	}


}
