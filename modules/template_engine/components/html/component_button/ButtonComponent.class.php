<?php

namespace template_engine\components\html\component_button;

use cms\base\Startup;
use template_engine\components\html\Component;
use template_engine\element\Element;

/* @DEPRECATED */
class ButtonComponent extends Component
{

	public $type = 'submit';
	public $class = 'ok';
	public $src;
	public $text = 'button_ok';
	public $value = 'ok';
	
	private $tmp_src;

	public function createElement()
	{
		return new Element(null);
	}

	protected function unused_begin()
	{
		echo <<<'HTML'
		<div class="invisible">
HTML;
		
		if ($this->type == 'ok')
			$this->type = 'submit';
		
		if (! empty($this->src))
		{
			$this->type = 'image';
			$this->tmp_src = $image_dir . 'icon_' . $this->src . Startup::IMG_ICON_EXT;
		}
		else
		{
			$this->tmp_src = '';
		}
		
		if (! empty($this->type))
		{
			?>
<input type="<?php echo $this->type ?>" <?php if(isset($this->src)) { ?>
	src="<?php $this->tmp_src ?>" <?php } ?>
	name="<?php echo $this->value ?>" class="%class%"
	title="<?php echo \cms\base\Language::lang($this->text.'_DESC') ?>"
	value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($this->text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($this->src); ?>
	<?php
		
}
	}

	protected function end()
	{
		echo "</div>";
	}
}

?>