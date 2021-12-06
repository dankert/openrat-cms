<?php
namespace cms\action\language;
use cms\action\LanguageAction;
use cms\action\Method;
use cms\model\Project;
use language\Messages;


class LanguageRemoveAction extends LanguageAction implements Method {

    public function view() {

		$this->setTemplateVar('name'   ,$this->language->name   );
    }


    public function post() {
		if   ( $this->request->getRequiredNumber('confirm') ) {

			$project = Project::create( $this->language->projectid );

			// There must be at least 1 language
			if   ( count( $project->getLanguageIds() ) > 1 ) {

				$this->language->delete();

				$this->addNoticeFor( $this->language, Messages::DELETED );
			}
		}
    }
}
