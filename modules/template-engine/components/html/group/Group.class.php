<?php

namespace template_engine\components;

use modules\template_engine\CMSElement;
use modules\template_engine\HtmlElement;

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
		$fieldset->addStyleClass('or-group');
		$fieldset->addStyleClass('toggle-open-close');

		if   ( $this->open )
			$fieldset->addStyleClass('open');
		else
			$fieldset->addStyleClass('closed');

		if   ( $this->show )
			$fieldset->addStyleClass('show' );

		if	( $this->title )
		{
			$legend = new HtmlElement('legend');
			$legend->addStyleClass('on-click-open-close');
			$legend->content( $this->title );

			$image = new CMSElement('img');
			if	( $this->icon )
				$image->addAttribute('src','themes/default/images/icon/method/'.$this->icon.'.svg" />');
			$legend->addChild( $image );

			$arrowRight = (new HtmlElement('div'))->addStyleClass('arrow')->addStyleClass('arrow-right')->addStyleClass('on-closed');
			$legend->addChild($arrowRight );

			$arrowDown  = (new HtmlElement('div'))->addStyleClass('arrow')->addStyleClass('arrow-down' )->addStyleClass('on-open'  );
			$legend->addChild($arrowDown  );

			$fieldset->addChild( $legend );
		}

		$group = new HtmlElement('div');
		$group->addStyleClass('closable')->addWrapper($fieldset);

		return $group;
	}

}