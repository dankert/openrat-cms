<?php

namespace template_engine\components;

class QrcodeComponent extends Component
{

	public $title;
	
	
	
	protected function begin()
	{
		$value = $this->htmlvalue($this->value);
		$title = lang('QRCODE_SHOW');
		echo <<<HTML
<i class="image-icon image-icon--menu-qrcode or-qrcode or-info" data-qrcode="{$value}" title="{$title}"></i>
HTML;
	}

}

?>