<?php
namespace cms\action\user;
use cms\action\Action;
use cms\action\Method;
use cms\action\UserAction;
use cms\model\Permission;
use cms\model\BaseObject;
use cms\model\Group;
use cms\model\Language;
use cms\model\Project;
use cms\model\User;
use language\Messages;


class UserRightsAction extends UserAction implements Method {
    public function view() {
        $rights = $this->user->getAllAcls();

        $projects = array();

        foreach( $rights as $acl )
        {
            /* @var $acl Permission */
            if	( !isset($projects[$acl->projectid]))
			{
                $p = Project::create( $acl->projectid );

                $projects[$acl->projectid] = array();
                $projects[$acl->projectid]['projectname'] = $p->load()->name;
				$projects[$acl->projectid]['rights'     ] = array();
			}

			$right = array();
			
			if	( $acl->languageid > 0 )
			{
				$language = new Language($acl->languageid);
				$language->load();
				$right['languagename'] = $language->name;
			}
			else
			{
				$right['languagename'] = \cms\base\Language::lang('ALL_LANGUAGES');
			}
			
			
			$o = new BaseObject($acl->objectid);
			$o->objectLoad();
			$right['objectname'] = $o->name;
			$right['objectid'  ] = $o->objectid;
			$right['objecttype'] = $o->getType();
			
			if	( $acl->userid > 0 )
			{
				$user = new User($acl->userid);
				$user->load();
				$right['username'] = $user->name;
			}
			elseif	( $acl->groupid > 0 )
			{
				$group = new Group($acl->groupid);
				$group->load();
				$right['groupname'] = $group->name;
			}
			else
			{
			    ;
				// Berechtigung fuer "alle".
			}

//			$show = array();
//			foreach( $acl->getProperties() as $p=>$set)
//				$show[$p] = $set;
//				
//			$right['show'] = $show;
			$right['bits'] = $acl->getProperties();
			
			$projects[$acl->projectid]['rights'][] = $right;
		}
		
		$this->setTemplateVar('projects'    ,$projects );
		
		$this->setTemplateVar('show',Permission::getAvailableRights() );
		
		if	( $this->user->isAdmin )
			$this->addWarningFor($this->user,Messages::ADMIN_NEEDS_NO_RIGHTS);
    }
    public function post() {
    }
}
