<?php

namespace language;

use LogicException;
use Spyc;

class Language
{
    private static $srcFile = __DIR__ . '/language.yml';

    /**
     * @param $iso ISO-Code
     * @param bool $production Are we in a production environment?
     * @return array The language values
     */
    public static function getLanguage($iso, $production = true)
    {
        if ( !$production) {
            self::compileLanguage($iso);
        }

        return self::getLanguageProduction($iso);
    }

    /**
     * Compiles language YAML source to native language php files.
     * Only, if the YAML source file has changed.
     * @param $iso ISO-code
     */
    private static function compileLanguage($iso)
    {
        if  ( filemtime(self::$srcFile) > filemtime( self::getOutputLanguageFile('en')) )
        {
            // source file newer than production file => compile.
            self::updateProduction();
        }
    }

    /**
     * @param $iso ISO-language-code
     * @return array
     */
    private static function getLanguageProduction($iso)
    {

        $langFile = self::getOutputLanguageFile($iso,'en');
        require($langFile); // Contains the function 'language()'
        return language();
    }


    private static function getLanguageSource()
    {
        return Spyc::YAMLLoad( self::$srcFile);
    }


    /**
     * Creates the production environment.
     */
    public static function updateProduction()
    {
        $lang = self::getLanguageSource();

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
            $outputFilename = self::getOutputLanguageFile($iso);

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
    private static function getOutputLanguageFile($iso, $fallbackiso = null )
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