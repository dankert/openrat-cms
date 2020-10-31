<?php

namespace language;

use LogicException;

use util\YAML;

class LanguageCompiler
{
    private $srcFile;

    private $fallback = 'en';
    const DO_NOT_CHANGE = '/* DO NOT CHANGE THIS GENERATED FILE */';

    public function __construct()
    {
		$this->languageFolder = __DIR__ . '/';
        $this->srcFile  = __DIR__ . '/language.yml';
        $this->listFile = __DIR__ . '/LanguageList.class.php';
        $this->keyFile  = __DIR__ . '/Messages.class.php';
    }

    /**
     * Compiles language YAML source to native language php files.
     * Only, if the YAML source file has changed.
     */
    private function compile()
    {
        $this->updateProduction();
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

        $this->updateMessages($lang);
        $this->updateLanguageFiles($lang);
    }

	/**
	 * Creates the production environment.
	 * @param $lang
	 */
    private function updateMessages( $lang )
    {
		$success = file_put_contents($this->keyFile, '<?php namespace '.__NAMESPACE__."; ".self::DO_NOT_CHANGE."\nclass Messages {\n");
		if ($success)
			;
		else
			throw new LogicException("File is not writable: '$this->keyFile'\n");

		file_put_contents($this->keyFile, '  public static $AVAILABLE_LANGUAGES = ['.implode(',',array_map(function ($language) {
			return '\''.$language.'\'';
			},$this->getIsoList($lang))).'];'."\n",FILE_APPEND);


		foreach ($lang as $key => $values)
			file_put_contents($this->keyFile, '  const '.strtoupper($key).' = \''.strtoupper($key).'\';'."\n",FILE_APPEND);

		file_put_contents($this->keyFile, '}',FILE_APPEND);
		echo 'Success: Updated file '.$this->keyFile."\n";
    }




    private function getIsoList( $lang )
	{
		$isoList = array();

		foreach ($lang as $key => $values) {
			foreach ($values as $isocode => $value) {
				if (!in_array($isocode, $isoList))
					$isoList[] = $isocode;
			}

		}

		return $isoList;
	}




/**
	 * Creates the production environment.
	 * @param $lang
	 */
    private function updateLanguageFiles( $lang )
    {
        // creating a list of all language iso codes.

		foreach ($this->getIsoList($lang) as $iso) {
            $outputFilename = $this->getOutputLanguageFile($iso);

            $success = file_put_contents($outputFilename, "<?php ".self::DO_NOT_CHANGE."\n");

            if ($success)
                ;
            else
                throw new LogicException("File is not writable: '$outputFilename'\n");

            file_put_contents($outputFilename, "namespace ".__NAMESPACE__.'; class '.$this->getOutputLanguageClass($iso)." {\npublic function get() { return [\n", FILE_APPEND);
            foreach ($lang as $key => $value) {
                if (isset($value[$iso]))
                    $t = $value[$iso];
                elseif (isset($value[$this->fallback]))
                    $t = $value[$this->fallback]; // Fallback language
                else
                    echo "WARNING: ".'language key '.$key.' has no value for '.$iso.' and '.$this->fallback.'.'."\n";
                $t = str_replace('\'', '\\\'', $t); // escaping
                file_put_contents($outputFilename, "'$key'=>'$t',\n", FILE_APPEND);
            }
            file_put_contents($outputFilename, "];}\n}", FILE_APPEND);

            echo 'Success: Updated file '.$outputFilename."\n";
        }
    }

    /**
     * Returns the native php language file for the selected iso code.
     * @param $iso string ISO-Code
     * @param null string $fallbackiso Fallback to this ISO-Code, if the file does not exist.
     * @return string filename
     */
    private function getOutputLanguageClass( $iso )
    {
        return 'Language_' . strtoupper($iso);
    }

    /**
     * Returns the native php language file for the selected iso code.
     * @param $iso string ISO-Code
     * @param null string $fallbackiso Fallback to this ISO-Code, if the file does not exist.
     * @return string filename
     */
    private function getOutputLanguageFile( $iso )
    {
        return __DIR__.'/'.$this->getOutputLanguageClass($iso).'.class.php';
    }

}