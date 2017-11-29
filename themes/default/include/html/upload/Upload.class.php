<?php

class UploadComponent extends Component
{
	public $size = 40;
	public $name;
	public $multiple = false;
	public $class = 'upload';
	public $maxlength = '';

	public function begin()
	{
		$class = $this->htmlvalue($this->class);
		$name = $this->htmlvalue($this->name);
		$size = $this->htmlvalue($this->size);
		$request_id = REQUEST_ID;
		
		if	( !empty($this->maxlength))
			$maxlength = ' maxlength="'.$this->htmlvalue($this->maxlength).'"';
		else
			$maxlength = '';
		
		if	( $this->multiple )
			$multiple = ' multiple="multiple"';
		else
			$multiple = '';
		
		echo <<<HTML
<input size="$size" id="{$request_id}_{$name}" type="file"$maxlength name="$name" class="$class" $multiple />
HTML;
	}
}


?>