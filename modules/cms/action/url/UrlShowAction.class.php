<?php
namespace cms\action\url;
use cms\action\Method;
use cms\action\UrlAction;


class UrlShowAction extends UrlAction implements Method {


	public function view() {
        // Angabe Content-Type
        $this->setContentType('text/html' );

        echo '<html><body>';
        echo '<h1>'.$this->url->filename.'</h1>';
        echo '<hr />';
        echo '<a href="'.$this->url->url.'">'.$this->url->url.'</a>';
        echo '</body></html>';

        exit;

    }


    public function post() {
    }
}
