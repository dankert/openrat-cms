<?php

class LabelComponent extends Component
{

	public $for;

	public $value;

	public $key;

	public $text;

	public function begin()
	{
		echo '<label';
		
		if (! empty($this->for))
		{
			
			echo ' for="<?php echo REQUEST_ID ?>_' . $this->htmlvalue($this->for);
			if (isset($this->value))
				echo '_' . $this->htmlvalue($this->value);
			echo '"';
		}
		
		echo ' class="label"';
		echo '>';
		
		if ( !empty($this->key))
			echo '<?php echo lang(' . $this->value($this->key) . ') ?>';
		
		if (isset($this->text))
			echo $this->htmlvalue($this->text);
	}

	public function end()
	{
		echo '</label>';
	}
}

?>