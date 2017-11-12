<?php
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
	function IndexAction()
	{
		$this->perspective = Session::get('perspective');
// 		$this->lastModified( filemtime(__FILE__) );
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

		// HTML-Datei direkt einbinden.
		require('themes/default/layout/index.php');
		exit;
	}
	
	
	public function stylesheetView()
	{
	    if ( DEVELOPMENT )
	        $this->lastModified( config('config','last_modification') );
	    else
	        $this->lastModified( strtotime(config('version','date')) );
	            
	            
	    header('Content-Type: text/css');
	    $css = array();
	    //   $css[] = link id="userstyle" rel="stylesheet" type="text/css" href="<?php echo css_link($style) "
// 	    $cssParam = css_link($style);
	    
// 	    $css['userstyle'] = OR_THEMES_EXT_DIR.'default/css/openrat-theme.css.php';
	    $css[] = OR_THEMES_EXT_DIR.'default/css/openrat-ui';
	    $css[] = OR_THEMES_EXT_DIR.'default/css/openrat-workbench';
	    
	    //   $css[] = OR_THEMES_EXT_DIR.'../editor/markitup/markitup/skins/markitup/style.css';
	    //   $css[] = OR_THEMES_EXT_DIR.'../editor/markitup/markitup/sets/default/style.css';
	    
	    // Komponentenbasiertes CSS
	    $elements = parse_ini_file( OR_THEMES_DIR.config('interface','theme').'/include/elements.ini.'.PHP_EXT);
	    
	    foreach( array_keys($elements) as $c )
	    {
	        $componentCssFile = OR_THEMES_DIR.config('interface','theme').'/include/html/'.$c.'/'.$c;
	        if    ( is_file($componentCssFile.'.less') )
	            $css[] = $componentCssFile;
	            
	    }
	    
	    if  ( DEVELOPMENT ) {
	        
	        foreach( $css as $id=>$cssF )
	        {
	            $lessFile   = $cssF.'.less';
	            $cssFile    = $cssF.'.css';
	            $cssMinFile = $cssF.'.min.css';

	            
	            
	            if ( !is_file($lessFile))
	            {
	                echo "\n/* File $lessFile is missing! */";
	                Logger::warn("Stylesheet not found: $lessFile");
	            }
	            elseif ( !is_file($cssFile) || !is_file($cssMinFile))
	            {
	                echo "\n/* File $cssMinFile is missing! */";
	                Logger::warn("Stylesheet output file not found $cssMinFile");
	            }
	            else
	            {
	                if( filemtime($lessFile) > filemtime($cssMinFile) )
	                {
	                    // LESS-Source wurde geändert, CSS-Version muss aktualisiert werden.
	                    if   ( !is_writable($cssFile) || !is_writable($cssMinFile))
	                    {
	                        echo "/* File $jsFileMin is not writable! */";
	                        Logger::warn("Style-Output file is not writable: $cssMinFile");
	                    }
	                    else
	                    {
            	            echo "/* LESS Source file: $lessFile */\n";
                            $parser = new Less_Parser();
                            $parser->parse( file_get_contents($lessFile) );
                            $source = $parser->getCss();
                            
	                        file_put_contents( $cssFile, "/* DO NOT CHANGE THIS FILE! CHANGE .LESS INSTEAD! */\n\n".$source );
                            
	                        
	                        file_put_contents( $cssMinFile, $this->minifyCSS($source) );
	                    }
	                }
	                echo "\n/* CSS file: $cssFile */\n";
	                readfile($cssFile);
	            }
            }
        }
        else
        {
            // Production mode: Inline minified CSS  
              foreach( $css as $id=>$cssF )
              {
                  $cssMinFile = $cssF.'.min.css';

                  if ( !is_file($cssMinFile))
                  {
                      echo "\n/* File $cssMinFile is missing! */\n";
                      Logger::warn("Stylesheet output file not found $cssMinFile");
                  }
                  else
                  {
                      readfile($cssMinFile);
                  }
             }                  
        }

        
        // Je Theme die Theme-CSS-Datei ausgeben.
        $cssF       = OR_THEMES_EXT_DIR.'default/css/openrat-theme';
        $lessFile   = $cssF.'.less';
        $cssFile    = $cssF.'.css';
        $cssMinFile = $cssF.'.min.css';

        if  ( DEVELOPMENT )
        {
			if (filemtime($lessFile) > filemtime($cssMinFile))
			{
				try
				{
					file_put_contents($cssFile, "/* DO NOT CHANGE THIS FILE! CHANGE .LESS INSTEAD! */\n\n");
					file_put_contents($cssMinFile, '');
					
					$lessSource = file_get_contents($lessFile);
					
					foreach (array_keys(config('style')) as $styleId)
					{
						$parser = new Less_Parser(array('sourceMap' => true));
						
						$parser->parse($lessSource);
						
						$styleConfig = config('style', $styleId);
						$lessVars = array(
							'cms-theme-id'   => strtolower($styleId),
							'cms-image-path' => 'themes/default/images/'
						);
						
						foreach ($styleConfig as $styleSetting => $value)
							$lessVars['cms-' . strtolower(strtr($styleSetting, '_', '-'))] = $value;
						$parser->modifyVars($lessVars);
						$css = $parser->getCss();
						
						file_put_contents($cssFile   , "\n/* Style $styleId */\n" . $css, FILE_APPEND);
						file_put_contents($cssMinFile, $this->minifyCSS($css), FILE_APPEND);
					}
				}
				catch (Exception $e)
				{
					file_put_contents($cssFile, "\n\n/* WARNING!\n   LESS Parser failed on file '$lessFile'. Reason: " . $e->__toString() . " */\n\n");
					
					throw new LogicException("LESS Parser failed on file '$lessFile'", 0, $e);
				}
			}
            
            echo "\n/* Theme-CSS: $cssFile */\n";
            readfile( $cssFile );
        }
		else
		{
			// Production.
			readfile($cssMinFile);
		}
  
	    exit;
	}
	
	
	private function minifyCSS( $css )
	{
	    // Remove comments
	    $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
	    // Remove space after colons
	    $css = str_replace(': ', ':', $css);
	    // Remove whitespace
	    $css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css);
	    
	    return $css;
	}
	
	
	
	public function javascriptView()
	{
	    if ( DEVELOPMENT )
	        $this->lastModified( config('config','last_modification') );
	    else
	        $this->lastModified( strtotime(config('version','date')) );
	    
	    header('Content-Type: text/javascript');
	    
	    $js = array();
	    $js[] = OR_THEMES_EXT_DIR.'default/js/jquery-1.12.4';
	    $js[] =  OR_THEMES_EXT_DIR.'default/js/jquery-ui/js/jquery-ui-1.8.16.custom';
	    $js[] =  OR_THEMES_EXT_DIR.'default/js/jquery.scrollTo';
	    //$js[] =  OR_THEMES_EXT_DIR default/js/jquery.mjs.nestedSortable.js"></script>
	    
	    //<!-- OpenRat internal JS -->
	    $js[] =  OR_THEMES_EXT_DIR.'default/js/openrat';
	    $js[] =  OR_THEMES_EXT_DIR.'default/js/plugin/jquery-plugin-orHint';
	    $js[] =  OR_THEMES_EXT_DIR.'default/js/plugin/jquery-plugin-orSearch';
	    $js[] =  OR_THEMES_EXT_DIR.'default/js/plugin/jquery-plugin-orLinkify';
	    $js[] =  OR_THEMES_EXT_DIR.'default/js/plugin/jquery-plugin-orTree';
	    $js[] =  OR_THEMES_EXT_DIR.'default/js/plugin/jquery-plugin-orLoadView';
	    $js[] =  OR_THEMES_EXT_DIR.'default/js/plugin/jquery-plugin-orAutoheight';
	    $js[] =  OR_THEMES_EXT_DIR.'default/js/jquery-qrcode';
	    //  $js[] =  OR_THEMES_EXT_DIR.'../editor/wymeditor/wymeditor/jquery.wymeditor.min.js"></script> -->
	    $js[] =  OR_THEMES_EXT_DIR.'../editor/markitup/markitup/jquery.markitup';
	    $js[] =  OR_THEMES_EXT_DIR.'../editor/editor/ckeditor';
	    $js[] =  OR_THEMES_EXT_DIR.'../editor/ace/src-min-noconflict/ace';
	    $js[] =  OR_THEMES_EXT_DIR.'../editor/editor/adapters/jquery';
	    
	    // Komponentenbasiertes Javascript
	    $elements = parse_ini_file( OR_THEMES_DIR.config('interface','theme').'/include/elements.ini.'.PHP_EXT);
	    
	    foreach( array_keys($elements) as $c )
	    {
	        $componentJsFile = OR_THEMES_DIR.config('interface','theme').'/include/html/'.$c.'/'.$c;
	        if    ( is_file($componentJsFile.'.js') )
	            $js[] = $componentJsFile;
	            
	    }
	    
	    if    ( DEVELOPMENT )
	    {
	        
	        foreach( $js as $jsFile )
	        {
	            $jsFileMin    = $jsFile.'.min.js';
	            $jsFileNormal = $jsFile.'.js';
	            
	            if ( !is_file($jsFileNormal) && is_file($jsFileMin))
	            {
	                // Es gibt nur eine minifizierte JS. Das ist ok, z.B. bei externen Bibliotheken.
	                echo "\n// JS-Source: $jsFileMin\n";
	                readfile($jsFileMin);
	            }
	            elseif ( !is_file($jsFileNormal))
	            {
	                echo "\n// File $jsFileNormal is missing!";
	                Logger::warn("No Javascript file found for $jsFileNormal");
	            }
	            elseif ( !is_file($jsFileMin))
	            {
	                echo "\n// File $jsFileMin is missing!";
	                Logger::warn("No Javascript file found for $jsFileMin");
	                echo "\n// JS-Source: $jsFileNormal\n";
	                readfile($jsFileNormal);
	            }
	            else
	            {
	                if( filemtime($jsFileNormal) > filemtime($jsFileMin) )
	                {
	                    // Java-Source wurde geändert, minifizierte Version muss aktualisiert werden.
	                    if   ( !is_writable($jsFileMin))
	                    {
        	                echo "// File $jsFileMin is not writable!";
        	                Logger::warn("No Javascript file found for $jsFileMin");
	                    }
	                    else
	                    {
            	            $jz = new JSqueeze();
            	            
            	            file_put_contents( $jsFileMin, $this->minifyJS(file_get_contents($jsFileNormal)));
	                    }
	                }

	                echo "\n// JS-Source: $jsFileNormal\n";
	                readfile($jsFileNormal);
	            }
		    }
	    }
	    else
	    {   // PRODUCTION
	        foreach( $js as $jsFile )
	        {
	            $jsFileMin    = $jsFile.'.min.js';
	            $jsFileNormal = $jsFile.'.js';
	            if ( is_file($jsFileMin))
    	            readfile($jsFileMin);
	            elseif( is_file($jsFileNormal))
	                readfile($jsFileNormal);
	            else
	                Logger::warn("No Javascript file found for $jsFile(.js|.min.js)");
	        }
		}
		
		exit;
	    
	}
	
	
	private function minifyJS( $js )
	{
	    $jz = new JSqueeze();
	    
	    return $jz->squeeze(
	        $js,
	        true,   // $singleLine
	        true,   // $keepImportantComments
	        false   // $specialVarRx
	    );
	    
	}
}
?>