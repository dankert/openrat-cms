<?php

namespace cms\generator\link;

use cms\action\RequestParams;
use cms\generator\BaseContext;
use cms\generator\PageContext;
use cms\model\Alias;
use cms\model\BaseObject;
use cms\model\Link;
use cms\model\Url;
use util\exception\GeneratorException;

/**
 * Created by PhpStorm.
 * User: dankert
 * Date: 10.08.18
 * Time: 23:47
 */

class PreviewLink implements LinkFormat
{
	private $context;

	/**
	 * PublicLink constructor.
	 * @param $context BaseContext
	 */
	public function __construct($context)
	{
		$this->context = $context;
	}


	/**
	 * Calculates the Preview Link to an object.
	 *
     * @param $from \cms\model\BaseObject this is the source object from which the links points to $to.
     * @param $to \cms\model\BaseObject the target where the link points to.
     */
    public function linkToObject( BaseObject $from, BaseObject $to )
    {

        $param = [
            'oid'                       => '__OID__'.$to->objectid.'__',
            RequestParams::PARAM_OUTPUT => 'preview',
		];

        if   ( $this->context instanceof PageContext ) {
			$param[ RequestParams::PARAM_MODEL_ID    ] = $this->context->modelId;
            $param[ RequestParams::PARAM_LANGUAGE_ID ] = $this->context->languageId;
		}

        switch( $to->typeid )
        {
            case BaseObject::TYPEID_FOLDER:
				$inhalt = \util\Html::url('folder','show',$to->objectid,$param);
				break;
            case BaseObject::TYPEID_FILE:
            case BaseObject::TYPEID_IMAGE:
            case BaseObject::TYPEID_TEXT:
                $inhalt = \util\Html::url('file','show',$to->objectid,$param);
                break;
            case BaseObject::TYPEID_PAGE:
                $inhalt = \util\Html::url('page','show',$to->objectid,$param);
                break;

            case BaseObject::TYPEID_LINK:
                $link = new Link( $to->objectid );
                $link->load();

                $linkedObject = new BaseObject( $link->linkedObjectId );
                $linkedObject->objectLoad();

                switch( $linkedObject->typeid )
                {
                    case BaseObject::TYPEID_FILE:
                        $inhalt = \util\Html::url('file','show',$link->linkedObjectId,$param);
                        break;

                    case BaseObject::TYPEID_PAGE:
                        $inhalt = \util\Html::url('page','show',$link->linkedObjectId,$param);
                        break;
                    case BaseObject::TYPEID_URL:
                        $inhalt = \util\Html::url('url','show',$link->linkedObjectId,$param);
                        break;
					default:
						$inhalt = 'Unknown link type: '.$linkedObject->typeid;
                }
                break;

            case BaseObject::TYPEID_ALIAS:
                $alias = new Alias( $to->objectid );
				$alias->load();
                $alias->linkedObjectId;

                $linkedObject = new BaseObject( $alias->linkedObjectId );
                $linkedObject->objectLoad();

                switch( $linkedObject->typeid )
                {
                    case BaseObject::TYPEID_FILE:
                        $inhalt = \util\Html::url('file','show',$alias->linkedObjectId,$param);
                        break;

                    case BaseObject::TYPEID_PAGE:
                        $inhalt = \util\Html::url('page','show',$alias->linkedObjectId,$param);
                        break;
					default:
						$inhalt = 'Unknown link type: '.$linkedObject->typeid;
                }
                break;

            case BaseObject::TYPEID_URL:
                $url = new Url( $to->objectid );
                $url->load();
                $inhalt = $url->url;

                break;
			default:
				throw new GeneratorException('Unknown type '.$to->typeid.' in target '.$to->__toString() );

		}

        return $inhalt;

    }

}
