<?php
namespace cms\action\folder;
use cms\action\FolderAction;
use cms\action\Method;
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

        // Schleife ueber alle Objekte in diesem Ordner
        foreach( $this->folder->getObjects() as $o )
        {
            /* @var $o BaseObject */
            $id = $o->objectid;

            if   ( $o->hasRight(Permission::ACL_READ) )
            {
                echo '<li><a href="'. Html::url($o->getType(),'show',$id).'">'.$o->filename.'</a></li>';

                //echo date( \cms\base\Language::lang('DATE_FORMAT'),$o->lastchangeDate );
                //echo $o->lastchangeUser;
            }
        }

        echo '</ul>';
        echo '</body></html>';

        exit;
    }
    public function post() {
    }
}
