<?php

namespace template_engine\components;

class ColumnComponent extends Component
{
	public $width;
	public $style;
	public $class;
	public $colspan;
	public $rowspan;
	public $header = false;
	public $title;
	public $url;
	public $action;
	public $id;
	public $name;
	
	protected function begin()
	{
		echo '<td';
		if	( ! empty($this->width))
			echo ' width="'.$this->htmlvalue($this->width).'"';
		if	( ! empty($this->style))
			echo ' style="'.$this->htmlvalue($this->style).'"';
		if	( ! empty($this->class))
			echo ' class="'.$this->htmlvalue($this->class).'"';
		if	( ! empty($this->colspan))
			echo ' colspan="'.$this->htmlvalue($this->colspan).'"';
		if	( ! empty($this->rowspan))
			echo ' rowspan="'.$this->htmlvalue($this->rowspan).'"';
		if	( ! empty($this->rowspan))
			echo ' rowspan="'.$this->htmlvalue($this->rowspan).'"';
		if	( ! empty($this->title))
			echo ' title="'.$this->htmlvalue($this->title).'"';
		if	( ! empty($this->id))
			echo ' onclick="javascript:openNewAction('."'".$this->htmlvalue($this->name)."','".$this->htmlvalue($this->action)."','".$this->htmlvalue($this->id)."');".'"';
		echo '>';
	}
	
	
	protected function end()
	{
		echo '</td>';
	}
	
}


?>