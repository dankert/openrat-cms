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

define('CMS_UI_REQ_PARAM_SUBACTION', 'subaction');
define('CMS_UI_REQ_PARAM_ACTION', 'action');


class UI
{
    public static function execute()
    {
        try {
            if (!empty($_REQUEST[CMS_UI_REQ_PARAM_ACTION]))
                $action = $_REQUEST[CMS_UI_REQ_PARAM_ACTION];
            else
                $action = 'index';

            if (!empty($_REQUEST[CMS_UI_REQ_PARAM_SUBACTION]))
                $subaction = $_REQUEST[CMS_UI_REQ_PARAM_SUBACTION];
            else {
                $subaction = 'show';
            }

            $dispatcher = new Dispatcher();

            $dispatcher->action = $action;
            define('OR_ACTION', $action);

            $dispatcher->subaction = $subaction;
            define('OR_METHOD', $subaction);

            // Content-Security-Policy
            //if (config('security','content-security-policy')) // config is not loaded yet.
            $contentSecurityPolicyEntries = array(
                'default-src \'none\'',
                'script-src \'self\' \'unsafe-inline\'',
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
            header('Content-Security-Policy: '.implode(';',$contentSecurityPolicyEntries));

            $data = $dispatcher->doAction();

            // The action is able to change its method name.
            $subaction = $dispatcher->subaction;

            header('Content-Type: text/html; charset=UTF-8');

            $tplName = $action . '/' . $subaction;

            UI::outputTemplate($tplName,$data['output']);

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
     * Executes and outputs a HTML template.
     *
     * @param $templateName string Name of template
     * @param $outputData array Output data
     */
    private static function outputTemplate($templateName, $outputData)
    {
        $templateFile = __DIR__.'/themes/default/templates/' . $templateName . '.tpl.out.php';

        // In development mode, we are compiling every template on the fly.
        if (DEVELOPMENT) {
            $srcFile = __DIR__.'/themes/default/templates/' . $templateName . '.tpl.src.xml';

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
            header("X-CMS-Template-File: " . $templateFile);
        }


        // Übertragen der Ausgabe-Variablen in den aktuellen Kontext
        //
        extract($outputData);

        if (is_file($templateFile))
            // Einbinden des Templates
            require_once($templateFile);
        else
            throw new LogicException("Template file '$templateFile' was not found.");


    }

}
