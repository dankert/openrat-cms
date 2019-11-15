<?php

namespace language;

use LogicException;
use YAML;

class Language
{
    private $srcFile;

    public function __construct()
    {
        $this->srcFile = __DIR__ . '/language.yml';
    }

    /**
     * @param $iso ISO-Code
     * @param bool $production Are we in a production environment?
     * @return array The language values
     */
    public function getLanguage($iso, $production = true)
    {
        if ( !$production) {
            $this->compileLanguage($iso);
        }

        return $this->getLanguageProduction($iso);
    }

    /**
     * Compiles language YAML source to native language php files.
     * Only, if the YAML source file has changed.
     * @param $iso ISO-code
     */
    private function compileLanguage($iso)
    {
        if  ( filemtime($this->srcFile) > filemtime( $this->getOutputLanguageFile('en')) )
        {
            // source file newer than production file => compile.
            $this->updateProduction();
        }
    }

    /**
     * @param $iso ISO-language-code
     * @return array
     */
    private function getLanguageProduction($iso)
    {

        $langFile = $this->getOutputLanguageFile($iso,'en');
        require($langFile); // Contains the function 'language()'
        return language();
    }


    private function getLanguageSource()
    {
        return YAML::parse( file_get_contents($this->srcFile) );
    }


    /**
     * Creates the production environment.
     */
    public function updateProduction()
    {
        $lang = $this->getLanguageSource();

        // creating a list of alle language iso codes.
        $isoList = array();
        foreach ($lang as $key => $values)
        {
            foreach ($values as $isocode => $value)
            {
                if ( !in_array($isocode, $isoList) )
                    $isoList[] = $isocode;
            }

        }

        foreach ($isoList as $iso) {
            $outputFilename = $this->getOutputLanguageFile($iso);

            $success = file_put_contents($outputFilename, "<?php /* DO NOT CHANGE THIS GENERATED FILE */\n");

            if ($success)
                ;
            else
                throw new LogicException("File is not writable: '$outputFilename'\n");

            file_put_contents($outputFilename, "function language() { return array(\n", FILE_APPEND);
            foreach ($lang as $key => $value) {
                if (isset($value[$iso]))
                    $t = $value[$iso];
                elseif (isset($value['en']))
                    $t = $value['en']; // Fallback to english
                else
                    $t = $key;
                $t = str_replace('"', '\"', $t); // escaping
                file_put_contents($outputFilename, "'$key'=>\"$t\",\n", FILE_APPEND);
            }
            file_put_contents($outputFilename, ");}", FILE_APPEND);

        }
    }


    /**
     * Returns the native php language file for the selected iso code.
     * @param $iso string ISO-Code
     * @param null string $fallbackiso Fallback to this ISO-Code, if the file does not exist.
     * @return string filename
     */
    private function getOutputLanguageFile($iso, $fallbackiso = null )
    {
        $langFile = __DIR__ . '/lang-' . $iso . '.php';

        // Is language available?
        if ( !empty($fallbackiso) && !file_exists($langFile))
            // Fallback to english
            $langFile = __DIR__ . '/lang-'.$fallbackiso.'.php';

        return $langFile;
    }

}

?>