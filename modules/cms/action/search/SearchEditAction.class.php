<?php
namespace cms\action\search;
use cms\action\Method;
use cms\action\SearchAction;
use cms\base\Configuration;
use cms\model\User;
use util\Session;

class SearchEditAction extends SearchAction implements Method {

    public function view() {

		$searchConfig = Configuration::subset('search')->subset('quicksearch');
		$flag = $searchConfig->subset('flag');

		$initial = ! $this->request->isTrue('repeat');

		if   ( $initial ) {
			$searchById       = $flag->is('id'         );
			$searchByName     = $flag->is('name'       );
			$searchByFilename = $flag->is('filename'   );
			$searchByDesc     = $flag->is('description');
			$searchByContent  = $flag->is('content'    );
		} else {
			$searchById       = $this->request->isTrue('oid'        );
			$searchByName     = $this->request->isTrue('name'       );
			$searchByFilename = $this->request->isTrue('filename'   );
			$searchByDesc     = $this->request->isTrue('description');
			$searchByContent  = $this->request->isTrue('content'    );
		}

		$this->setTemplateVar('oid'        ,$searchById       );
		$this->setTemplateVar('name'       ,$searchByName     );
		$this->setTemplateVar('filename'   ,$searchByFilename );
		$this->setTemplateVar('description',$searchByDesc     );
		$this->setTemplateVar('content'    ,$searchByContent  );

		$suchText    = $this->request->getText('text');
		$this->setTemplateVar('text',$suchText);

		$searchFlags = 0;

		// Always search for the id without a max length
		if   ( strlen($suchText) >= $searchConfig->get('maxlength',3 ) ) {
			if ($searchById      ) $searchFlags |= self::FLAG_ID;
			if ($searchByFilename) $searchFlags |= self::FLAG_FILENAME;
			if ($searchByName    ) $searchFlags |= self::FLAG_NAME;
			if ($searchByDesc    ) $searchFlags |= self::FLAG_DESCRIPTION;
			if ($searchByContent ) $searchFlags |= self::FLAG_VALUE;

		}

		$this->performSearch($suchText, $searchFlags);
	}


    public function post() {
    }
}
