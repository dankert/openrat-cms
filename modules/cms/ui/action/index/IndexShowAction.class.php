<?php
namespace cms\ui\action\index;
use cms\action\Method;
use cms\model\User;
use cms\ui\action\IndexAction;
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

		$this->setTemplateVar('language',C::subset('language')->get('language_code') );
    }
    public function post() {
    }
}
