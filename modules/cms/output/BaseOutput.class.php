<?php

namespace cms\output;

use BadMethodCallException;
use cms\action\RequestParams;
use cms\base\Language as L;
use cms\Dispatcher;
use Exception;
use util\Http;
use logger\Logger;
use \util\exception\ObjectNotFoundException;
use util\exception\UIException;
use util\exception\SecurityException;


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

		try {
			$this->beforeAction( $request );

			$dispatcher = new Dispatcher();
			$dispatcher->request = $request;

			$data = $dispatcher->doAction();      // calling the action ...

			$this->outputData( $request,$data );  // ... and output the data

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
			Http::forbidden();
			$this->setError("You are not allowed to execute this action.",$e);
		} catch (Exception $e) {
			Logger::warn( $e );
			// Sorry, our service is currently unavailable
			Http::serverError();
			$this->setError("Internal CMS error",$e);
		}
    }


	/**
	 * This method is executed before the dispatcher is called.
	 * Subclasses may override this to prepare the response.
	 * @param $request RequestParams
	 * @return void
	 */
	protected function beforeAction( $request )
	{
	}


	/**
	 * Is called if an error is thrown.
	 *
	 * @param $text string a message
	 * @param $cause Exception
	 */
	abstract protected function setError($text, $cause);
}