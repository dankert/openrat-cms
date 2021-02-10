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

		$this->setContentSecurityPolicy();

        $user = Session::getUser();

        // Is a user logged in?
        if	( !is_object($user) )
		{
		    // Lets try an auto login.
            $this->tryAutoLogin();

            $user = Session::getUser();
        }

		$configLastModificationTime = C::subset('config')->get('last_modification_time', 0);

        if	( $user )
			$this->lastModified( max( $user->loginDate, $configLastModificationTime) );
        else
            $this->lastModified( $configLastModificationTime );

        // Theme für den angemeldeten Benuter ermitteln
        $style = $this->getUserStyle($user);

        $this->setTemplateVar('style',$style );

        $userIsLoggedIn = is_object($user);

        // Welche Aktion soll ausgeführt werden?
        $action = '';
        $id     = 0;
        $this->updateStartAction( $action, $id );

        $this->setTemplateVar('action',$action);
        $this->setTemplateVar('id'    ,$id    );

		$this->setTemplateVar('scriptLink', $this->getScriptLink() );
        $this->setTemplateVar('styleLink' , $this->getStyleLink()  );

        $this->setTemplateVar('themeStyleLink', Html::url('index','themestyle') );
        $this->setTemplateVar('manifestLink'  , Html::url('index','manifest'  ) );

		$themeStyle = new ThemeStyle( Configuration::subset('style')->get($style,[]) ); // user style config

        // Theme base color for smartphones colorizing their status bar.
        $this->setTemplateVar('themeColor', UIUtils::getColorHexCode($themeStyle->getThemeColor()));

        $messageOfTheDay = C::subset('login')->get('motd','');

        if ( $messageOfTheDay )
            $this->addInfoFor( new User(),Messages::MOTD,array('motd' => $messageOfTheDay) );

        if ( DEVELOPMENT )
            $this->addInfoFor( new User(),Messages::DEVELOPMENT_MODE );

        $methods = array(
            'edit'     => true,
            'preview'  => true,
            'info'     => true,
			'rights'   => true,
        );

        $methodList = array();
        foreach( $methods as $method=>$openByDefault )
        {
            $methodList[] = array('name'=>$method,'open'=>$openByDefault);
        }
        $this->setTemplateVar('methodList', $methodList);
		$this->setTemplateVar('favicon_url', C::subset('theme')->get('favicon','modules/cms/ui/themes/default/images/openrat-logo.ico') );

        $vars = $this->getOutputData();
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
	 */
	protected function getScriptLink()
	{
		return Startup::THEMES_DIR . 'default/'.(PRODUCTION?Theme::SCRIPT_MINIFIED_FILENAME:Theme::SCRIPT_FILENAME);
	}


	/**
	 * Ermittelt die erste zu startende Aktion.
	 * @param $action
	 * @param $id
	 */
	protected function updateStartAction(&$action, &$id )
	{
		$user = Session::getUser();

		if  ( !is_object($user) )
		{
			$action = 'login';
			$id     = 0;
			return;
		}


		// Die Action im originalen Request hat Priorität.
		$params = new RequestParams();
		if   ( !empty( $params->action ) )
		{
			$action = $params->action;
			$id     = $params->id;
			return;
		}


		$startConfig = Configuration::subset( ['login','start'] );
		// Das zuletzt geänderte Objekt benutzen.
		if	( $startConfig->is('start_lastchanged_object',true) )
		{
			$objectid = Value::getLastChangedObjectByUserId($user->userid);

			if	( BaseObject::available($objectid))
			{
				$object = new BaseObject($objectid);
				$object->objectLoad();

				$action = $object->getType();
				$id     = $objectid;
				return;
			}
		}

		// Das einzige Projekt benutzen
		if	( $startConfig->is('start_single_project',true) )
		{
			$projects = Project::getAllProjects();
			if ( count($projects) == 1 ) {
				// Das einzige Projekt sofort starten.
				$action = 'project';
				$id     = array_keys($projects)[0];
			}
		}

		$action = 'projectlist';
		$id     = 0;
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

				// Kein Auto-Login moeglich, die Anmeldemaske anzeigen.
				$this->setTemplateVars( array('dialogAction'=>'login','dialogMethod'=>'login'));
			}
		}
		else
		{
			// Kein Auto-Login moeglich, die Anmeldemaske anzeigen.
			$this->setTemplateVars( array('dialogAction'=>'login','dialogMethod'=>'login'));
		}
	}


}
