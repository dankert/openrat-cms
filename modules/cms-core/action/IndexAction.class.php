<?php

namespace cms\action;

use \Auth;
use cms\model\User;
use Exception;
use JSqueeze;
use Less_Parser;
use Logger;
use ObjectNotFoundException;
use Session;


/**
 * Action-Klasse fuer die Anzeige der Hauptseite.
 * 
 * @author Jan Dankert
 * @package openrat.actions
 */
class IndexAction extends Action
{
	public $security = SECURITY_GUEST;

	
	private $perspective;
	
	/**
	 * Konstruktor
	 */
	function __construct()
	{
		$this->perspective = Session::get('perspective');
        Logger::info('Index: Perspective is '.$this->perspective);

		if	( !empty($this->perspective))
			$this->lastModified( config('config','last_modification_time') );
	}


	public function showView()
	{
		global $conf;
		
		// Schauen, ob eine Perspektive existiert.
		if	( empty($this->perspective) )
		{
			// Da keine Perspektive existiert, handelt es sich wohl um den
			// ersten Aufruf in dieser Sitzung.
			
			// Versuchen, einen Benutzernamen zu ermitteln, der im Eingabeformular vorausgewählt wird.
			$modules = explode(',',$conf['security']['modules']['autologin']);
			
			$username = '';
			foreach( $modules as $module)
			{
				Logger::debug('Auto-Login module: '.$module);
				$moduleClass = $module.'Auth';
				$auth = new $moduleClass;
				/* @type $auth Auth */
				$username = $auth->username();
			
				if	( !empty($username) )
				{
					Logger::debug('Auto-Login for User '.$username);
					break; // Benutzername gefunden.
				}
			}
			
			if	( !empty( $username ) )
			{
				try
				{
					$user = User::loadWithName( $username );
					Session::setUser($user);
					Logger::info('auto-login for user '.$username);
					$this->setPerspective('start');
				}
				catch( ObjectNotFoundException $e )
				{
					Logger::warn('Username for autologin does not exist: '.$username);
					$this->setPerspective('login');
				}
			}
			else
			{
				// Kein Auto-Login moeglich, die Anmeldemaske anzeigen. 
				$this->setPerspective('login');
			}
		}

		// Theme für den angemeldeten Benuter ermitteln, dieser wird für
		// den Link auf die CSS-Datei benoetigt.
		$user = Session::getUser();
		if	( is_object($user) )
			$style = $user->style; 
		else
			$style = config('interface','style','default');

		$jsFiles  = $this->getJSFiles();
		$cssFiles = $this->getCSSFiles();
		//$themeCss = $this->getThemeCSS();
		
		// HTML-Datei direkt einbinden.
		require('modules/cms-ui/themes/default/layout/index.php');
		exit;
	}

	
	private function getCSSFiles()
	{
		$productionCSSFile = OR_THEMES_DIR . 'default/production/combined.min.css';
		
		if (PRODUCTION)
		{
			return array(
				$productionCSSFile
			);
		}
		
		$outFiles = array();
		
		$css = array();
        $css[] = OR_THEMES_DIR . 'default/css/openrat-ui';
        $css[] = OR_THEMES_DIR . 'default/css/openrat-workbench';
        //$css[] = OR_HTML_MODULES_DIR . 'editor/codemirror/lib/codemirror';

        // Komponentenbasiertes CSS
		$elements = parse_ini_file(OR_THEMES_DIR . config('interface', 'theme') . '/include/elements.ini.' . PHP_EXT);
		
		foreach (array_keys($elements) as $c)
		{
			$componentCssFile = OR_HTML_MODULES_DIR . 'template-engine/components/html/' . $c . '/' . $c;
			if (is_file($componentCssFile . '.less'))
				$css[] = $componentCssFile;
		}
		
		$modified = false;
		foreach ($css as $cssF)
		{
			$lessFile = $cssF . '.less';
			$cssFile = $cssF . '.css';
			$cssMinFile = $cssF . '.min.css';
			
			if (! is_file($lessFile))
			{
				Logger::warn("Stylesheet not found: $lessFile");
				continue;
			}
			elseif (! is_file($cssFile) || ! is_writable($cssFile))
			{
				Logger::warn("Stylesheet output file not found or not writable: $cssFile");
				continue;
			}
			elseif (! is_file($cssMinFile) || ! is_writable($cssMinFile))
			{
				Logger::warn("Stylesheet output file not found or not writable: $cssMinFile");
				continue;
			}
			else
			{
				if (filemtime($lessFile) > filemtime($cssMinFile))
				{
					// LESS-Source wurde geändert, CSS-Version muss aktualisiert werden.
					$modified = true;
					
					// Den absoluten Pfad zur LESS-Datei ermitteln. Dieser wird vom LESS-Parser für den korrekten Link
					// auf die LESS-Datei in der Sourcemap benötigt.
					$pfx = substr(realpath($lessFile),0,0-strlen(basename($lessFile)));
					
					$parser = new Less_Parser(array(
						'sourceMap' => true,
						'indentation' => '	',
						'outputSourceFiles' => false,
						'sourceMapBasepath' => $pfx
					));
				
					
					$parser->parseFile( ltrim($lessFile,'./') );
					$source = $parser->getCss();
					
					file_put_contents($cssFile, $source);

					$parser = new Less_Parser(array(
						'compress' => true,
						'sourceMap' => false,
						'indentation' => ''
					));
					$parser->parseFile($lessFile);
					$source = $parser->getCss();
					
					
					file_put_contents($cssMinFile, $source);
				}
				
				$outFiles[] = $cssFile;
			}
		}
		
		if ($modified)
		{
			if	( !is_writable($productionCSSFile))
			{
				Logger::warn('not writable: '.$productionCSSFile);
			}
			else
			{
				file_put_contents($productionCSSFile,'');
				foreach ($css as $cssF)
				{
					$cssMinFile = $cssF . '.min.css';
					if	( is_file($cssMinFile))
						file_put_contents($productionCSSFile,file_get_contents($cssMinFile),FILE_APPEND);
				}
			}
		}
		
		return $outFiles;
	}

	
	public function themestyleView()
    {
        $themeLessFile = OR_THEMES_DIR . 'default/css/openrat-theme.less';
        $this->lastModified(filemtime($themeLessFile));

        header('Content-Type: text/css');
        echo $this->getThemeCSS();
        exit;
    }



