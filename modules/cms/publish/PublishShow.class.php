<?php

namespace cms\publish;

use cms\model\BaseObject;
use cms\model\Link;
use cms\model\Url;

/**
 * Created by PhpStorm.
 * User: dankert
 * Date: 10.08.18
 * Time: 23:47
 */

class PublishShow extends Publish
{
    /**
     * @param $from \cms\model\BaseObject
     * @param $to \cms\model\BaseObject
     */
    public function linkToObject( $from, $to )
    {
       return "...";
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
        return false;
    }
}