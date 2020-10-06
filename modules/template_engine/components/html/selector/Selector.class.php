<?php

namespace template_engine\components;

use template_engine\components\html\Component;
use template_engine\element\CMSElement;
use template_engine\element\HtmlElement;
use template_engine\element\Value;
use template_engine\element\ValueExpression;

class SelectorComponent extends Component
{

	public $types;

	public $name;

	public $id;

	public $folderid;

	public $param;

	public function createElement()
	{
		return (new HtmlElement('div'))->addStyleClass('selector')->addChild(
			(new HtmlElement('input'))->addAttribute('type','hidden')->addStyleClass('or-selector-link-value')->addAttribute('name',$this->param)->addAttribute('value',Value::createExpression(ValueExpression::TYPE_DATA_VAR,$this->param))
		)->addChild(
			(new HtmlElement('input'))->addAttribute('type','text')->addStyleClass('or-selector-link-name')->addAttribute('name',$this->param.'_text')->addAttribute('placeholder',$this->name)->addAttribute('value',$this->name)
		)->addChild(
			(new HtmlElement('div'))->addStyleClass('dropdown')->addStyleClass('or-act-selector-search-results')
		)->addChild(
			(new HtmlElement('div'))->addAttribute('type','hidden')->addStyleClass('or-navtree or-act-load-selector-tree')->addAttribute('data-types',$this->types)->addAttribute('data-init-id',$this->id)->addAttribute('data-init-folderid',$this->folderid)
		);
	}

}