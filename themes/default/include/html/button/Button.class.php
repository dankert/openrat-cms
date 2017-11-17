<?php

class ButtonComponent extends Component
{

	public $type;

	public $src;

	private $tmp_src;

	protected function begin()
	{
		echo <<<'HTML'
		<div class="invisible">
HTML;
		
		if ($this->type == 'ok')
			$this->type = 'submit';
		
		if (! empty($this->src))
		{
			$this->type = 'image';
			$this->tmp_src = $image_dir . 'icon_' . $this->src . IMG_ICON_EXT;
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
	title="<?php echo lang($this->text.'_DESC') ?>"
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