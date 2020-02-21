<?php

namespace template_engine\components;

use modules\template_engine\CMSElement;
use modules\template_engine\HtmlElement;
use modules\template_engine\Value;
use modules\template_engine\ValueExpression;

class TableComponent extends HtmlComponent
{
    public $filter = true;

	public $width = '100%';


	public function createElement()
	{
	    $tableWrapper = (new HtmlElement('div'))->addStyleClass('or-table-wrapper');

	    if   ( $this->filter)
		{
			$filterInput = (new CMSElement('input'))->addAttribute('type','search')->addAttribute('name','filter')->addAttribute('placeholder',Value::createExpression(ValueExpression::TYPE_MESSAGE,'SEARCH_FILTER'));
			$filter = (new HtmlElement('div'))->addStyleClass('or-table-filter')->addChild( $filterInput );
			$tableWrapper->addChild($filter);
		}

		$tableContent = (new HtmlElement('div'))->addStyleClass('or-table-area');

        $table = new CMSElement('table');

		$tableWrapper->addChild( $tableContent->addChild( $table) );

		if	( $this->class)
            $table->addStyleClass($this->class);

        if	( $this->width)
            $table->addAttribute('width',$this->width);

        $this->adoptiveElement = $table;

        return $tableWrapper;
    }
}