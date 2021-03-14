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

		$this->project->name                 = $this->request->getRequiredText('name' );
		$this->project->url                  = $this->request->getAlphanum('url'                );
		$this->project->target_dir           = $this->request->getRaw('target_dir'              );
		$this->project->ftp_url              = $this->request->getRaw('ftp_url'                 );
		$this->project->ftp_passive          = $this->request->getRaw('ftp_passive'             );
		$this->project->cmd_after_publish    = $this->request->getRaw('cmd_after_publish'       );
		$this->project->content_negotiation  = $this->request->getNumber('content_negotiation'  );
		$this->project->cut_index            = $this->request->getNumber('cut_index'            );
		$this->project->publishFileExtension = $this->request->getNumber('publishFileExtension' );
		$this->project->publishPageExtension = $this->request->getNumber('publishPageExtension' );
		$this->project->linkAbsolute         = $this->request->getNumber('linksAbsolute'        );

		$this->addNoticeFor($this->project,Messages::SAVED);
		$this->project->save(); // speichern

		$root = new Folder( $this->project->getRootObjectId() );
		$root->setTimestamp();
    }
}
