<?php

namespace template_engine\components;

use template_engine\element\CMSElement;
use template_engine\element\Value;
use template_engine\element\ValueExpression;

class QrcodeComponent extends Component
{

	public $value;
	

	public function createElement()
	{
		$qrcode = (new CMSElement('i'))
			->addStyleClass('image-icon')
			->addStyleClass('image-icon--menu-qrcode')
			->addStyleClass('or-qrcode')
			->addStyleClass('or-info')
			->addAttribute('data-qrcode', $this->value)
			->addAttribute('title', Value::createExpression(ValueExpression::TYPE_MESSAGE, 'QRCODE_SHOW'));

		return $qrcode;
	}
}