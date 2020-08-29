<?php

namespace cms\publish;

use cms\model\BaseObject;
use cms\model\Link;
use cms\model\Url;

/**
 * @author Jan Dankert
 */

class PublishEdit extends Publish
{
    /**
     * @param $from \cms\model\BaseObject
     * @param $to \cms\model\BaseObject
     */
    public function linkToObject( BaseObject $from, BaseObject $to )
    {
        return '->'.$to;
    }

    public function isPublic()
    {
        return false;
    }

    public function copy($tmp_filename,$dest_filename,$lastChangeDate=null)
    {
        // nothing to do.
    }

    public function clean()
    {
        // nothing to do.
    }

    public function close()
    {
        // nothing to do.
    }

    public function isSimplePreview()
    {
        return true;
    }

}