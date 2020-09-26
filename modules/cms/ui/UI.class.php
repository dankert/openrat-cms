<?php

namespace cms\ui;

use BadMethodCallException;
use cms\action\RequestParams;
use cms\Dispatcher;
use Exception;
use util\Http;
use logger\Logger;
use LogicException;
use ObjectNotFoundException;
use util\exception\UIException;
use util\exception\SecurityException;
use template_engine\engine\TemplateEngine;


/**
 * Executing the Openrat CMS User Interface.
 * The request is executed by a dispatcher and the output is displayed with a template.
 *
 * @package cms\ui
 */
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

            if (empty($request->action)) {
                $request->action = 'index';
                $request->method = 'show';
			}

            if   ( in_array( $request->action,['index','tree','title']) )
				$request->isUIAction = true;

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

        UI::outputTemplate($request,$action, $subaction, $data['output']);
    }


	/**
	 * Executes and outputs a HTML template.
	 *
	 * @param $request RequestParams
	 * @param $action string action
	 * @param $subaction string method
	 * @param $outputData array Output data
	 */
    private static function outputTemplate($request, $action, $subaction, $outputData)
    {
        $templateFile = __DIR__ . '/themes/default/html/views/' . $action.'/'.$subaction . '.php';

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
        // config is not loaded yet.
        $contentSecurityPolicyEntries = array(
            'default-src \'none\'',
            // no eval, no inline.
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
