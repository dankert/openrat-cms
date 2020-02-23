<?php

namespace cms_ui;

use BadMethodCallException;
use cms\action\RequestParams;
use cms\Dispatcher;
use DomainException;
use Exception;
use util\Http;
use \Less_Parser;
use logger\Logger;
use LogicException;
use ObjectNotFoundException;
use util\exception\OpenRatException;
use util\exception\SecurityException;
use template_engine\engine\TemplateEngine;
use template_engine\TemplateEngineInfo;


class UI
{
    /**
     * Shows the complete UI.
     */
    public static function execute()
    {
        $request = new RequestParams();

        try
        {
            define('COOKIE_PATH',dirname($_SERVER['SCRIPT_NAME']));

            // Everything is UTF-8.
            header('Content-Type: text/html; charset=UTF-8');

            // Sending the Content-Security-Policy.
            self::setContentSecurityPolicy();

            if (empty($request->action))
                $request->action = 'index';

            if (empty($request->method))
                $request->method = 'show';

            UI::executeAction($request);

        } catch (BadMethodCallException $e) {
            // Action-Method does not exist.
            Logger::warn( $e->__toString() );
            Http::noContent();
        } catch (ObjectNotFoundException $e) {
            Logger::debug("Object not found: " . $e->__toString()); // Nur Debug, da dies bei gelöschten Objekten vorkommen kann.
            Http::noContent();
        } catch (OpenRatException $e) {
            Logger::warn( $e->__toString() );
            throw new LogicException(lang($e->key),0, $e);
        } catch (SecurityException $e) {
            Logger::info($e->getMessage());
            Http::noContent();

            // this is not good at all, because the user may have signed off.
            //Http::notAuthorized("You are not allowed to execute this action.");
        } catch (Exception $e) {
            Logger::warn( $e->__toString() );
            throw new LogicException("Internal CMS error: ".$e->__toString(),0, $e);
        }
    }


    private static function executeAction($request)
    {
        $dispatcher = new Dispatcher();
        $dispatcher->request = $request;

        $data = $dispatcher->doAction();


        // The action is able to change its method and action name.
        $subaction = $dispatcher->request->method;
        $action    = $dispatcher->request->action;

        $tplName = $action . '/' . $subaction;

        UI::outputTemplate($request,$tplName, $data['output']);
    }


    /**
     * Executes and outputs a HTML template.
     *
     * @param $templateName string Name of template
     * @param $outputData array Output data
     */
    private static function outputTemplate($request, $templateName, $outputData)
    {
        $templateFile = __DIR__.'/themes/default/html/views/' . $templateName . '.tpl.src.xml';

        if   ( DEVELOPMENT )
            header('X-OR-Template: '.$templateFile);

        $engine = new TemplateEngine();
        $engine->request = $request;
        $engine->executeTemplate( $templateFile, $outputData );
    }


    /**
     * Content-Security-Policy.
     */
    private static function setContentSecurityPolicy()
    {
        //if (config('security','content-security-policy')) // config is not loaded yet.
        $contentSecurityPolicyEntries = array(
            'default-src \'none\'',
            'script-src \'self\'',
            // No <object>, <embed> or <applet>.
            'object-src \'none\'',
            // no external CSS
            'style-src \'self\'',
            // no external images.
            'img-src \'self\'',
            // No <audio>, <video> elements
            'media-src \'none\'',
            // For preview of urls we need to show every url in an iframe.
            'frame-src *',
            'worker-src \'self\'',
            'form-action \'self\'',
            'font-src \'self\'',
            // Ajax-Calls
            'connect-src \'self\'');
        header('Content-Security-Policy: ' . implode(';', $contentSecurityPolicyEntries));
    }
    
    
    public static function updateProduction()
    {
        self::updateProductionCSS();
        self::updateProductionJS();
    }

    private static function updateProductionCSS()
    {
        $productionCSSFile = __DIR__ . 'cms-ui/themes/default/production/combined.min.css';

        $css = self::getCSSFiles();
        //$css[] = OR_HTML_MODULES_DIR . 'editor/codemirror/lib/codemirror';

        // Komponentenbasiertes CSS

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

    }

    private static function updateProductionJS()
    {
    }

    /**
     * @return array
     */
    private static function getCSSFiles()
    {
        $css = array();
        $css[] = OR_THEMES_DIR . 'default/css/openrat-ui';
        $css[] = OR_THEMES_DIR . 'default/css/openrat-workbench';

        foreach (TemplateEngineInfo::getLESSFiles() as $lessFile)
        {
            $css[] = OR_HTML_MODULES_DIR . 'template_engine/components/html/' . $lessFile . '/' . $lessFile;
        }

        return $css;
    }
}