	private function getThemeCSS()
	{
		// Je Theme die Theme-CSS-Datei ausgeben.
		$lessFile = OR_THEMES_DIR . 'default/css/openrat-theme.less';
		$css = '';
		
		
		foreach (array_keys(config('style')) as $styleId)
		{
			try
			{
				$parser = new Less_Parser(array(
					'sourceMap' => DEVELOPMENT,
					'indentation' => '	',
					'outputSourceFiles' => false
				));
				$parser->parseFile($lessFile,basename($lessFile));
				
				$styleConfig = config('style-default') + config('style', $styleId);
				$lessVars = array(
					'cms-theme-id' => strtolower($styleId),
					'cms-image-path' => 'themes/default/images/'
				);
				
				foreach ($styleConfig as $styleSetting => $value)
					$lessVars['cms-' . strtolower(strtr($styleSetting, '_', '-'))] = $value;
				$parser->modifyVars($lessVars);
				$css .= $parser->getCss();
			}
			catch (Exception $e)
			{
				$css .= "\n\n/* WARNING!\n   LESS Parser failed on file '$lessFile'. Reason: " . $e->__toString() . " */\n\n";
			}
		}
		
		if (PRODUCTION)
		{
			return $css; // Should we minify here? Bandwidth vs. cpu-load.
		}
		else
		{
			return $css;
		}
	}	
	


