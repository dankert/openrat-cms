<?php
namespace cms\action\search;
use cms\action\Method;
use cms\action\SearchAction;

class SearchResultAction extends SearchAction implements Method {

    public function view() {

		$suchText    = $this->request->getText('text');
		$searchFlags = 0;
		
		if	( $this->request->has('id'         ) ) $searchFlags |= self::FLAG_ID;
		if	( $this->request->has('filename'   ) ) $searchFlags |= self::FLAG_FILENAME;
		if	( $this->request->has('name'       ) ) $searchFlags |= self::FLAG_NAME;
		if	( $this->request->has('description') ) $searchFlags |= self::FLAG_DESCRIPTION;
		if	( $this->request->has('content'    ) ) $searchFlags |= self::FLAG_VALUE;
			
		$this->performSearch($suchText, $searchFlags);

				/*
			case 'lastchange_user':
				$e = new Value();
				
				$language = Session::getProjectLanguage();
				$e->languageid = $language->languageid;
				
				$listObjectIds = $e->getObjectIdsByLastChangeUserId( $this->request->getRequestVar('userid') );
				break;
		}*/
    }

    public function post() {
    }
}
