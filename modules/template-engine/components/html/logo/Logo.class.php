<?php

namespace template_engine\components;

use modules\template_engine\CMSElement;use modules\template_engine\HtmlElement;
use modules\template_engine\Value;
use modules\template_engine\ValueExpression;

class LogoComponent extends Component
{
	public $name;

	public function createElement()
	{
		$logo = new CMSElement('div');
		$logo->addStyleClass('line logo');

		$label = (new HtmlElement('div'))->addStyleClass('label');

		$image = (new CMSElement('img'))->addAttribute('src','themes/default/images/logo_'.$this->name.'.png')->addAttribute('border','0');
		$label->addChild($image);

		$logo->addChild($label);

		$holder = (new HtmlElement('div'))->addStyleClass('input');
		$logo->addChild($holder);

		$holder->addChild( (new CMSElement('h2'))->content(Value::createExpression( ValueExpression::TYPE_MESSAGE,'logo_'.$this->name        )));
		$holder->addChild( (new CMSElement('p') )->content(Value::createExpression( ValueExpression::TYPE_MESSAGE,'logo_'.$this->name.'_text')));

		return $logo;
	}

}
