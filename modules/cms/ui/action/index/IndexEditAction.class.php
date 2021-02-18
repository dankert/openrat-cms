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

/**
 * Main action, displayed after starting the UI.
 *
 * @package cms\ui\action\index
 */
class IndexEditAction extends IndexAction implements Method {

    public function view() {

    	$this->setTemplateVar('isAdmin',$this->userIsAdmin() );
    }


    public function post() {
    }
}
