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


	/**
	 * Creates all elements for a fieldset.
	 *
	 * @return CMSElement
	 */
	public function createElement()
	{
		$fieldset = (new CMSElement('fieldset'))->addStyleClass('fieldset');

		$label = (new HtmlElement('legend'))->addStyleClass('fieldset-label')->asChildOf($fieldset);

		if   ( $this->label )
			$label->content( Value::createExpression(ValueExpression::TYPE_MESSAGE,$this->label) );

		$value = (new HtmlElement('div'))->addStyleClass('fieldset-value')->asChildOf($fieldset);

		$this->adoptiveElement = $value;

		return $fieldset;
	}
}