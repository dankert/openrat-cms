<?php

namespace template_engine\components;

class InsertComponent extends Component
{
	public $name= '';
	public $url;
	public $function;
	
	public function begin()
	{
		if	( !empty($this->function))
		{
			// JS-Function einbinden
			echo '<script type="text/javascript" name="JavaScript">'.$this->htmlvalue($this->function).'();</script>';
		}
		elseif	( !empty($this->url))
		{
			// IFrame
			echo '<iframe';
			if	( !empty($this->name))
				echo ' name="'.$this->htmlvalue($this->name).'"';
			if	( !empty($this->url))
				echo ' src="'.$this->htmlvalue($this->url).'"';
			echo '></iframe>';
		}
	}
	
	public function end()
	{
	}
}


?>