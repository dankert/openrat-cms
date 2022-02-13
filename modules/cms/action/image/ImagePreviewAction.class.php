<?php
namespace cms\action\image;
use cms\action\ImageAction;
use cms\action\Method;
use cms\model\Value;
use util\exception\SecurityException;
use util\Html;

class ImagePreviewAction extends ImageAction implements Method {

    public function view() {
		$params = [
			'output' => 'preview',
		];

		$valueid = $this->request->getNumber('valueid');

		if   ( $valueid ) {

			$value = new Value();
			$value->loadWithId( $valueid );
			if   ( $value->contentid != $this->image->contentid )
				throw new SecurityException('content '.$value->contentid.' does not belong to this file which has content-id '.$this->image->contentid);

			$params[ 'valueid' ] = $valueid;
			$this->setTemplateVar('lastchange_date', $value->lastchangeTimeStamp);
		}else {
			$this->setTemplateVar('lastchange_date', $this->image->lastchangeDate);
		}

       $this->setTemplateVar('url', Html::url('image','show',$this->image->objectid,$params ) );
    }


    public function post() {
    }
}
