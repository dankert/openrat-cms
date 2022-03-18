<?php
namespace cms\action\folder;
use cms\action\FolderAction;
use cms\action\Method;
use cms\generator\FileContext;
use cms\generator\FileGenerator;
use cms\generator\PageContext;
use cms\generator\PageGenerator;
use cms\generator\Producer;
use cms\model\Element;
use cms\model\Folder;
use cms\model\Permission;
use cms\model\BaseObject;
use util\Html;


class FolderShowAction extends FolderAction implements Method {
    public function view() {

        // Angabe Content-Type
        $this->addHeader('Content-Type','text/html' );

        $this->addHeader('X-Folder-Id'        ,$this->folder->folderid   );
        $this->addHeader('X-Id'               ,$this->folder->objectid   );
        $this->addHeader('Content-Description',$this->folder->filename() );

        echo '<html><body>';
        echo '<h1>'.$this->folder->filename.'</h1>';
        echo '<ul>';


		if   ( $this->folder->parentid ) {
			echo '<li><a href="'. Html::url('folder','show',$this->folder->parentid).'">..</a></li>';
		}


		// Schleife ueber alle Objekte in diesem Ordner
        foreach( $this->folder->getObjects() as $o )
        {
            /* @var $o BaseObject */
            $id = $o->objectid;
			$o->load();

			if   ( $o->hasRight(Permission::ACL_READ) )
            {
				switch( $o->typeid ) {
					case BaseObject::TYPEID_PAGE:
						foreach( $this->folder->getProject()->getModelIds() as $modelId ) {
							foreach( $this->folder->getProject()->getLanguageIds() as $languageId ) {
								$previewContext = new PageContext( $o->objectid, Producer::SCHEME_PREVIEW );
								$previewContext->languageId = $languageId;
								$previewContext->modelId    = $modelId;
								$context = new PageContext( $o->objectid, Producer::SCHEME_PUBLIC );
								$context->languageId = $languageId;
								$context->modelId    = $modelId;
								$generator = new PageGenerator( $context );
								echo '<li><a href="'. $previewContext->getLinkScheme()->linkToObject($o,$o).'">'.basename($generator->getPublicFilename()).'</a></li>';
							}
						}
						break;
					default:
						echo '<li><a href="'. Html::url($o->getType(),'show',$o->objectid).'">'.$o->filename().'</a></li>';
				}

                //echo date( \cms\base\Language::lang('DATE_FORMAT'),$o->lastchangeDate );
                //echo $o->lastchangeUser;
            } else {
				// do not show anything.
				// the existence of the unreadable ojbect should be not visible.
			}
        }

        echo '</ul>';
        echo '</body></html>';

        exit;
    }
    public function post() {
    }
}
