<?php

namespace cms\action;

use cms\auth\Auth;
use cms\model\BaseObject;
use cms\model\Project;
use cms\model\User;
use cms\model\Value;
use Exception;
use language\Messages;
use util\json\JSON;
use logger\Logger;
use util\Less;
use util\UIUtils;
use ObjectNotFoundException;
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


	public function manifestView()
    {
        $user = Session::getUser();

        if   ( $user )
            $this->lastModified( config('config','last_modification_time') );
        else
            $this->lastModified( time() );

        $style = $this->getUserStyle( $user );

        $styleConfig     = config('style-default'); // default style config
        $userStyleConfig = config('style', $style); // user style config

        if (is_array($userStyleConfig))
            $styleConfig = array_merge($styleConfig, $userStyleConfig ); // Merging user style into default style
        else
            ; // Unknown style name, we are ignoring this.

        // Theme base color for smartphones colorizing their status bar.
        $themeColor = UIUtils::getColorHexCode($styleConfig['title_background_color']);




        $appName = config('application','name');

        $value = array(
            'name' => $appName,
            'description' => $appName,
            'short_name' => 'CMS',
            'display' => 'standalone',
            'orientation' => 'landscape',
            "background_color" => $themeColor,
        );

        header("Content-Type: application/manifest+json");

        $this->outputAsJSON( $value );
    }



    /**
     * Show the UI.
     */
	public function showView()
	{
		global $conf;

        $user = Session::getUser();

        // Is a user logged in?
        if	( !is_object($user) )
		{
		    // Lets try an auto login.
            $this->tryAutoLogin();

            $user = Session::getUser();
        }

        if	( $user )
            $this->lastModified( max( $user->loginDate,config('config','last_modification_time')) );
        else
            $this->lastModified( config('config','last_modification_time') );

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

		$this->setTemplateVar('jsFiles' , $this->getJSFiles() );
        $this->setTemplateVar('cssFiles',$this->getCSSFiles() );

        $styleConfig     = config('style-default'); // default style config
        $userStyleConfig = config('style', $style); // user style config

        if (is_array($userStyleConfig))
            $styleConfig = array_merge($styleConfig,$userStyleConfig); // Merging user style into default style
        else
            ; // Unknown style name, we are ignoring this.

        // Theme base color for smartphones colorizing their status bar.
        $this->setTemplateVar('themeColor', UIUtils::getColorHexCode($styleConfig['title_background_color']));

        $messageOfTheDay = config('login', 'motd');

        if ( !empty($messageOfTheDay) )
            $this->addInfoFor( new User(),Messages::MOTD,array('motd'=>$messageOfTheDay) );

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
		$this->setTemplateVar('favicon_url', Conf()->subset('theme')->get('favicon','modules/cms/ui/themes/default/images/openrat-logo.ico') );

        // HTML-Datei direkt einbinden.
        $vars = $this->getOutputData();
        $output  = $vars['output']; // will be extracted in the included template file.
        $notices = $vars['notices']; // will be extracted in the included template file.

		require( __DIR__.'/../themes/default/layout/index.php');
		exit;
	}



	private function getCSSFiles()
	{
		return array(
			OR_THEMES_DIR . 'default/style/openrat'.(PRODUCTION?'.min':'').'.css'
		);
	}

	
	public function themestyleView()
    {
        $themeLessFile = OR_THEMES_DIR . 'default/style/theme/openrat-theme.less';
        $this->lastModified(filemtime($themeLessFile));

        header('Content-Type: text/css');
        echo $this->getThemeCSS();
        exit;
    }



	private function getThemeCSS()
	{
		// Je Theme die Theme-CSS-Datei ausgeben.
		$lessFile = OR_THEMES_DIR . 'default/style/theme/openrat-theme.less';
		$css = '';
		
		
		foreach (array_keys(config('style')) as $styleId)
		{
			try
			{
				$parser = new Less(array(
					'sourceMap' => DEVELOPMENT,
					'indentation' => '	',
					'outputSourceFiles' => false
				));
				$parser->parseFile($lessFile,basename($lessFile));
				
				$styleConfig = array_merge( config('style-default'), config('style', $styleId) );
				$lessVars = array(
					'cms-theme-id' => strtolower($styleId),
					'cms-image-path' => 'themes/default/images/'
				);
				
				foreach ($styleConfig as $styleSetting => $value)
					$lessVars['cms-' . strtolower(strtr($styleSetting, '_', '-'))] = $value;
				$parser->modifyVars($lessVars);
				$css .= $parser->getCss();
			}
			catch (Exception $e)
			{
				$css .= "\n\n/* WARNING!\n   LESS Parser failed on file '$lessFile'. Reason: " . $e->__toString() . " */\n\n";
			}
		}
		
		if (PRODUCTION)
		{
			return $css; // Should we minify here? Bandwidth vs. cpu-load.
		}
		else
		{
			return $css;
		}
	}	
	


	private function getJSFiles()
	{
		return array(
			OR_THEMES_DIR . 'default/script/openrat'.(PRODUCTION?'.min':'').'.js'
		);
	}
	

	private function getColorHexCode($colorName ) {

	    $colorName = strtolower($colorName);

        $colors = array(
            'aliceblue'=>'#f0f8ff',
            'antiquewhite'=>'#faebd7',
            'aqua'=>'#00ffff',
            'aquamarine'=>'#7fffd4',
            'azure'=>'#f0ffff',
            'beige'=>'#f5f5dc',
            'bisque'=>'#ffe4c4',
            'black'=>'#000000',
            'blanchedalmond'=>'#ffebcd',
            'blue'=>'#0000ff',
            'blueviolet'=>'#8a2be2',
            'brown'=>'#a52a2a',
            'burlywood'=>'#deb887',
            'cadetblue'=>'#5f9ea0',
            'chartreuse'=>'#7fff00',
            'chocolate'=>'#d2691e',
            'coral'=>'#ff7f50',
            'cornflowerblue'=>'#6495ed',
            'cornsilk'=>'#fff8dc',
            'crimson'=>'#dc143c',
            'cyan'=>'#00ffff',
            'darkblue'=>'#00008b',
            'darkcyan'=>'#008b8b',
            'darkgoldenrod'=>'#b8860b',
            'darkgray'=>'#a9a9a9',
            'darkgrey'=>'#a9a9a9',
            'darkgreen'=>'#006400',
            'darkkhaki'=>'#bdb76b',
            'darkmagenta'=>'#8b008b',
            'darkolivegreen'=>'#556b2f',
            'darkorange'=>'#ff8c00',
            'darkorchid'=>'#9932cc',
            'darkred'=>'#8b0000',
            'darksalmon'=>'#e9967a',
            'darkseagreen'=>'#8fbc8f',
            'darkslateblue'=>'#483d8b',
            'darkslategray'=>'#2f4f4f',
            'darkslategrey'=>'#2f4f4f',
            'darkturquoise'=>'#00ced1',
            'darkviolet'=>'#9400d3',
            'deeppink'=>'#ff1493',
            'deepskyblue'=>'#00bfff',
            'dimgray'=>'#696969',
            'dimgrey'=>'#696969',
            'dodgerblue'=>'#1e90ff',
            'firebrick'=>'#b22222',
            'floralwhite'=>'#fffaf0',
            'forestgreen'=>'#228b22',
            'fuchsia'=>'#ff00ff',
            'gainsboro'=>'#dcdcdc',
            'ghostwhite'=>'#f8f8ff',
            'gold'=>'#ffd700',
            'goldenrod'=>'#daa520',
            'gray'=>'#808080',
            'grey'=>'#808080',
            'green'=>'#008000',
            'greenyellow'=>'#adff2f',
            'honeydew'=>'#f0fff0',
            'hotpink'=>'#ff69b4',
            'indianred'=>'#cd5c5c',
            'indigo'=>'#4b0082',
            'ivory'=>'#fffff0',
            'khaki'=>'#f0e68c',
            'lavender'=>'#e6e6fa',
            'lavenderblush'=>'#fff0f5',
            'lawngreen'=>'#7cfc00',
            'lemonchiffon'=>'#fffacd',
            'lightblue'=>'#add8e6',
            'lightcoral'=>'#f08080',
            'lightcyan'=>'#e0ffff',
            'lightgoldenrodyellow'=>'#fafad2',
            'lightgray'=>'#d3d3d3',
            'lightgrey'=>'#d3d3d3',
            'lightgreen'=>'#90ee90',
            'lightpink'=>'#ffb6c1',
            'lightsalmon'=>'#ffa07a',
            'lightseagreen'=>'#20b2aa',
            'lightskyblue'=>'#87cefa',
            'lightslategray'=>'#778899',
            'lightslategrey'=>'#778899',
            'lightsteelblue'=>'#b0c4de',
            'lightyellow'=>'#ffffe0',
            'lime'=>'#00ff00',
            'limegreen'=>'#32cd32',
            'linen'=>'#faf0e6',
            'magenta'=>'#ff00ff',
            'maroon'=>'#800000',
            'mediumaquamarine'=>'#66cdaa',
            'mediumblue'=>'#0000cd',
            'mediumorchid'=>'#ba55d3',
            'mediumpurple'=>'#9370d8',
            'mediumseagreen'=>'#3cb371',
            'mediumslateblue'=>'#7b68ee',
            'mediumspringgreen'=>'#00fa9a',
            'mediumturquoise'=>'#48d1cc',
            'mediumvioletred'=>'#c71585',
            'midnightblue'=>'#191970',
            'mintcream'=>'#f5fffa',
            'mistyrose'=>'#ffe4e1',
            'moccasin'=>'#ffe4b5',
            'navajowhite'=>'#ffdead',
            'navy'=>'#000080',
            'oldlace'=>'#fdf5e6',
            'olive'=>'#808000',
            'olivedrab'=>'#6b8e23',
            'orange'=>'#ffa500',
            'orangered'=>'#ff4500',
            'orchid'=>'#da70d6',
            'palegoldenrod'=>'#eee8aa',
            'palegreen'=>'#98fb98',
            'paleturquoise'=>'#afeeee',
            'palevioletred'=>'#d87093',
            'papayawhip'=>'#ffefd5',
            'peachpuff'=>'#ffdab9',
            'peru'=>'#cd853f',
            'pink'=>'#ffc0cb',
            'plum'=>'#dda0dd',
            'powderblue'=>'#b0e0e6',
            'purple'=>'#800080',
            'red'=>'#ff0000',
            'rosybrown'=>'#bc8f8f',
            'royalblue'=>'#4169e1',
            'saddlebrown'=>'#8b4513',
            'salmon'=>'#fa8072',
            'sandybrown'=>'#f4a460',
            'seagreen'=>'#2e8b57',
            'seashell'=>'#fff5ee',
            'sienna'=>'#a0522d',
            'silver'=>'#c0c0c0',
            'skyblue'=>'#87ceeb',
            'slateblue'=>'#6a5acd',
            'slategray'=>'#708090',
            'slategrey'=>'#708090',
            'snow'=>'#fffafa',
            'springgreen'=>'#00ff7f',
            'steelblue'=>'#4682b4',
            'tan'=>'#d2b48c',
            'teal'=>'#008080',
            'thistle'=>'#d8bfd8',
            'tomato'=>'#ff6347',
            'turquoise'=>'#40e0d0',
            'violet'=>'#ee82ee',
            'wheat'=>'#f5deb3',
            'white'=>'#ffffff',
            'whitesmoke'=>'#f5f5f5',
            'yellow'=>'#ffff00',
            'yellowgreen'=>'#9acd32'
        );

        return isset($colors[$colorName])?$colors[$colorName]:$colorName;
    }


    /**
     * Ermittelt die erste zu startende Aktion.
     * @param $action
     * @param $id
     */
    private function updateStartAction( &$action, &$id )
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


        // Das zuletzt geänderte Objekt benutzen.
        if	( config('login','start','start_lastchanged_object') )
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
        if	( config('login','start','start_single_project') )
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

    private function tryAutoLogin()
    {
        $modules  = config('security','autologin','modules');
        $username = null;

        foreach( $modules as $module)
        {
            Logger::debug( 'Auto-Login module: '.$module );
            $moduleClass = 'cms\auth\\'.$module.'Auth';
            $auth = new $moduleClass;
            /* @type $auth Auth */
            try {

                $username = $auth->username();
            }
            catch( Exception $e ) {
                Logger::warn( 'Error in auth-module '.$module.":\n".$e->__toString() );
                // Ignore this and continue with next module.
            }

            if	( $username )
            {
                Logger::debug('Auto-Login for User '.$username.' with auth-module '.$module);
                break; // Benutzername gefunden.
            }
        }

        if	( $username )
        {
            try
            {
                $user = User::loadWithName( $username );
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
    private function getUserStyle( $user )
    {
        // Theme für den angemeldeten Benuter ermitteln
        if  ( $user && isset(config('style')[$user->style]))
            $style = $user->style;
        else
            $style = config('interface', 'style', 'default');
        return $style;
    }

    /**
     * @param array $output
     */
    protected function outputAsJSON( $output )
    {
        $json = new JSON();
        header('Content-Type: application/json');
        echo $json->encode($output);
        exit;
    }

}
?>