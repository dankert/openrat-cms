<?php

namespace cms\ui;

use BadMethodCallException;
use cms\action\RequestParams;
use cms\base\Language as L;
use cms\Dispatcher;
use Exception;
use template_engine\engine\TemplateRunner;
use util\Http;
use logger\Logger;
use LogicException;
use \util\exception\ObjectNotFoundException;
use util\exception\UIException;
use util\exception\SecurityException;
use template_engine\engine\TemplateEngine;
use util\text\TextMessage;


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
            define('COOKIE_PATH',dirname($_SERVER['SCRIPT_NAME']).'/');

            // Everything is UTF-8.
            header('Content-Type: text/html; charset=UTF-8');

            // Sending the Content-Security-Policy.
            self::setContentSecurityPolicy();

			if   ( @$_REQUEST['scope']=='openid' ) {
			    $request->action = 'login';
			    $request->method = 'oidc';
			}
			elseif (empty($request->action)) {
                $request->action = 'index';
                $request->method = 'show';
			}

            if   ( $request->isAction )
            	throw new \RuntimeException('The UI does not accept POST requests');

            if   ( in_array( $request->action,['index','tree','title','usergroup']) )
				$request->isUIAction = true;

            UI::executeAction($request);

        } catch (BadMethodCallException $e) {
            // Action-Method does not exist.
            Logger::debug( $e );
            Http::noContent();
        } catch (ObjectNotFoundException $e) {
            Logger::debug( $e ); // only debug, because this may happen on links to deleted objects.
            Http::noContent();
        } catch (UIException $e) {
            Logger::warn( $e );
            throw new LogicException(L::lang($e->key),0, $e);
        } catch (SecurityException $e) {
            Logger::info($e);
            Http::noContent();

            // this is not good at all, because the user may have signed off.
            //Http::notAuthorized("You are not allowed to execute this action.");
        } catch (Exception $e) {
            Logger::warn( $e );
            throw new LogicException("Internal CMS error",0, $e);
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

        $engine = new TemplateRunner();
        $engine->request = $request;
        $engine->executeTemplate( $templateFile, $outputData );
    }


    /**
     * Content-Security-Policy.
     */
    private static function setContentSecurityPolicy()
    {
        // config is not loaded yet. Allow nothing...
        header('Content-Security-Policy: default-src \'none\'' );

        // This will be overwritten by the index action
    }
    
    
}
