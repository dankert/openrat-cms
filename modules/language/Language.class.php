<?php

namespace language;

use LogicException;
use Spyc;

class Language
{
    public static function getLanguage($iso, $production = true)
    {
        if (!$production) {
            return self::getLanguageDevelopment($iso);
        } else {
            return self::getLanguageProduction($iso);
        }
    }

    private static function getLanguageDevelopment($iso)
    {
        $lang = array();
        foreach (self::getLanguageSource() as $key => $value) {
            if (isset($value[$iso]))
                $lang[$key] = $value[$iso];
            elseif(isset($value['emn']))
                $lang[$key] = $value['en'];
            else
                $lang[$key] = $key;
        }
        return $lang;
    }

    /**
     * @param $iso ISO-language-code
     * @return array
     */
    private static function getLanguageProduction($iso)
    {
        $langFile = __DIR__ . '/lang-' . $iso . '.php';

        // Is language available?
        if (!file_exists($langFile))
            // Fallback to english
            $langFile = __DIR__ . '/lang-en.php';

        require($langFile);
        return language();
    }


    private static function getLanguageSource()
    {
        return Spyc::YAMLLoad(__DIR__ . '/language.yml');
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
            $outputFilename = __DIR__ . '/lang-' . $iso . '.php';

            $success = file_put_contents($outputFilename, "<?php /* DO NOT CHANGE THIS GENERATED FILE */\n");

            if ($success)
                ;
            else
                throw new LogicException("File is not writable: '$outputFilename'\n");

            file_put_contents($outputFilename, "function language() { return array(\n", FILE_APPEND);
            foreach ($lang as $key => $value) {
                if (isset($value[$iso]))
                    $t = $value[$iso];
                else
                    $t = $value['en']; // Fallback to english
                $t = str_replace('"', '\"', $t); // escaping
                file_put_contents($outputFilename, "'$key'=>\"$t\",\n", FILE_APPEND);
            }
            file_put_contents($outputFilename, ");}", FILE_APPEND);

        }
    }

}

?>