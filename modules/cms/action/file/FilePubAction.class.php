<?php
namespace cms\action\file;
use cms\action\FileAction;
use cms\action\Method;
use cms\generator\FileContext;
use cms\generator\FileGenerator;
use cms\generator\Producer;
use cms\generator\Publisher;
use cms\generator\PublishOrder;

class FilePubAction extends FileAction implements Method {
    public function view() {
    }
    public function post() {
		$fileGenerator = new FileGenerator( new FileContext( $this->file->objectid, Producer::SCHEME_PUBLIC));

		$publisher = new Publisher( $this->file->projectid );
		$publisher->addOrderForPublishing( new PublishOrder( $fileGenerator->getCache()->load()->getFilename(),$fileGenerator->getPublicFilename(),$this->file->lastchangeDate) );
		$publisher->publish();

		$this->file->setPublishedTimestamp();
		$this->addNoticeFor($this->file,'PUBLISHED',[],'Published items:'."\n".implode("\n",$publisher->getDestinationFilenames())  );
    }
}
