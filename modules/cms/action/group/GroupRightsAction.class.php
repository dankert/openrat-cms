<?php
namespace cms\action\group;
use cms\action\GroupAction;
use cms\action\Method;
use cms\model\Permission;
use cms\model\BaseObject;
use cms\model\Group;
use cms\model\Language;
use cms\model\Project;

class GroupRightsAction extends GroupAction implements Method {


    public function view() {
		$rights = $this->group->getAllAcls();

		$projects = array();
		
		foreach( $rights as $acl )
		{
			if	( !isset($projects[$acl->projectid]))
			{
				$projects[$acl->projectid] = array();
				$p = new Project($acl->projectid);
				$p->load();
				$projects[$acl->projectid]['projectname'] = $p->name;
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
			$right['objectname'] = $o->filename;
			$right['objectid'  ] = $o->objectid;
			$right['objecttype'] = $o->getType();
			
			if	( $acl->groupid > 0 )
			{
				$group = new Group($acl->groupid);
				$group->load();
				$right['groupname'] = $group->name;
			}
			else
			{
				// Berechtigung f�r "alle".
			}

			$right['bits'] = $acl->getProperties();
			
			$projects[$acl->projectid]['rights'][] = $right;
		}
		
		$this->setTemplateVar('projects'    ,$projects );
		
		$this->setTemplateVar('show',Permission::getAvailableRights() );
    }


    public function post() {
    }
}