	private function getJSFiles()
	{
		$productionJSFile = OR_THEMES_DIR . 'default/production/combined.min.js';
		
		if (PRODUCTION)
		{
			return array(
				$productionJSFile
			);
		}
		else
		{
			$js = array();
			$js[] = OR_THEMES_DIR . 'default/js/jquery';
			$js[] = OR_THEMES_DIR . 'default/js/jquery-ui';
			$js[] = OR_THEMES_DIR . 'default/js/jquery.scrollTo';
			// $js[] = OR_THEMES_EXT_DIR default/js/jquery.mjs.nestedSortable.js"></script>
			
			// Jquery-Plugins
			$js[] = OR_THEMES_DIR . 'default/js/plugin/jquery-plugin-orHint';
			$js[] = OR_THEMES_DIR . 'default/js/plugin/jquery-plugin-orSearch';
			$js[] = OR_THEMES_DIR . 'default/js/plugin/jquery-plugin-orLinkify';
			$js[] = OR_THEMES_DIR . 'default/js/plugin/jquery-plugin-orTree';
			$js[] = OR_THEMES_DIR . 'default/js/plugin/jquery-plugin-orLoadView';
			$js[] = OR_THEMES_DIR . 'default/js/plugin/jquery-plugin-orAutoheight';
            $js[] = OR_THEMES_DIR . 'default/js/jquery-qrcode';

            // Inlining of SVG
            $js[] = OR_THEMES_DIR . 'default/js/svg-injector';

            // OpenRat internal JS
			$js[] = OR_THEMES_DIR . 'default/js/openrat';

			// Codemirror Source Editor

			$js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/lib/codemirror';
			$js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/handlebars/handlebars';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/smalltalk/smalltalk';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/php/php';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/cobol/cobol';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/haskell/haskell';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/mathematica/mathematica';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/pug/pug';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/livescript/livescript';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/yaml-frontmatter/yaml-frontmatter';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/stylus/stylus';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/markdown/markdown';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/jsx/jsx';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/velocity/velocity';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/fortran/fortran';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/mirc/mirc';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/xquery/xquery';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/elm/elm';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/vhdl/vhdl';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/verilog/verilog';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/spreadsheet/spreadsheet';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/coffeescript/coffeescript';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/tiddlywiki/tiddlywiki';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/mumps/mumps';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/eiffel/eiffel';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/webidl/webidl';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/ebnf/ebnf';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/http/http';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/textile/textile';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/r/r';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/haml/haml';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/ecl/ecl';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/cypher/cypher';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/sieve/sieve';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/soy/soy';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/pig/pig';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/apl/apl';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/crystal/crystal';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/clike/clike';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/oz/oz';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/modelica/modelica';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/gherkin/gherkin';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/swift/swift';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/scheme/scheme';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/idl/idl';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/yaml/yaml';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/vue/vue';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/twig/twig';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/cmake/cmake';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/asciiarmor/asciiarmor';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/pegjs/pegjs';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/solr/solr';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/tiki/tiki';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/slim/slim';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/puppet/puppet';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/meta';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/go/go';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/commonlisp/commonlisp';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/rust/rust';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/powershell/powershell';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/stex/stex';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/q/q';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/htmlembedded/htmlembedded';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/d/d';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/protobuf/protobuf';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/mscgen/mscgen';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/django/django';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/toml/toml';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/yacas/yacas';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/dockerfile/dockerfile';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/python/python';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/vb/vb';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/octave/octave';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/tcl/tcl';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/clojure/clojure';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/sass/sass';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/gas/gas';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/sas/sas';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/julia/julia';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/fcl/fcl';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/tornado/tornado';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/asterisk/asterisk';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/sql/sql';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/gfm/gfm';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/mllike/mllike';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/rst/rst';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/ntriples/ntriples';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/sparql/sparql';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/properties/properties';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/rpm/rpm';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/htmlmixed/htmlmixed';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/xml/xml';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/ttcn-cfg/ttcn-cfg';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/ttcn/ttcn';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/z80/z80';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/brainfuck/brainfuck';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/forth/forth';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/nginx/nginx';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/javascript/javascript';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/pascal/pascal';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/haxe/haxe';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/perl/perl';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/factor/factor';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/smarty/smarty';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/vbscript/vbscript';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/dylan/dylan';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/asn.1/asn.1';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/ruby/ruby';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/nsis/nsis';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/css/css';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/haskell-literate/haskell-literate';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/mbox/mbox';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/dtd/dtd';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/erlang/erlang';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/turtle/turtle';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/troff/troff';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/jinja2/jinja2';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/diff/diff';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/dart/dart';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/shell/shell';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/lua/lua';
            $js[] = OR_HTML_MODULES_DIR . 'editor/codemirror/mode/groovy/groovy';

			
			//$js[] = OR_THEMES_DIR . '../editor/markitup/markitup/jquery.markitup';
			//$js[] = OR_THEMES_DIR . '../editor/editor/ckeditor';
			//$js[] = OR_THEMES_DIR . '../editor/ace/src-min-noconflict/ace';
			//$js[] = OR_THEMES_DIR . '../editor/editor/adapters/jquery';
			
			// Komponentenbasiertes Javascript
			$elements = parse_ini_file(OR_THEMES_DIR . config('interface', 'theme') . '/include/elements.ini.' . PHP_EXT);
			
			foreach (array_keys($elements) as $c)
			{
				$componentJsFile = OR_HTML_MODULES_DIR .  '/template-engine/components/html/' . $c . '/' . $c;
				if (is_file($componentJsFile . '.js'))
					$js[] = $componentJsFile;
			}
			
			$outDevJsFiles = array();
			$outProJsFiles = array();
			$lastModTime = 0;
			
			foreach ($js as $jsFile)
			{
				$jsFileMin = $jsFile . '.min.js';
				$jsFileNormal = $jsFile . '.js';
				
				if (!is_file($jsFileNormal) && !is_file($jsFileMin))
				{
					Logger::warn("No Javascript file found for $jsFile");
					continue;
				}
				elseif (is_file($jsFileNormal) && !is_file($jsFileMin))
				{
					Logger::warn("No Min-Javascript file found for $jsFile");
					continue;
				}
				elseif (!is_file($jsFileNormal) && is_file($jsFileMin))
				{
					// Nur eine Min-Version existiert. Das ist ok.
					$outDevJsFiles[] = $jsFileMin;
					$outProJsFiles[] = $jsFileMin;
					$modTime = filemtime($jsFileMin); 
				}
				else
				{
					if	( filemtime($jsFileNormal) > filemtime($jsFileMin) )
					{
						if	( is_writable( $jsFileMin))
						$jz = new JSqueeze();
						file_put_contents( $jsFileMin, $jz->squeeze(file_get_contents($jsFileNormal)));
						$modTime = time();
					}
					else
					{
						$modTime = filemtime($jsFileMin); 
					}
					$outDevJsFiles[] = $jsFileNormal;
					$outProJsFiles[] = $jsFileMin;
				}
				$lastModTime = max($lastModTime, $modTime);
			}
			
			if ($lastModTime > filemtime($productionJSFile))
			{
				if (! is_writable($productionJSFile))
				{
					Logger::warn("Not writable: " . $productionJSFile);
				}
				else
				{
					file_put_contents($productionJSFile, '');
					foreach ($outProJsFiles as $srcFile)
						file_put_contents($productionJSFile, file_get_contents($srcFile), FILE_APPEND);
				}
			}
		}
		
		return $outDevJsFiles;
	}
	
	

}
?>