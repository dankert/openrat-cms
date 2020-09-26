<?php

namespace cms\ui;

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
use util\exception\UIException;
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
        } catch (UIException $e) {
            Logger::warn( $e->__toString() );
            throw new LogicException(\cms\base\Language::lang($e->key),0, $e);
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
        $templateFile = __DIR__ . '/themes/default/html/views/' . $templateName . '.tpl.src.xml';

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
    
    
}
