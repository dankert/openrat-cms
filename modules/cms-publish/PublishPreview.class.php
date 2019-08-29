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

class PublishPreview extends Publish
{
    /**
     * @param $from \cms\model\BaseObject
     * @param $to \cms\model\BaseObject
     */
    public function linkToObject( $from, $to )
    {

        $param = array(
            'oid'                 => '__OID__'.$to->objectid.'__',
            REQ_PARAM_MODEL_ID    => $from->modelid          ,
            REQ_PARAM_LANGUAGE_ID => $from->languageid         );

        if	( $from->icons )
            $param['withIcons'] = '1';


        // Interne Verlinkungen in der Seitenvorschau
        switch( $to->typeid )
        {
            case BaseObject::TYPEID_FILE:
            case BaseObject::TYPEID_IMAGE:
            case BaseObject::TYPEID_TEXT:
                $inhalt = \Html::url('file','show',$to->objectid,$param);
                break;
            case BaseObject::TYPEID_PAGE:
                $inhalt = \Html::url('page','show',$to->objectid,$param);
                break;

            case BaseObject::TYPEID_LINK:
                $link = new Link( $to->objectid );
                $link->load();

                $linkedObject = new BaseObject( $link->linkedObjectId );
                $linkedObject->objectLoad();

                switch( $linkedObject->typeid )
                {
                    case BaseObject::TYPEID_FILE:
                        $inhalt = \Html::url('file','show',$link->linkedObjectId,$param);
                        break;

                    case BaseObject::TYPEID_PAGE:
                        $inhalt = \Html::url('page','show',$link->linkedObjectId,$param);
                        break;
                    case BaseObject::TYPEID_URL:
                        $inhalt = \Html::url('url','show',$link->linkedObjectId,$param);
                        break;
                }
                break;

            case BaseObject::TYPEID_URL:
                $url = new Url( $to->objectid );
                $url->load();
                $inhalt = $url->url;

                break;
        }

        return $inhalt;

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
