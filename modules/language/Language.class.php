<?php

namespace language;

use DomainException;
use logger\Logger;
use util\text\TextMessage;

class Language
{
    public function __construct()
    {
    }

    /**
     * @param $iso ISO-Code
     * @return array The language values
     */
    public function getLanguage($iso)
    {
		$language = $this->getOutputLanguage($iso);
		return $language->get();
    }


    /**
     * Returns an instance of the language class.
     * @param $iso string ISO-Code
     * @return object instance of language
     */
    private function getOutputLanguage($iso)
    {
    	$fallback = 'en';
    	$isos = [ $iso ,$fallback ]; // Using a fallback

		foreach( $isos as $l ) {

			$languageClazz = __NAMESPACE__.'\Language_'.strtoupper($iso);

			// Is language file available?
			if ( class_exists($languageClazz) )
				return new $languageClazz();
		}

        throw new DomainException( TextMessage::create('No language class found for iso keys ${0}',[implode(',',$isos)]) );
    }

}