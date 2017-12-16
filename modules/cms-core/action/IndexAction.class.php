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


// OpenRat Content Management System
// Copyright (C) 2002-2012 Jan Dankert, cms@jandankert.de
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; version 2.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

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
		$themeCss = $this->getThemeCSS();
		
		// HTML-Datei direkt einbinden.
		require('themes/default/layout/index.php');
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
		$css[] = OR_THEMES_EXT_DIR . 'default/css/openrat-ui';
		$css[] = OR_THEMES_EXT_DIR . 'default/css/openrat-workbench';
		
		// Komponentenbasiertes CSS
		$elements = parse_ini_file(OR_THEMES_DIR . config('interface', 'theme') . '/include/elements.ini.' . PHP_EXT);
		
		foreach (array_keys($elements) as $c)
		{
			$componentCssFile = OR_MODULES_DIR . 'template-engine/components/html/' . $c . '/' . $c;
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

	
	
	private function getThemeCSS()
	{
		// Je Theme die Theme-CSS-Datei ausgeben.
		$lessFile = OR_THEMES_EXT_DIR . 'default/css/openrat-theme.less';
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
			$js[] = OR_THEMES_EXT_DIR . 'default/js/jquery-1.12.4';
			$js[] = OR_THEMES_EXT_DIR . 'default/js/jquery-ui/js/jquery-ui-1.8.16.custom';
			$js[] = OR_THEMES_EXT_DIR . 'default/js/jquery.scrollTo';
			// $js[] = OR_THEMES_EXT_DIR default/js/jquery.mjs.nestedSortable.js"></script>
			
			// Jquery-Plugins
			$js[] = OR_THEMES_EXT_DIR . 'default/js/plugin/jquery-plugin-orHint';
			$js[] = OR_THEMES_EXT_DIR . 'default/js/plugin/jquery-plugin-orSearch';
			$js[] = OR_THEMES_EXT_DIR . 'default/js/plugin/jquery-plugin-orLinkify';
			$js[] = OR_THEMES_EXT_DIR . 'default/js/plugin/jquery-plugin-orTree';
			$js[] = OR_THEMES_EXT_DIR . 'default/js/plugin/jquery-plugin-orLoadView';
			$js[] = OR_THEMES_EXT_DIR . 'default/js/plugin/jquery-plugin-orAutoheight';
			$js[] = OR_THEMES_EXT_DIR . 'default/js/plugin/jquery-plugin-svg';
			$js[] = OR_THEMES_EXT_DIR . 'default/js/jquery-qrcode';
			// OpenRat internal JS
			$js[] = OR_THEMES_EXT_DIR . 'default/js/openrat';
			$js[] = OR_THEMES_EXT_DIR . '../editor/markitup/markitup/jquery.markitup';
			$js[] = OR_THEMES_EXT_DIR . '../editor/editor/ckeditor';
			$js[] = OR_THEMES_EXT_DIR . '../editor/ace/src-min-noconflict/ace';
			$js[] = OR_THEMES_EXT_DIR . '../editor/editor/adapters/jquery';
			
			// Komponentenbasiertes Javascript
			$elements = parse_ini_file(OR_THEMES_DIR . config('interface', 'theme') . '/include/elements.ini.' . PHP_EXT);
			
			foreach (array_keys($elements) as $c)
			{
				$componentJsFile = OR_MODULES_DIR .  '/template-engine/components/html/' . $c . '/' . $c;
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