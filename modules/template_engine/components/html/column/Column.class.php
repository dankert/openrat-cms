<?php

namespace template_engine\components;

use template_engine\components\html\Component;
use template_engine\element\CMSElement;

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

	public function createElement()
	{
		$column = new CMSElement( ($this->header?'th':'td') );

		if	( $this->width )
			$column->addAttribute('width',$this->width);

		if	( $this->style )
			$column->addAttribute('style',$this->style);

		if	( $this->colspan )
			$column->addAttribute('colspan',$this->colspan);

		if	( $this->rowspan )
			$column->addAttribute('rowspan',$this->rowspan);

		if	( $this->rowspan )
			$column->addAttribute('rowspan',$this->rowspan);
		if	( $this->title )
			$column->addAttribute('title',$this->title);

        if	( $this->id )
        {
			$column->addAttribute('data-name'  ,$this->name  );
			$column->addAttribute('data-action',$this->action);
			$column->addAttribute('data-id'    ,$this->id    );
			$column->addStyleClass('clickable');
        }
        if	( $this->class )
			$column->addStyleClass( $this->class );

        return $column;
	}
}