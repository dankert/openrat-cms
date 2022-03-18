<?php
namespace cms\action\link;
use cms\action\LinkAction;
use cms\action\Method;
use cms\model\BaseObject;
use util\Html;


class LinkShowAction extends LinkAction implements Method {

    public function view() {
        $this->setContentType('text/html' );


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
