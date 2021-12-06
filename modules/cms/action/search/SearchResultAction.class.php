<?php
namespace cms\action\search;
use cms\action\Method;
use cms\action\SearchAction;

class SearchResultAction extends SearchAction implements Method {

    public function view() {


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
