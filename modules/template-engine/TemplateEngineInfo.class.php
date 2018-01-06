<?php

namespace template_engine;

class TemplateEngineInfo
{

	public static function getLESSFiles()
	{
	    return self::getComponentFilesByExtension('.less');
    }

	public static function getJSFiles()
	{
        return self::getComponentFilesByExtension('.js');
    }


    /**
     * Gets all files with the specified extension.
     *
     * @param $extension string Extension
     * @return array
     */
    private static function getComponentFilesByExtension($extension )
    {

        $files = array();
        if ($handle = opendir(__DIR__.'/components/html')) {

            while (false !== ($entry = readdir($handle))) {
                if  ( substr($entry,-strlen($extension)) == $extension )
                    $files[] = $entry;
            }

            closedir($handle);
        }
        return $files;
    }

}
