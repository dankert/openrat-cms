<?php

namespace template_engine\components;

class InputComponent extends Component
{

	public $class = 'text';

	public $default;

	public $type = 'text';

	public $index;

	public $name;

	public $prefix;

	public $value;

	public $size;

	public $maxlength = 256;

	public $onchange;

	public $readonly = false;

	public $hint;

	public $icon;

	public function begin()
	{
		if(!$this->type == 'hidden')
		{
			// Verstecktes Feld.
			$this->outputHiddenField();
		}
		else 
		{
			echo '<div class="inputholder">';
			echo '<input';
			if(isset($this->readonly))
				echo '<?php if ('.$this->value($this->readonly).') '."echo ' disabled=\"true\"' ?>";
			if (isset($this->hint))
				echo ' data-hint="'.$this->htmlvalue($this->hint).'"';
			
			echo ' id="'.'<?php echo REQUEST_ID ?>_'.$this->htmlvalue($this->name).'"';
			
			// Attribute name="..."
			echo ' name="';
			echo $this->htmlvalue($this->name);
			if(isset($this->readonly))
				echo '<?php if ('.$this->value($this->readonly).') '."echo '_disabled' ?>";
			echo '"';
			
			echo ' type="'.$this->htmlvalue($this->type).'"';
			echo ' maxlength="'.$this->htmlvalue($this->maxlength).'"';
			echo ' class="'.$this->htmlvalue($this->class).'"';
			
			echo ' value="<?php echo Text::encodeHtml(';
			if (isset($this->default))
				echo $this->value($this->default);
			else
				echo '@$'.$this->varname($this->name);
			echo ') ?>"';
			
			echo ' />';

			if(isset($this->readonly))
			{
				
				echo '<?php if ('.$this->value($this->readonly).') { ?>';
				$this->outputHiddenField();
				echo '<?php } ?>';
			}
				
				
			if(isset($this->icon))
				echo '<img src="'.OR_THEMES_DIR.'default/images/icon_'.$this->htmlvalue($this->icon). IMG_ICON_EXT .'" width="16" height="16" />';
			
			echo '</div>';
			
		}
	}
	
	private function outputHiddenField()
	{
		echo '<input';
		echo ' type="hidden"';
		echo ' name="'.$this->htmlvalue($this->name).'"';
		
		echo ' value="<?php ';
		
		if(isset($this->default))
			echo $this->value($this->default);
		else
			echo '$'.$this->varname($this->name);
		
		echo ' ?>"';
		echo '/>';
				
	}
}

?>