<?php

namespace cms\ui\themes;

use util\FileUtils;
use util\Less;
use util\ui\minifier\JSMinifier;
use util\ui\minifier\CSSMinifier;
use template_engine\TemplateEngineInfo;

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
            if (is_file( __DIR__.'/../../../'. $componentCssFile . '.css'))
                $css[] = __DIR__.'/../../../'.$componentCssFile;
        }

		foreach ($css as $cssF)
		{
			$lessFile = $cssF . '.less';
			//$cssFile  = $cssF . '.css';

			$parser = new Less(array(
				'compress' => false,
				'sourceMap' => false,
				'indentation' => '  '
			));
			$parser->parseFile($lessFile);
			$source = $parser->getCss();
			$outFilename = $cssF.'.css';
			file_put_contents( $outFilename, $source."\n");
			echo 'Created file '.$outFilename ."\n";


			$parser = new Less(array(
				'compress' => true,
				'sourceMap' => false,
				'indentation' => ''
			));
			$parser->parseFile($lessFile);
			$source = $parser->getCss();

			//$minifier = new CSSMinifier();

			//$minifier->addSourceFile( $lessFile );
			//$source = $minifier->getCompressedContent();

			$outFilename = $cssF.'.min.css';
			file_put_contents( $outFilename, $source."\n");
			echo 'Created file '.$outFilename ."\n";
		}

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
				$minifier = new JSMinifier(
					JSMinifier::FLAG_IMPORT_MIN_JS +
					JSMinifier::FLAG_REMOVE_MULTILINE_COMMENT +
					JSMinifier::FLAG_REMOVE_LINE_COMMENTS +
					JSMinifier::FLAG_REMOVE_TABS +
					JSMinifier::FLAG_REMOVE_INDENTING_SPACES );
				$minifier->addSourceFile( $jsFileNormal );
				file_put_contents($jsFileMin, $minifier->getCompressedContent());

				echo 'Minified to '.$jsFileMin."\n";
			} else {
				throw new \LogicException('Missing javascript: '.$jsFile );
			}
		}
	}

}
