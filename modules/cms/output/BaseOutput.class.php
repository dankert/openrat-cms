<?php

namespace cms\output;

use BadMethodCallException;
use cms\action\RequestParams;
use cms\base\Language as L;
use cms\base\Startup;
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
use util\Session;
use util\text\TextMessage;


/**
 * base class for output.
 */
abstract class BaseOutput implements Output
{
	abstract protected function outputData($request, $data);

	/**
	 * Calling the dispatcher.
	 */
	public function execute()
    {
		$request = new RequestParams();

		$this->beforeAction( $request );

        $dispatcher = new Dispatcher();
        $dispatcher->request = $request;

		try {
			$data = $dispatcher->doAction();

			$this->outputData( $request,$data );
		} catch (BadMethodCallException $e) {
			// Action-Method does not exist.
			Logger::debug( $e );
			Http::noContent();
			$this->setError("Method not found",$e);
		} catch (ObjectNotFoundException $e) {
			Logger::debug( $e ); // only debug, because this may happen on links to deleted objects.
			Http::noContent();
			$this->setError("No content",$e);
		} catch (UIException $e) {
			Logger::warn( $e );
			$this->setError(L::lang($e->key,$e->params),$e);
		} catch (SecurityException $e) {
			Logger::info($e);
			Http::notAuthorized();
			$this->setError("You are not allowed to execute this action.",$e);
		} catch (Exception $e) {
			Logger::warn( $e );
			// Sorry, our service is currently unavailable
			Http::serverError();
			$this->setError("Internal CMS error",$e);
		}
    }

	protected function beforeAction( $request )
	{
	}


	abstract protected function setError($text, $cause);


	protected function setStatus( $status, $text )
	{
		header('HTTP/1.0 ' . intval($status) . ' ' . $text);
	}

}