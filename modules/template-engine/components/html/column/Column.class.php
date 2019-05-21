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
	    $styleClasses = array();
		echo '<'.($this->header?'th':'td');
		if	( ! empty($this->width))
			echo ' width="'.$this->htmlvalue($this->width).'"';
		if	( ! empty($this->style))
			echo ' style="'.$this->htmlvalue($this->style).'"';

		if	( ! empty($this->colspan))
			echo ' colspan="'.$this->htmlvalue($this->colspan).'"';
		if	( ! empty($this->rowspan))
			echo ' rowspan="'.$this->htmlvalue($this->rowspan).'"';
		if	( ! empty($this->rowspan))
			echo ' rowspan="'.$this->htmlvalue($this->rowspan).'"';
		if	( ! empty($this->title))
			echo ' title="'.$this->htmlvalue($this->title).'"';

        if	( ! empty($this->id))
        {
            echo ' data-name="'.$this->htmlvalue($this->name).'"';
            echo ' data-action="'.$this->htmlvalue($this->action).'"';
            echo ' data-id="'.$this->htmlvalue($this->id).'"';
            $styleClasses[] = 'clickable';
        }
        if	( ! empty($this->class))
            $styleClasses[] = $this->htmlvalue($this->class);

        if  ( sizeof($styleClasses) > 0)
            echo ' class="'.implode(' ',$styleClasses).'"';

        echo '>';
	}
	
	
	protected function end()
	{
		echo '</'.($this->header?'th':'td').'>';
	}
	
}


?>