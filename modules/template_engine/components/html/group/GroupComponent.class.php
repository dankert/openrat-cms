<?php

namespace template_engine\components;

use template_engine\components\html\Component;
use template_engine\element\CMSElement;
use template_engine\element\HtmlElement;

/**
 * A group.
 */
class GroupComponent extends Component
{

	public $open = true;
	public $show = true;
	public $title;
	public $icon;
	
	public function createElement()
	{
		$fieldset = new HtmlElement('fieldset');
		$fieldset->addStyleClass('group')->addStyleClass('toggle-open-close');

		if   ( $this->open )
			$fieldset->addStyleClass('-is-open');
		else
			$fieldset->addStyleClass('-is-closed');

		if   ( $this->show )
			$fieldset->addStyleClass('show' );

		if	( $this->title )
		{
			$legend = new HtmlElement('legend');
			$legend->addStyleClass('act-open-close');
			$legend->content( $this->title );

			$image = new CMSElement('img');
			if	( $this->icon )
				$image->addAttribute('src','themes/default/images/icon/method/'.$this->icon.'.svg" />');
			$legend->addChild( $image );

			$arrowRight = (new HtmlElement('i'))->addStyleClass(['image-icon','image-icon--node-closed','group--on-closed']);
			$legend->addChild($arrowRight );

			$arrowDown  = (new HtmlElement('i'))->addStyleClass(['image-icon','image-icon--node-open','group--on-open']);
			$legend->addChild($arrowDown  );

			$fieldset->addChild( $legend );
		}

		$group = new HtmlElement('div');
		$group->addStyleClass('closable')->asChildOf($fieldset);

		$this->adoptiveElement = $group;

		return $fieldset;
	}

}