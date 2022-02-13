<?php
namespace cms\action\url;
use cms\action\Method;
use cms\action\UrlAction;


class UrlShowAction extends UrlAction implements Method {


	public function view() {
        // Angabe Content-Type
        $this->addHeader('Content-Type','text/html' );

		$this->addHeader('X-Url-Id'           ,$this->url->urlid      );
		$this->addHeader('X-Id'               ,$this->url->objectid   );
		$this->addHeader('Content-Description',$this->url->filename() );

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
