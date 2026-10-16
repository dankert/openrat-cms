<?php

namespace cms\output;

use BadMethodCallException;
use cms\action\RequestParams;
use cms\action\Response;
use cms\api\APIResponse;
use cms\base\Language as L;
use cms\base\Startup;
use cms\Dispatcher;
use Exception;
use util\exception\ClientException;
use util\Http;
use logger\Logger;
use \util\exception\ObjectNotFoundException;
use util\exception\UIException;
use util\exception\SecurityException;
use util\Hydrator;
use util\Session;


/**
 * base class for output.
 */
abstract class BaseOutput implements Output
{
	/**
	 * Outputting the data to the client.
	 * Must be overwritten by subclasses.
	 * @param $request RequestParams
	 * @param $data array data array
	 * @return void
	 */
	abstract protected function outputData(RequestParams|null $request, array $data): void;

	/**
	 * Calling the dispatcher.
	 */
	public function execute()
    {
		$request  = new RequestParams();
		$response = new Response();

		try {
			$this->beforeAction( $request );

			// special behaviour of UI actions, these are placed in a special package.
			if   ( in_array( $request->action,['index','tree','title','usergroup']) )
				$request->isUIAction = true;

			$dispatcher = new Dispatcher();
			$dispatcher->setRequestAndResponse( $request,$response );

			$dispatcher->doAction();      // calling the action ...

			if   ( $contentType = $this->getContentType() )
				header('Content-Type: '.$contentType.'; charset='.Startup::CHARSET);

			$response->setHTTPHeader();

			if   ( $request->isAction ) {

				$apiResponse = new APIResponse(
					'',
					$response->getNotices(), // notices
					$response->getErrors(),  // fieldnames with validation errors
					$response->getStatus(),  // notice status
					$response->getStatus(),  // same as above, historical reasons
					$response->success, // success, true if there are no errors and no notices with status error.
					new \cms\api\Session(
						session_name(),
						session_id(),
						Session::token(),
					),
				Startup::VERSION,
					intval(Startup::API_LEVEL),
					null,
				);

				$this->outputData( $request,Hydrator::toArray($apiResponse ) );  // ... and output the data
			}
			else {
				$this->outputData( $request,$response->getOutputData() );  // ... and output the data
			}

		} catch (BadMethodCallException $e) {
			// Action-Method does not exist.
			Logger::debug( $e );
			Http::notAcceptable();
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
		} catch (ClientException $e) {
			Logger::info($e);
			Http::badRequest();
			$this->setError("Invalid data in request.",$e);
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
	abstract protected function setError(string $text, Exception $cause): void;
}