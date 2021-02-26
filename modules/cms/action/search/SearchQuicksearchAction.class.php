<?php
namespace cms\action\search;
use cms\action\Method;
use cms\action\SearchAction;
use cms\base\Configuration;

class SearchQuicksearchAction extends SearchAction implements Method {
    public function view() {
		$searchConfig = Configuration::subset('search')->subset('quicksearch');

		$text = $this->request->getText('search');
		
		$flag = $searchConfig->subset('flag');

		$searchFlags = 0;

		// Always search for the id without a max length
		if	( $flag->is('id'         ) ) $searchFlags |= self::FLAG_ID;

		if   ( strlen($text) >= $searchConfig->get('maxlength',3 ) ) {

			if	( $flag->is('name'       ) ) $searchFlags |= self::FLAG_NAME;
			if	( $flag->is('filename'   ) ) $searchFlags |= self::FLAG_FILENAME;
			if	( $flag->is('description') ) $searchFlags |= self::FLAG_DESCRIPTION;
			if	( $flag->is('content'    ) ) $searchFlags |= self::FLAG_VALUE;
		}

		$this->performSearch($text, $searchFlags);
    }


    public function post() {
    }
}
