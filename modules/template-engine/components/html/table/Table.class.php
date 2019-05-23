<?php

namespace template_engine\components;

class TableComponent extends HtmlComponent
{
    public $filter = true;

	public $width = '100%';
	
	public function begin()
	{
	    echo '<div class="or-table-wrapper">';

	    if   ( $this->filter)
            echo '<div class="or-table-filter"><input type="search" name="filter" placeholder="'.$this->htmlvalue('message:SEARCH_FILTER').'" /></div>';

        echo '<div class="or-table-area">';
        echo '<table';

        if	( !empty($this->class))
            echo ' class="'.$this->htmlvalue($this->class).'"';

        if	( !empty($this->width))
            echo ' width="'.$this->htmlvalue($this->width).'"';

        echo '>';
    }

	public function end()
	{
		echo '</table>';
        echo '</div>';
        echo '</div>';
	}
}

?>