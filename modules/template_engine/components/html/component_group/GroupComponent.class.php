<?php

namespace template_engine\components\html\component_group;

use template_engine\components\html\Component;
use template_engine\element\CMSElement;
use template_engine\element\HtmlElement;
use template_engine\element\Value;
use template_engine\element\ValueExpression;

/**
 * A group.
 */
class GroupComponent extends Component
{

	public $open = true;
	public $show = true;
	public $collapsible = true;
	public $title;
	public $description;
	public $icon;
	
	public function createElement()
	{
		$group = (new HtmlElement('section'))->addStyleClass('group');

		if  ( $this->collapsible )
			$group->addStyleClass('collapsible');

		$headline = (new HtmlElement('h2'))
			->addStyleClass('collapsible-title')
			->addStyleClass('group-title')
			->addStyleClass('collapsible-act-switch')
			->asChildOf( $group );

		if   ( $this->open || !$this->collapsible )
			$group->addStyleClass(['collapsible--is-open','collapsible--is-visible']);

		if   ( $this->show )
			$group->addStyleClass('collapsible--show' );

		if	( $this->title )
		{

			if   ( $this->collapsible ) {

				$arrowRight = (new HtmlElement('i'))->addStyleClass(['image-icon','image-icon--node-closed','collapsible--on-closed']);
				$headline->addChild($arrowRight );

				$arrowDown  = (new HtmlElement('i'))->addStyleClass(['image-icon','image-icon--node-open','collapsible--on-open']);
				$headline->addChild($arrowDown  );
			}

			if	( $this->icon ) {

				$image = new CMSElement('i');
				$image->addStyleClass(['image-icon','image-icon--'.$this->icon]);
				$headline->addChild( $image );
			}
			else {

				$image = new CMSElement('i');
				$image->addStyleClass(['image-icon','image-icon--empty']);
				$headline->addChild( $image );
			}

			(new HtmlElement('span'))->content( $this->title )->asChildOf($headline);
		}

		if   ( $this->description )
			(new HtmlElement('p'))
				->addStyleClass(['group-description','collapsible-value'])
				->content( $this->description )
				->asChildOf($group);

		$value = (new HtmlElement('div'))
			->addStyleClass(['collapsible-value','group-value'])
			->asChildOf($group);

		$this->adoptiveElement = $value;

		return $group;
	}

}