<?php
namespace cms\action\search;
use cms\action\Method;
use cms\action\SearchAction;

class SearchResultAction extends SearchAction implements Method {

    public function view() {

		$suchText    = $this->getRequestVar('text');
		$searchFlags = 0;
		
		if	( $this->hasRequestVar('id'         ) ) $searchFlags |= self::FLAG_ID;
		if	( $this->hasRequestVar('filename'   ) ) $searchFlags |= self::FLAG_FILENAME;
		if	( $this->hasRequestVar('name'       ) ) $searchFlags |= self::FLAG_NAME;
		if	( $this->hasRequestVar('description') ) $searchFlags |= self::FLAG_DESCRIPTION;
		if	( $this->hasRequestVar('content'    ) ) $searchFlags |= self::FLAG_VALUE;
			
		$this->performSearch($suchText, $searchFlags);

				/*
			case 'lastchange_user':
				$e = new Value();
				
				$language = Session::getProjectLanguage();
				$e->languageid = $language->languageid;
				
				$listObjectIds = $e->getObjectIdsByLastChangeUserId( $this->getRequestVar('userid') );
				break;
		}*/
    }

    public function post() {
    }
}
