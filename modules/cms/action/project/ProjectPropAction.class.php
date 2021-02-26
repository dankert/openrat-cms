<?php
namespace cms\action\project;
use cms\action\Method;
use cms\action\ProjectAction;
use cms\action\RequestParams;
use cms\model\Folder;
use language\Messages;

class ProjectPropAction extends ProjectAction implements Method {
    public function view() {
		$extraProperties = array(
		    'rootobjectid'  => $this->project->getRootObjectId(),
            'linksAbsolute' => $this->project->linkAbsolute?'1':'0'
        );
		
		$this->setTemplateVars( $this->project->getProperties() + $extraProperties );

    }
    public function post() {
		if	( $this->request->getText('name') != '')
		{
			$this->project->name                 = $this->request->getVar('name'               ,RequestParams::FILTER_ALPHANUM);
			$this->project->url                  = $this->request->getVar('url'                ,RequestParams::FILTER_ALPHANUM);
			$this->project->target_dir           = $this->request->getVar('target_dir'         ,RequestParams::FILTER_RAW     );
			$this->project->ftp_url              = $this->request->getVar('ftp_url'            ,RequestParams::FILTER_RAW     );
			$this->project->ftp_passive          = $this->request->getVar('ftp_passive'        ,RequestParams::FILTER_RAW     );
			$this->project->cmd_after_publish    = $this->request->getVar('cmd_after_publish'  ,RequestParams::FILTER_RAW     );
			$this->project->content_negotiation  = $this->request->getVar('content_negotiation',RequestParams::FILTER_NUMBER  );
			$this->project->cut_index            = $this->request->getVar('cut_index'          ,RequestParams::FILTER_NUMBER  );
			$this->project->publishFileExtension = $this->request->getVar('publishFileExtension',RequestParams::FILTER_NUMBER  );
			$this->project->publishPageExtension = $this->request->getVar('publishPageExtension',RequestParams::FILTER_NUMBER  );
			$this->project->linkAbsolute         = $this->request->getVar('linksAbsolute'       ,RequestParams::FILTER_NUMBER  ) == '1';

			$this->addNoticeFor($this->project,Messages::SAVED);
			$this->project->save(); // speichern
			
			$root = new Folder( $this->project->getRootObjectId() );
			$root->setTimestamp();
		}
		else
		{
			$this->addValidationError('name');
		}
    }
}
