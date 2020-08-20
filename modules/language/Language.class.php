<?php

namespace language;

use logger\Logger;

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

		$langFile = $this->getOutputLanguageFile($iso);
		require($langFile); // Contains the function 'language()'
		return language();
    }


    /**
     * Returns the native php language file for the selected iso code.
     * @param $iso string ISO-Code
     * @return string filename
     */
    private function getOutputLanguageFile($iso)
    {
    	$fallback = 'en';
    	$isos = [ $iso ,$fallback ]; // Using a fallback

		foreach( $isos as $l ) {
			$langFile = __DIR__ . '/lang-' . $l . '.php';

			// Is language file available?
			if ( file_exists($langFile) )
				return $langFile;
		}

        throw new \DomainException('No language file found for iso keys: '.Logger::sanitizeInput(implode(',',$isos)));
    }

}