<?php

namespace template_engine\components;

class QrcodeComponent extends Component
{

	public $title;
	
	
	
	protected function begin()
	{
		$value = $this->htmlvalue($this->value);
		echo <<<HTML
<div class="qrcode" data-qrcode="{$value}" title="{$value}"></div>
HTML;
	}

}

?>