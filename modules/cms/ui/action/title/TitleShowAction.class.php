<?php
namespace cms\ui\action\title;
use cms\action\Method;
use cms\base\Configuration;
use cms\base\DB;
use cms\base\Startup;
use cms\ui\action\TitleAction;
use util\Html;
use util\Session;

class TitleShowAction extends TitleAction implements Method {

    public function view() {

		$this->setTemplateVar('buildinfo',Startup::TITLE.' '.Startup::VERSION.' - build date '.Startup::DATE );

		$user = Session::getUser();

		if	( !is_object($user) )
		{
            $this->setTemplateVar('isLoggedIn'  ,false );
            $this->setTemplateVar('userfullname',\cms\base\Language::lang('NOT_LOGGED_IN') );
            return; // Kein Benutzer angemeldet.
        }

        $this->setTemplateVar('isLoggedIn',true );

		if   ( DEVELOPMENT ) {
			$db = DB::get();
			$this->setTemplateVar('dbname',$db->conf['name'].(Startup::readonly()?' ('.\cms\base\Language::lang('readonly').')':''));
			$this->setTemplateVar('dbid'  ,$db->id);
		}

        $this->setTemplateVar('username'    ,$user->name    );
        $this->setTemplateVar('userfullname',$user->fullname);

		// Urls zum Benutzerprofil und zum Abmelden
		//$this->setTemplateVar('profile_url',Html::url( 'profile'         ));
		//$this->setTemplateVar('logout_url' ,Html::url( 'index','logout'  ));
		$this->setTemplateVar('isAdmin',$this->userIsAdmin() );

		if	( Configuration::subset(['interface','session'])->is('auto_extend',true) )
		{
			$this->setTemplateVar('ping_url'    ,Html::url('title','ping')            );			
			$this->setTemplateVar('ping_timeout',ini_get('session.gc_maxlifetime')-60 );
		}
    }


    public function post() {
    }
}
