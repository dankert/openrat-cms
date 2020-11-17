<?php

namespace cms\ui\action;

use cms\action\Action;
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
use util\Session;


/**
 * Action-Klasse fuer die Anzeige der Hauptseite.
 * 
 * @author Jan Dankert
 * @package openrat.actions
 */
class IndexAction extends Action
{
	public $security = Action::SECURITY_GUEST;

	
	/**
	 * Konstruktor
	 */
	function __construct()
	{
        parent::__construct();
	}


	/**
	 * Getting the website manifest file.
	 */
	public function manifestView()
    {
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
        $themeColor = UIUtils::getColorHexCode($styleConfig['title_background_color']);


        $appName = C::subset(['application'])->get('name',Startup::TITLE);

        $value = array(
            'name'        => $appName,
            'description' => $appName,
            'short_name'  => 'CMS',
            'display'     => 'standalone',
            'orientation' => 'landscape',
            'background_color' => $themeColor,
        );

        header("Content-Type: application/manifest+json");
		$json = new JSON();
		$this->setTemplateVar( 'manifest',$json->encode($value) );
	}



    /**
     * Show the UI.
     */
	public function showView()
	{
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

        $styleConfig     = C::Conf()->get('style-default',[]); // default style config
        $userStyleConfig = C::subset('style')->get( $style,[]); // user style config

        if ( $userStyleConfig )
            $styleConfig = array_merge($styleConfig,$userStyleConfig); // Merging user style into default style
        else
            ; // Unknown style name, we are ignoring this.

        // Theme base color for smartphones colorizing their status bar.
        $this->setTemplateVar('themeColor', UIUtils::getColorHexCode($styleConfig['title_background_color']));

        $messageOfTheDay = C::subset('login')->get('motd','');

        if ( $messageOfTheDay )
            $this->addInfoFor( new User(),Messages::MOTD,array('motd' => $messageOfTheDay) );

        if ( DEVELOPMENT )
            $this->addInfoFor( new User(),Messages::DEVELOPMENT_MODE );

        $methods = array(
            'edit'     => true,
            'preview'  => true,
            'info'     => true,
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

		$this->setTemplateVar('language',Configuration::subset('language')->get('language_code') );
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

	
	public function themestyleView()
    {
        $themeLessFile = Startup::THEMES_DIR . 'default/style/theme/openrat-theme.less';
        $this->lastModified(filemtime($themeLessFile));

        header('Content-Type: text/css');

        $this->setTemplateVar('style',$this->getThemeCSS() );
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

    /**
     * @param User $user
     * @return \configuration\Config|string
     */
    protected function getUserStyle($user )
    {
        // Theme für den angemeldeten Benuter ermitteln
        if  ( $user && C::subset('style')->has($user->style) )
            $style = $user->style;
        else
            $style = C::subset( ['interface', 'style'])->get('default','default');
        return $style;
    }




	/**
	 * Content-Security-Policy.
	 */
	protected function setContentSecurityPolicy()
	{
		$csp = Configuration::subset('security' )->get('csp', [
			'default-src' =>'\'self\'', // Default for all is 'self' (CSS, styles, etc)
			'frame-src'   => '*'        // For preview of urls we need to show every url in an iframe.
		] );

		header('Content-Security-Policy: ' . implode(';', array_map( function($value,$key) {
				return $key.' '.$value;
			},$csp,array_keys($csp) )));
	}

}
