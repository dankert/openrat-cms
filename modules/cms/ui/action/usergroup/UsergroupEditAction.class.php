<?php
namespace cms\ui\action\usergroup;
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
 * Simple action to display a navigation.
 *
 * @package cms\ui\action\index
 */
class UsergroupEditAction extends IndexAction implements Method {

    public function view() {
		// no data is needed to display the template.
    }


    public function post() {
    	// no data is written.
    }
}
