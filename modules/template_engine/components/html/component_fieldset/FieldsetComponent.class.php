<?php

namespace template_engine\components\html\component_fieldset;

use template_engine\components\html\Component;
use template_engine\element\CMSElement;
use template_engine\element\HtmlElement;
use template_engine\element\Value;
use template_engine\element\ValueExpression;


/**
 * A fieldset contains a label (rendered as a 'legend') and a value.
 * The value contains all elements of the subcomponents.
 *
 * @author Jan Dankert
 */
class FieldsetComponent extends Component
{
	public $label;
	public $qrcode;

	/**
	 * Creates all elements for a fieldset.
	 *
	 * @return CMSElement
	 */
	public function createElement()
	{
		$fieldset = (new CMSElement('section'))->addStyleClass('fieldset');

		// it is not possible to use 'legend' here, because 'legend' cannot be a flex element (in FF 80).
		// A headline should semanically correct.
		$label = (new HtmlElement('h3'))->addStyleClass('fieldset-label')->asChildOf($fieldset);

		if   ( $this->label )
			$label->content( $this->label );

		$value = (new HtmlElement('div'))->addStyleClass('fieldset-value')->asChildOf($fieldset);

		$this->adoptiveElement = $value;
/*
		$action = (new HtmlElement('div'))->addStyleClass('fieldset-action')->asChildOf($fieldset);
		$action->addChild(
			(new CMSElement('i'))
				->addStyleClass('image-icon')
				->addStyleClass('image-icon--menu-qrcode')
				->addStyleClass('qrcode')
				->addStyleClass('info')
				->addAttribute('data-qrcode', $this->qrcode)
				->addAttribute('title', Value::createExpression(ValueExpression::TYPE_MESSAGE, 'QRCODE_SHOW'))
		);
*/
		return $fieldset;
	}
}