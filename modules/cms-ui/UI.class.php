<?php

namespace cms_ui;

use BadMethodCallException;
use cms\action\RequestParams;
use cms\Dispatcher;
use DomainException;
use Exception;
use Http;
use Less_Parser;
use Logger;
use LogicException;
use ObjectNotFoundException;
use OpenRatException;
use SecurityException;
use template_engine\TemplateEngine;
use template_engine\TemplateEngineInfo;

define('CMS_UI_REQ_PARAM_SUBACTION', 'subaction');
define('CMS_UI_REQ_PARAM_ACTION', 'action');
define('CMS_UI_REQ_PARAM_EMBED', 'embed');


class UI
{
    /**
     * Shows the complete UI.
     */
    public static function execute()
    {
        $request = new RequestParams();
        $request->isEmbedded = false;

        try
        {
            define('COOKIE_PATH',dirname($_SERVER['SCRIPT_NAME']));

            // Everything is UTF-8.
            header('Content-Type: text/html; charset=UTF-8');

            // Sending the Content-Security-Policy.
            self::setContentSecurityPolicy();

            if(empty($_REQUEST[CMS_UI_REQ_PARAM_EMBED])) {

                $isPost = $_SERVER['REQUEST_METHOD'] == 'POST';

                if($isPost)
                {
                    $dispatcher = new Dispatcher();

                    $request->isAction = true;
                    $dispatcher->request = $request;

                    $data = $dispatcher->doAction();

                    //$data['notices'];

                    // POST-Action has ended, now we want to show the UI.
                    $request->action = 'index';
                    $request->method = 'show';
                    $request->isAction = false;
                    $request->isEmbedded = true;
                    UI::executeAction($request);
                }
                else
                {
                    $request->action = 'index';
                    $request->method = 'show';
                    UI::executeAction($request);
                }

            }
            else
            {
                if (empty($request->action))
                    $request->action = 'index';

                if (empty($request->method))
                    $request->method = 'show';

                UI::executeAction($request);
            }

        } catch (BadMethodCallException $e) {
            // Action-Method does not exist.
            Http::noContent();
        } catch (ObjectNotFoundException $e) {
            Logger::warn("Object not found: " . $e->__toString()); // Nur Debug, da dies bei gelöschten Objekten vorkommen kann.
            Http::noContent();
        } catch (OpenRatException $e) {
            throw new LogicException(lang($e->key),0, $e);
        } catch (SecurityException $e) {
            Logger::info($e->getMessage());
            Http::notAuthorized("You are not allowed to execute this action.");
        } catch (Exception $e) {
            throw new LogicException("Internal CMS error: ".$e->__toString(),0, $e);
        }
    }

    /**
     * Shows a UI fragment.
     * This can only be executed after a UI::execute()-call.
     */
    public static function executeEmbedded($action, $subaction, $id)
    {
        $request = new RequestParams();

        $request->isEmbedded = true;
        $request->action = $action;
        $request->id     = $id;
        $request->method = $subaction;

        // Embedded Actions are ALWAYS Queries (means: GET).
        $request->isAction = false;

        try {
            UI::executeAction($request);

        } catch (BadMethodCallException $e) {
            // Action-Method does not exist.
            return "";
        } catch (ObjectNotFoundException $e) {
            Logger::warn("Embedded Action $action/$subaction: Object not found: " . $e->__toString()); // Nicht so schlimm, da dies bei gelöschten Objekten vorkommen kann.
            return DEVELOPMENT ? $e->getMessage() : "";
        } catch (OpenRatException $e) {
            Logger::warn(  "Embedded Action $action/$subaction: ".$e->__toString() );
            return DEVELOPMENT ? $e->getMessage() : lang($e->key);
        } catch (SecurityException $e) {
            Logger::info( "Embedded Action $action/$subaction: ".$e->getMessage() );
            return DEVELOPMENT ? $e->getMessage() : "";
        } catch (Exception $e) {
            Logger::warn( "Embedded Action $action/$subaction: ".$e->__toString() );
            return DEVELOPMENT ? $e->getMessage() : "";
        }
    }



    private static function executeAction($request)
    {
        $dispatcher = new Dispatcher();
        $dispatcher->request = $request;

        if ( $request->isEmbedded )
            $data = $dispatcher->callActionMethod();
        else
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
            'style-src \'self\'',
            'img-src \'self\'',
            // No <audio>, <video> elements
            'media-src \'none\'',
            'frame-src \'self\'',
            'worker-src \'self\'',
            'form-action \'self\'',
            'font-src \'none\'',
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
            $css[] = OR_HTML_MODULES_DIR . 'template-engine/components/html/' . $lessFile . '/' . $lessFile;
        }

        return $css;
    }
}
