<?php

namespace template_engine\components;

use modules\template_engine\PHPBlockElement;
use modules\template_engine\Value;
use modules\template_engine\ValueExpression;

class RadioboxComponent extends Component
{

	public $list;

	public $name;

	public $default;

	public $onchange;

	public $title;

	public $class;


	public function createElement()
	{
		$radiobox = new PHPBlockElement();

		$radiobox->beforeBlock = $radiobox->includeResource( 'radiobox/component-radio-box.php');
		
		if	( $this->default )
			$value = $this->default;
		else
			$value = Value::createExpression(ValueExpression::TYPE_DATA_VAR,$this->name);
					
		$radiobox->inBlock = '<?php component_radio_box('.$this->name.',$'.$this->list.','.$value.') ?>';

		return $radiobox;
	}
}

?>