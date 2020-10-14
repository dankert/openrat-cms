<?php

namespace template_engine\components\html\component_logo;

use template_engine\components\html\Component;
use template_engine\element\CMSElement;use template_engine\element\HtmlElement;
use template_engine\element\Value;
use template_engine\element\ValueExpression;

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
