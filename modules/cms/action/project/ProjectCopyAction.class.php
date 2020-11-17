<?php
namespace cms\action\project;
use cms\action\Method;
use cms\action\ProjectAction;
use cms\base\Configuration;
use cms\base\DB;

class ProjectCopyAction extends ProjectAction implements Method {
    public function view() {

    }
    public function post() {
		$db = DB::get();
		$this->setTemplateVar( 'dbid',$db->id );

		$conf = Configuration::rawConfig();
		$dbids = array();
		
		foreach( $conf['database'] as $dbname=>$dbconf )
		{
			if	( is_array($dbconf) && $dbconf['enabled'])
				$dbids[$dbname] = $dbconf['description'];
		}
		$this->setTemplateVar( 'dbids',$dbids );
		
		
		if	( $this->hasRequestVar('ok') )
		{
			$this->project->export( $this->getRequestVar('dbid') );
			
			$this->addNotice('project', 0, $this->project->name, 'DONE');
			$this->setTemplateVar('done',true);
		}
    }
}
