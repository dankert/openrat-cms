<?php
namespace cms\action\link;
use cms\action\LinkAction;
use cms\action\Method;
use cms\model\BaseObject;
use util\Html;


class LinkShowAction extends LinkAction implements Method {

    public function view() {
        header('Content-Type: text/html' );

        header('X-Link-Id: ' .$this->link->linkid );
        header('X-Id: '      .$this->link->objectid     );
        header('Content-Description: '.$this->link->filename() );

        echo '<html><body>';
        echo '<h1>'.$this->link->filename.'</h1>';
        echo '<hr />';

        try {
            $o = new BaseObject( $this->link->linkedObjectId );
            $o->load();
            echo '<a href="'.Html::url($o->getType(),'show',$o->objectid).'">'.$o->filename.'</a>';
        }
        catch( \util\exception\ObjectNotFoundException $e ) {
            echo '-';
        }

        echo '</body></html>';

        exit;
    }

    public function post() {
    }
}
