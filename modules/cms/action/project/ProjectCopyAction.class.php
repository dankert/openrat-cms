<?php
namespace cms\action\project;
use cms\action\Method;
use cms\action\ProjectAction;
use cms\base\Configuration;
use cms\base\DB;
use language\Messages;

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
		
		
		if	( $this->request->has('ok') )
		{
			$this->project->export( $this->request->getDatabaseId() );
			
			$this->addNoticeFor($this->project,Messages::DONE);
		}
    }
}
