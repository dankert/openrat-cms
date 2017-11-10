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
	        $this->lastModified(config('config','last_modification',1*60*60) );
	            
	            
	    function minifyCSS( $source ) {
	        
	        // Remove comments
	        $source = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $source);
	        // Remove space after colons
	        $source = str_replace(': ', ':', $source);
	        // Remove whitespace
	        $source = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $source);
	        
	        return $source;
	    }
	    
	    header('Content-Type: text/css');
	    $css = array();
	    //   $css[] = link id="userstyle" rel="stylesheet" type="text/css" href="<?php echo css_link($style) "
// 	    $cssParam = css_link($style);
	    
// 	    $css['userstyle'] = OR_THEMES_EXT_DIR.'default/css/openrat-theme.css.php';
	    $css[] = OR_THEMES_EXT_DIR.'default/css/openrat-ui.css';
	    $css[] = OR_THEMES_EXT_DIR.'default/css/openrat-workbench.css';
	    
	    //   $css[] = OR_THEMES_EXT_DIR.'../editor/markitup/markitup/skins/markitup/style.css';
	    //   $css[] = OR_THEMES_EXT_DIR.'../editor/markitup/markitup/sets/default/style.css';
	    
	    // Komponentenbasiertes CSS
	    $elements = parse_ini_file( OR_THEMES_DIR.config('interface','theme').'/include/elements.ini.'.PHP_EXT);
	    
	    foreach( array_keys($elements) as $c )
	    {
	        $componentCssFile = OR_THEMES_DIR.config('interface','theme').'/include/html/'.$c.'/'.$c.'.css';
	        if    ( is_file($componentCssFile) )
	            $css[] = $componentCssFile;
	        
            // LESS-Version vorhanden?
	        $componentCssFile = OR_THEMES_DIR.config('interface','theme').'/include/html/'.$c.'/'.$c.'.less';
	        if    ( is_file($componentCssFile) )
	            $css[] = $componentCssFile;
	            
	    }
	    
	    if  ( DEVELOPMENT ) {
	        
	        foreach( $css as $id=>$cssFile )
	        {
	            if ( substr($cssFile,-5)=='.less')
	            {
    	            echo "/* LESS Source file: $cssFile */";
	                $parser = new Less_Parser();
	                $parser->parse( file_get_contents($cssFile) );
	                echo $parser->getCss();
	            }
	            else
	            {
    	            echo "/* CSS Source file: $cssFile */";
    	            echo file_get_contents($cssFile);
	            }
            }
        }
        else
        {
            // Production mode: Inline minified CSS  
              ob_start('minifyCSS');
              foreach( $css as $id=>$cssFile )
              {
                  if ( substr($cssFile,-5)=='.less')
                  {
                      $parser = new Less_Parser();
                      $parser->parse( file_get_contents($cssFile) );
                      echo $parser->getCss();
                  }
                  else
                  {
                      echo file_get_contents($cssFile);
                  }
                  
            }
            ob_end_flush();
        }

        // Je Theme die Theme-CSS-Datei ausgeben.
        foreach( array_keys(config('style')) as $styleId )
        {

            $css = file_get_contents(OR_THEMES_EXT_DIR.'default/css/openrat-theme.less');
            $css = str_replace('__name__',$styleId,$css);
            $css = str_replace('__IMAGE_PATH__',OR_THEMES_EXT_DIR.'default/images/',$css);
            foreach( config('style',$styleId) as $key=>$value)
            {
                $css = str_replace('__'.$key.'__',$value,$css);
            }
            $parser = new Less_Parser();
            $parser->parse( $css );
            $css = $parser->getCss();
            if  ( PRODUCTION)
                $css = minifyCSS($css);
            echo $css;
        }
  
	    exit;
	}
	
	
	public function javascriptView()
	{
	    if ( DEVELOPMENT )
	        $this->lastModified( config('config','last_modification') );
	    else
	        $this->lastModified(config('config','last_modification',1*60*60) );
	    
	    header('Content-Type: text/javascript');
	    
	    function minifyJS( $source ) {
	        $jz = new JSqueeze();
	        
	        return $jz->squeeze(
	            $source,
	            true,   // $singleLine
	            true,   // $keepImportantComments
	            false   // $specialVarRx
	            );
	    }
	    
	    $js = array();
	    $js[] = OR_THEMES_EXT_DIR.'default/js/jquery-1.12.4.min.js';
	    $js[] =  OR_THEMES_EXT_DIR.'default/js/jquery-ui/js/jquery-ui-1.8.16.custom.min.js';
	    $js[] =  OR_THEMES_EXT_DIR.'default/js/jquery.scrollTo.js';
	    //$js[] =  OR_THEMES_EXT_DIR default/js/jquery.mjs.nestedSortable.js"></script>
	    
	    //<!-- OpenRat internal JS -->
	    $js[] =  OR_THEMES_EXT_DIR.'default/js/openrat.js';
	    $js[] =  OR_THEMES_EXT_DIR.'default/js/plugin/jquery-plugin-orHint.js';
	    $js[] =  OR_THEMES_EXT_DIR.'default/js/plugin/jquery-plugin-orSearch.js';
	    $js[] =  OR_THEMES_EXT_DIR.'default/js/plugin/jquery-plugin-orLinkify.js';
	    $js[] =  OR_THEMES_EXT_DIR.'default/js/plugin/jquery-plugin-orTree.js';
	    $js[] =  OR_THEMES_EXT_DIR.'default/js/plugin/jquery-plugin-orLoadView.js';
	    $js[] =  OR_THEMES_EXT_DIR.'default/js/plugin/jquery-plugin-orAutoheight.js';
	    $js[] =  OR_THEMES_EXT_DIR.'default/js/jquery-qrcode.min.js';
	    //  $js[] =  OR_THEMES_EXT_DIR.'../editor/wymeditor/wymeditor/jquery.wymeditor.min.js"></script> -->
	    $js[] =  OR_THEMES_EXT_DIR.'../editor/markitup/markitup/jquery.markitup.js';
	    $js[] =  OR_THEMES_EXT_DIR.'../editor/editor/ckeditor.js';
	    $js[] =  OR_THEMES_EXT_DIR.'../editor/ace/src-min-noconflict/ace.js';
	    $js[] =  OR_THEMES_EXT_DIR.'../editor/editor/adapters/jquery.js';
	    
	    // Komponentenbasiertes Javascript
	    $elements = parse_ini_file( OR_THEMES_DIR.config('interface','theme').'/include/elements.ini.'.PHP_EXT);
	    
	    foreach( array_keys($elements) as $c )
	    {
	        $componentJsFile = OR_THEMES_DIR.config('interface','theme').'/include/html/'.$c.'/'.$c.'.js';
	        if    ( is_file($componentJsFile) )
	            $js[] = $componentJsFile;
	            
	    }
	    
	    if    ( DEVELOPMENT )
	    {
	        
	        foreach( $js as $jsFile )
	        {
	            echo "\n// JS source file: $jsFile\n";
	            readFile($jsFile);
		    }
	    }
	    else
	    {
	        foreach( $js as $jsFile )
	        {
	            ob_start('minifyJS');
	            echo minifyJS( file_get_contents($jsFile));
	            ob_end_flush();
	        }
		}
		
		exit;
	    
	}
}
?>