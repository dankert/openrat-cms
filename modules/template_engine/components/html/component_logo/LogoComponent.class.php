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
		$logo = (new CMSElement('div'))->addStyleClass('logo');

		$label = (new HtmlElement('div'))->addStyleClass('logo-icon');

		$image = (new CMSElement('i'))->addStyleClass(['image-icon','image-icon--method-'.$this->name]);
		$label->addChild($image);

		$logo->addChild($label);

		$holder = (new HtmlElement('div'))->addStyleClass('logo-description');
		$logo->addChild($holder);

		$holder->addChild( (new CMSElement('h2'))->addStyleClass('logo-headline')->content(Value::createExpression( ValueExpression::TYPE_MESSAGE,'logo_'.$this->name        )));
		$holder->addChild( (new CMSElement('p') )->addStyleClass('logo-text'    )->content(Value::createExpression( ValueExpression::TYPE_MESSAGE,'logo_'.$this->name.'_text')));

		return $logo;
	}

}
