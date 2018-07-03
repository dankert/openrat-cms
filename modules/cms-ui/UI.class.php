<?php

namespace cms_ui;

use BadMethodCallException;
use cms\Dispatcher;
use DomainException;
use Exception;
use Http;
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
    public static function execute()
    {
        try {

            if(empty($_REQUEST[CMS_UI_REQ_PARAM_EMBED])) {
                $action = 'index';
                $subaction = 'show';
            }
            else
            {
                if (!empty($_REQUEST[CMS_UI_REQ_PARAM_ACTION]))
                    $action = $_REQUEST[CMS_UI_REQ_PARAM_ACTION];
                else
                    $action = 'index';

                if (!empty($_REQUEST[CMS_UI_REQ_PARAM_SUBACTION]))
                    $subaction = $_REQUEST[CMS_UI_REQ_PARAM_SUBACTION];
                else {
                    $subaction = 'show';
                }
            }

            header('Content-Type: text/html; charset=UTF-8');

            self::setContentSecurityPolicy();

            UI::executeAction($action,$subaction);

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

    public static function executeEmbedded($action, $subaction)
    {
        try {
            UI::executeEmbeddedAction($action,$subaction);

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

    private static function executeAction( $action, $subaction )
    {
        $dispatcher = new Dispatcher();

        $dispatcher->action = $action;
        if(!defined('OR_ACTION'))
            define('OR_ACTION', $action);

        $dispatcher->subaction = $subaction;
        if(!defined('OR_METHOD'))
            define('OR_METHOD', $subaction);


        $data = $dispatcher->doAction();

        // The action is able to change its method and action name.
        $subaction = $dispatcher->subaction;
        $action    = $dispatcher->action;

        $tplName = $action . '/' . $subaction;

        UI::outputTemplate($tplName,$data['output']);
    }

    private static function executeEmbeddedAction( $action, $subaction )
    {
        $dispatcher = new Dispatcher();

        $dispatcher->action = $action;
        if(!defined('OR_ACTION'))
            define('OR_ACTION', $action);

        $dispatcher->subaction = $subaction;
        if(!defined('OR_METHOD'))
            define('OR_METHOD', $subaction);

        // Embedded Actions are ALWAYS Queries (means: GET).
        $dispatcher->isAction = false;
        $dispatcher->isEmbedded = true;

        $data = $dispatcher->callActionMethod();

        // The action is able to change its method and action name.
        $subaction = $dispatcher->subaction;
        $action    = $dispatcher->action;

        $tplName = $action . '/' . $subaction;

        UI::outputTemplate($tplName,$data['output']);
    }

    /**
     * Executes and outputs a HTML template.
     *
     * @param $templateName string Name of template
     * @param $outputData array Output data
     */
    private static function outputTemplate($templateName, $outputData)
    {
        $templateFile = __DIR__.'/themes/default/html/views/' . $templateName . '.php';

        // In development mode, we are compiling every template on the fly.
        if (DEVELOPMENT) {
            $srcFile = __DIR__.'/themes/default/html/views/' . $templateName . '.tpl.src.xml';

            // Compile the template.
            // From a XML source file we are generating a PHP file.
            try
            {
                $te = new TemplateEngine();
                $te->compile($srcFile, $templateFile);
                unset($te);
            } catch (Exception $e) {
                throw new DomainException("Compilation failed for Template '$templateName'.", 0, $e);
            }
            #header("X-CMS-Template-File: " . $templateFile);
        }

        // Spätestens jetzt muss das Template vorhanden sein.
        if (!is_file($templateFile))
            throw new LogicException("Template file '$templateFile' was not found.");

        // Übertragen der Ausgabe-Variablen in den aktuellen Kontext
        //
        extract($outputData);

        // Einbinden des Templates
        require_once($templateFile);
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
            'child-src \'self\'',
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
    private static function getCSSFiles(): array
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
