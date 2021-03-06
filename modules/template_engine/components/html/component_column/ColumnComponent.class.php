<?php

namespace template_engine\components\html\component_column;

use template_engine\components\html\Component;
use template_engine\element\CMSElement;

class ColumnComponent extends Component
{
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
        }
        if	( $this->class )
			$column->addStyleClass( Component::splitByComma($this->class) );

        return $column;
	}
}