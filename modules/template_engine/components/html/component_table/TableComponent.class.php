<?php

namespace template_engine\components\html\component_table;

use template_engine\components\html\HtmlComponent;
use template_engine\element\CMSElement;
use template_engine\element\HtmlElement;
use template_engine\element\Value;
use template_engine\element\ValueExpression;

class TableComponent extends HtmlComponent
{
    public $filter = true;

	public $width = '100%';


	public function createElement()
	{
	    $tableWrapper = (new HtmlElement('div'))->addStyleClass('table-wrapper');

	    if   ( $this->filter)
		{
			$filterInput = (new CMSElement('input'))->addStyleClass(['input','table-filter-input'])->addAttribute('type','search')->addAttribute('name','filter')->addAttribute('placeholder',Value::createExpression(ValueExpression::TYPE_MESSAGE,'SEARCH_FILTER'));
			$filter = (new HtmlElement('div'))->addStyleClass('table-filter')->addChild( $filterInput );
			$tableWrapper->addChild($filter);
		}

		$tableContent = (new HtmlElement('div'))->addStyleClass('table-area');

        $table = (new CMSElement('table'))->addStyleClass('table');

		$tableWrapper->addChild( $tableContent->addChild( $table) );

		if	( $this->class)
            $table->addStyleClass($this->class);

        if	( $this->width)
            $table->addAttribute('width',$this->width);

        $this->adoptiveElement = $table;

        return $tableWrapper;
    }
}