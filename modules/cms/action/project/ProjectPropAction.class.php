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
		if	( $this->getRequestVar('name') != '')
		{
			$this->project->name                 = $this->getRequestVar('name'               ,RequestParams::FILTER_ALPHANUM);
			$this->project->url                  = $this->getRequestVar('url'                ,RequestParams::FILTER_ALPHANUM);
			$this->project->target_dir           = $this->getRequestVar('target_dir'         ,RequestParams::FILTER_RAW     );
			$this->project->ftp_url              = $this->getRequestVar('ftp_url'            ,RequestParams::FILTER_RAW     );
			$this->project->ftp_passive          = $this->getRequestVar('ftp_passive'        ,RequestParams::FILTER_RAW     );
			$this->project->cmd_after_publish    = $this->getRequestVar('cmd_after_publish'  ,RequestParams::FILTER_RAW     );
			$this->project->content_negotiation  = $this->getRequestVar('content_negotiation',RequestParams::FILTER_NUMBER  );
			$this->project->cut_index            = $this->getRequestVar('cut_index'          ,RequestParams::FILTER_NUMBER  );
			$this->project->publishFileExtension = $this->getRequestVar('publishFileExtension',RequestParams::FILTER_NUMBER  );
			$this->project->publishPageExtension = $this->getRequestVar('publishPageExtension',RequestParams::FILTER_NUMBER  );
			$this->project->linkAbsolute         = $this->getRequestVar('linksAbsolute'       ,RequestParams::FILTER_NUMBER  ) == '1';

			$this->addNoticeFor($this->project,Messages::SAVED);
			$this->project->save(); // speichern
			
			$root = new Folder( $this->project->getRootObjectId() );
			$root->setTimestamp();
		}
		else
		{
			$this->addValidationError('name');
			$this->callSubAction('edit');
		}
    }
}
