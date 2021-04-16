<?php
namespace cms\action\login;
use cms\action\LoginAction;
use cms\action\Method;
use cms\base\Configuration;
use util\Session;


class LoginLicenseAction extends LoginAction implements Method {
    public function view() {
		$software = array_map( function($lib) {
			return [
				'name'    => $lib[0],
				'url'     => $lib[1],
				'license' => $lib[2]
			];
		},[
			['OpenRat Content Management System' ,'http://www.openrat.de/'      ,'GPL v2'     ],
			['jQuery Core Javascript Framework'  ,'http://jquery.com/'          ,'MPL, GPL v2'],
			['GeSHi - Generic Syntax Highlighter','http://qbnz.com/highlighter/','GPL v2'     ],
			['CodeMirror'                        ,'https://codemirror.net/'     ,'MIT'        ],
			['SimpleMDE'                         ,'https://simplemde.com/'      ,'MIT'        ],
			['Trumbowyg'                         ,'https://alex-d.github.io/Trumbowyg/','MIT' ],
			['TAR file format'                   ,'http://www.phpclasses.org/package/529','LGPL'],
			['JSON file format'                  ,'http://pear.php.net/pepr/pepr-proposal-show.php?id=198','BSD'],
		] );
		
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
