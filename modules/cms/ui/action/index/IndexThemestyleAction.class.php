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
}
