<?php

namespace cms\update\version;

use database\DbVersion;
use database\Column;
use security\Password;

/**
 * Local settings for every object.
 *
 * @author dankert
 *
 */
class DBVersion000015 extends DbVersion
{
    /**
     *
     */
    public function update()
    {
    	$this->table('object')->column('settings')->type(Column::TYPE_TEXT)->size(0)->add();
   }
}

?>