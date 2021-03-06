<?php

namespace cms\ui\themes;

use util\FileUtils;
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

        $css[] = __DIR__.'/../../../editor/simplemde/simplemde';
        $css[] = __DIR__.'/../../../editor/trumbowyg/ui/trumbowyg';

        $css[] = __DIR__.'/../../../editor/codemirror/lib/codemirror';

		foreach ($css as $cssF)
		{
			$lessFile = $cssF . '.less';
			$cssFile = $cssF . '.css';
			$cssMinFile = $cssF . '.min.css';

			file_put_contents($combinedCssFile, '/* Include style: '.$cssF.' */'."\n",FILE_APPEND);

			if (! is_file($lessFile) && is_file($cssMinFile))
            {
            	// Copy minified CSS files (from integrated third-party apps)
				file_put_contents($combinedCssFile   , file_get_contents($cssMinFile)."\n",FILE_APPEND);
				file_put_contents($combinedCssFileMin, file_get_contents($cssMinFile)."\n",FILE_APPEND);
				echo 'Copied source from minified css file '.$cssMinFile."\n";
			}
			elseif (! is_file($lessFile))
			{
				Logger::warn("Stylesheet not found: $lessFile");
				continue;
			}
			else
			{
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
		}

		echo 'Created file '.$combinedCssFileMin."\n";
		echo 'Created file '.$combinedCssFile   ."\n";

	}



	public function compileScripts()
	{
		$combinedJsFile    = __DIR__.'/default/'.Theme::SCRIPT_FILENAME;
		$combinedJsFileMin = __DIR__.'/default/'.Theme::SCRIPT_MINIFIED_FILENAME;

		file_put_contents( $combinedJsFile   ,'');
		file_put_contents( $combinedJsFileMin,'');

		$js = [];
		$js[] = __DIR__.'/default/script/jquery';
		$js[] = __DIR__.'/default/script/jquery-ui';

		// Jquery-Plugins
		$js[] = __DIR__.'/default/script/plugin/jquery-plugin-toggleAttr';
		$js[] = __DIR__.'/default/script/plugin/jquery-plugin-orSearch';
		$js[] = __DIR__.'/default/script/plugin/jquery-plugin-orLinkify';
		$js[] = __DIR__.'/default/script/plugin/jquery-plugin-orButton';
		$js[] = __DIR__.'/default/script/plugin/jquery-plugin-orTree';
		$js[] = __DIR__.'/default/script/plugin/jquery-plugin-orAutoheight';
		$js[] = __DIR__.'/default/script/jquery-qrcode';
		$js[] = __DIR__.'/default/script/jquery.hotkeys';

		// Codemirror Source Editor

		$js[] = __DIR__.'/../../../editor/codemirror/lib/codemirror';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/handlebars/handlebars';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/smalltalk/smalltalk';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/php/php';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/cobol/cobol';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/haskell/haskell';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/mathematica/mathematica';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/pug/pug';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/livescript/livescript';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/yaml-frontmatter/yaml-frontmatter';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/stylus/stylus';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/markdown/markdown';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/jsx/jsx';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/velocity/velocity';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/fortran/fortran';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/mirc/mirc';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/xquery/xquery';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/elm/elm';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/vhdl/vhdl';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/verilog/verilog';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/spreadsheet/spreadsheet';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/coffeescript/coffeescript';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/tiddlywiki/tiddlywiki';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/mumps/mumps';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/eiffel/eiffel';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/webidl/webidl';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/ebnf/ebnf';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/http/http';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/textile/textile';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/r/r';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/haml/haml';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/ecl/ecl';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/cypher/cypher';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/sieve/sieve';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/soy/soy';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/pig/pig';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/apl/apl';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/crystal/crystal';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/clike/clike';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/oz/oz';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/modelica/modelica';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/gherkin/gherkin';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/swift/swift';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/scheme/scheme';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/idl/idl';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/yaml/yaml';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/vue/vue';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/twig/twig';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/cmake/cmake';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/asciiarmor/asciiarmor';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/pegjs/pegjs';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/solr/solr';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/tiki/tiki';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/slim/slim';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/puppet/puppet';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/meta';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/go/go';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/commonlisp/commonlisp';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/rust/rust';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/powershell/powershell';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/stex/stex';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/q/q';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/htmlembedded/htmlembedded';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/d/d';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/protobuf/protobuf';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/mscgen/mscgen';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/django/django';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/toml/toml';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/yacas/yacas';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/dockerfile/dockerfile';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/python/python';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/vb/vb';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/octave/octave';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/tcl/tcl';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/clojure/clojure';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/sass/sass';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/gas/gas';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/sas/sas';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/julia/julia';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/fcl/fcl';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/tornado/tornado';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/asterisk/asterisk';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/sql/sql';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/gfm/gfm';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/mllike/mllike';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/rst/rst';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/ntriples/ntriples';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/sparql/sparql';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/properties/properties';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/rpm/rpm';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/htmlmixed/htmlmixed';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/xml/xml';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/ttcn-cfg/ttcn-cfg';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/ttcn/ttcn';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/z80/z80';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/brainfuck/brainfuck';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/forth/forth';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/nginx/nginx';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/javascript/javascript';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/pascal/pascal';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/haxe/haxe';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/perl/perl';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/factor/factor';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/smarty/smarty';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/vbscript/vbscript';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/dylan/dylan';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/asn.1/asn.1';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/ruby/ruby';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/nsis/nsis';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/css/css';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/haskell-literate/haskell-literate';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/mbox/mbox';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/dtd/dtd';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/erlang/erlang';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/turtle/turtle';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/troff/troff';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/jinja2/jinja2';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/diff/diff';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/dart/dart';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/shell/shell';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/lua/lua';
		$js[] = __DIR__.'/../../../editor/codemirror/mode/groovy/groovy';


		$js[] = __DIR__.'/../../../editor/simplemde/simplemde';
		$js[] = __DIR__.'/../../../editor/trumbowyg/trumbowyg';


		// OpenRat internal JS - als letztes, damit die vorigen bereits geladen sind.
		$js[] = __DIR__.'/default/script/openrat/init';
		$js[] = __DIR__.'/default/script/openrat/notice';
		$js[] = __DIR__.'/default/script/openrat/dialog';
		$js[] = __DIR__.'/default/script/openrat/view';
		$js[] = __DIR__.'/default/script/openrat/form';
		$js[] = __DIR__.'/default/script/openrat/workbench';
		$js[] = __DIR__.'/default/script/openrat/navigator';
		$js[] = __DIR__.'/default/script/openrat/common';

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

			if	( is_file($jsFileMin) )
			{
				// A minified version exists, this is ok, we take it.
				file_put_contents($combinedJsFile, '/* Include script: '.basename($jsFileMin).' */'."\n",FILE_APPEND);
				file_put_contents($combinedJsFile   , file_get_contents($jsFileMin)."\n",FILE_APPEND);
				file_put_contents($combinedJsFileMin, file_get_contents($jsFileMin)."\n",FILE_APPEND);

				echo 'Copied content from minified source file '.$jsFileMin."\n";
			}
			elseif( is_file($jsFileNormal) )
			{
				// A normal script file exists.
				file_put_contents($combinedJsFile, '/* Include script: '.basename($jsFileNormal).' */'."\n",FILE_APPEND);
				file_put_contents($combinedJsFile   , file_get_contents($jsFileNormal)."\n",FILE_APPEND);

				// Minify....
				$jz = new JSqueeze();
				file_put_contents($combinedJsFileMin, $jz->squeeze(file_get_contents($jsFileNormal))."\n",FILE_APPEND);

				echo 'Copied content from source file '.$jsFileNormal."\n";
			} else {
				throw new \LogicException('Missing javascript: '.$jsFile );
			}
		}
		echo 'Created file '.$combinedJsFile."\n";
		echo 'Created file '.$combinedJsFileMin."\n";
	}

}
