<?php

namespace cms\ui\themes;

use util\FileUtils;
use util\JSMinifier;
use util\JSqueeze;
use logger\Logger;
use template_engine\TemplateEngineInfo;
use util\Less;

/**
 * Theme-Compiler.
 *
 * @author Jan Dankert
 */
class ThemeCompiler
{
	public function compileAll() {
		$this->compileStyles();
		$this->compileScripts();

	}

	public function compileStyles()
	{
		$combinedCssFile    = __DIR__.'/default/'.Theme::STYLE_FILENAME;
		$combinedCssFileMin = __DIR__.'/default/'.Theme::STYLE_MINIFIED_FILENAME;

		file_put_contents($combinedCssFile   ,'');
		file_put_contents($combinedCssFileMin,'');

		$css = [];

        $styleFiles = FileUtils::readDir( __DIR__.'/default/style','less');
        foreach( $styleFiles as $styleFile ) {
        	$css[] = __DIR__.'/default/style'.'/'.substr($styleFile,0,-5);
        }

        // Komponentenbasiertes CSS
        foreach (TemplateEngineInfo::getComponentList() as $c)
        {
            $componentCssFile = 'template_engine/components/html/component_' . $c . '/' . $c;
            if (is_file( __DIR__.'/../../../'. $componentCssFile . '.less'))
                $css[] = __DIR__.'/../../../'.$componentCssFile;
        }

        //$css[] = __DIR__.'/../../../editor/simplemde/simplemde';
        //$css[] = __DIR__.'/../../../editor/trumbowyg/ui/trumbowyg';
        //$css[] = __DIR__.'/../../../editor/codemirror/lib/codemirror';

		foreach ($css as $cssF)
		{
			$lessFile = $cssF . '.less';

			file_put_contents($combinedCssFile, '/* Include style: '.substr($cssF,strlen(__DIR__)).' */'."\n",FILE_APPEND);

			// Den absoluten Pfad zur LESS-Datei ermitteln. Dieser wird vom LESS-Parser für den korrekten Link
			// auf die LESS-Datei in der Sourcemap benötigt.
			$pfx = substr(realpath($lessFile),0,0-strlen(basename($lessFile)));

			$parser = new Less(array(
				'sourceMap' => true,
				'indentation' => '	',
				'outputSourceFiles' => false,
				'sourceMapBasepath' => $pfx
			));


			$parser->parseFile( $lessFile );
			$source = $parser->getCss();

			file_put_contents($combinedCssFile, $source."\n",FILE_APPEND);

			$parser = new Less(array(
				'compress' => true,
				'sourceMap' => false,
				'indentation' => ''
			));
			$parser->parseFile($lessFile);
			$source = $parser->getCss();

			file_put_contents($combinedCssFileMin, $source."\n",FILE_APPEND);

			echo 'Copied source from less source file '.$lessFile."\n";
		}

		echo 'Created file '.$combinedCssFileMin."\n";
		echo 'Created file '.$combinedCssFile   ."\n";

	}



	public function compileScripts()
	{
		$js = [];

		// Jquery-Plugins
		$js[] = __DIR__.'/default/script/plugin/jquery-plugin-toggleAttr';
		$js[] = __DIR__.'/default/script/plugin/jquery-plugin-orSearch';
		$js[] = __DIR__.'/default/script/plugin/jquery-plugin-orLinkify';
		$js[] = __DIR__.'/default/script/plugin/jquery-plugin-orButton';
		$js[] = __DIR__.'/default/script/plugin/jquery-plugin-orTree';
		$js[] = __DIR__.'/default/script/plugin/jquery-plugin-orAutoheight';

		// OpenRat internal JS - als letztes, damit die vorigen bereits geladen sind.
		$js[] = __DIR__.'/default/script/openrat/api';
		$js[] = __DIR__.'/default/script/openrat/callback';
		$js[] = __DIR__.'/default/script/openrat/components';
		$js[] = __DIR__.'/default/script/openrat/dialog';
		$js[] = __DIR__.'/default/script/openrat/form';
		$js[] = __DIR__.'/default/script/openrat/init';
		$js[] = __DIR__.'/default/script/openrat/navigator';
		$js[] = __DIR__.'/default/script/openrat/notice';
		$js[] = __DIR__.'/default/script/openrat/view';
		$js[] = __DIR__.'/default/script/openrat/workbench';

		$js[] = __DIR__.'/default/script/Oquery';
		$js[] = __DIR__.'/default/script/jquery-global';

		// Komponentenbasiertes Javascript
		foreach ( TemplateEngineInfo::getComponentList() as $c)
		{
			$componentJsFile =  __DIR__.'/../../../template_engine/components/html/component_' . $c . '/' . $c;
			if (is_file($componentJsFile . '.js'))
				$js[] = $componentJsFile;
		}

		foreach ($js as $jsFile)
		{
			$jsFileMin    = $jsFile . '.min.js';
			$jsFileNormal = $jsFile . '.js';

			if( is_file($jsFileNormal) )
			{
				// Minify....
				$jz = new JSMinifier(
					JSMinifier::FLAG_IMPORT_MIN_JS +
					JSMinifier::FLAG_REMOVE_MULTILINE_COMMENT +
					JSMinifier::FLAG_REMOVE_BLANK_LINES +
					JSMinifier::FLAG_REMOVE_LINE_COMMENTS +
					JSMinifier::FLAG_REMOVE_WHITESPACE );
				file_put_contents($jsFileMin, $jz->minify(file_get_contents($jsFileNormal)));

				echo 'Minified to '.$jsFileMin."\n";
			} else {
				throw new \LogicException('Missing javascript: '.$jsFile );
			}
		}
	}

}
