<?php
namespace cms\action\login;
use cms\action\LoginAction;
use cms\action\Method;
use cms\base\Configuration;
use util\Session;


class LoginLicenseAction extends LoginAction implements Method {
    public function view() {
		$software = array();
		
		$software[] = array('name'   =>'OpenRat Content Management System',
		                    'url'    =>'http://www.openrat.de/',
		                    'license'=>'GPL v2');
		$software[] = array('name'   =>'jQuery Core Javascript Framework',
		                    'url'    =>'http://jquery.com/',
		                    'license'=>'MPL, GPL v2');
		$software[] = array('name'   =>'jQuery UI Javascript Framework',
		                    'url'    =>'http://jqueryui.com/',
		                    'license'=>'MPL, GPL v2');
		$software[] = array('name'   =>'GeSHi - Generic Syntax Highlighter',
		                    'url'    =>'http://qbnz.com/highlighter/',
		                    'license'=>'GPL v2');
		$software[] = array('name'   =>'TAR file format',
		                    'url'    =>'http://www.phpclasses.org/package/529',
		                    'license'=>'LGPL');
		$software[] = array('name'   =>'JSON file format',
		                    'url'    =>'http://pear.php.net/pepr/pepr-proposal-show.php?id=198',
		                    'license'=>'BSD');
		
		$this->setTemplateVar('software',$software);



        $this->setTemplateVar('time'     ,date('r')     );
        $this->setTemplateVar('os'       ,php_uname('s') );
        $this->setTemplateVar('release'  ,php_uname('r') );
        $this->setTemplateVar('machine'  ,php_uname('m') );
        $this->setTemplateVar('version' , phpversion()          );

        $this->setTemplateVar('cms_name'    , Configuration::Conf()->subset('application')->get('name'    ) );
        $this->setTemplateVar('cms_version' , Configuration::Conf()->subset('application')->get('version' ) );
        $this->setTemplateVar('cms_operator', Configuration::Conf()->subset('application')->get('operator') );

        $user = Session::getUser();
        if   ( !empty($user) )
        {
            $this->setTemplateVar('user_login'   , $user->loginDate );
            $this->setTemplateVar('user_name'    , $user->name      );
            $this->setTemplateVar('user_fullname', $user->fullname  );
        }

    }


    public function post() {
    }
}
