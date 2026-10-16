<?php

namespace cms\output;

use cms\action\RequestParams;
use cms\api\APIResponse;
use cms\api\TraceElement;
use cms\base\Startup;
use Exception;
use Throwable;
use util\exception\ClientException;
use util\Hydrator;
use util\Session;

/**
 * Entrypoint for all API requests.
 */
abstract class APIOutput extends BaseOutput
{
    /**
     * Converting an exception to an array.
     *
     * This will contain all exceptions out of the exception chain.
     *
     * @param $e Exception
     */
    private static function exceptionToArray( Throwable $e): \cms\api\Exception
    {
		$previous = $e->getPrevious();
		if   ( $previous != null )
			$cause = self::exceptionToArray($previous );
		else
			$cause = null;

		return new \cms\api\Exception(
			get_class($e),
			$e->getMessage(),
            $e->getCode(),
			array_map(
				function( $trace ) {
					return new TraceElement(
						$trace['file'],
						$trace['line'],
						@$trace['function'],
						@$trace['class'],
						// no 'args' for security reasons
					);}
					,$e->getTrace()),
		$cause );
    }

	/**
	 * This method is executed before the dispatcher is called.
	 * Subclasses may override this to prepare the response.
	 * @param $request RequestParams
	 * @return void
	 */
	protected function beforeAction( $request )
	{
		if   ( ! $request->action )
			throw new ClientException('no action set');
		if   ( ! $request->method )
			throw new ClientException('no subaction set');
	}




	protected function outputData(RequestParams|null $request, $data): void
	{
		$output = $this->renderOutput( $data );

		// HTTP Spec:
		// "Applications SHOULD use this field to indicate the transfer-length of the
		//  message-body, unless this is prohibited by the rules in section 4.4."
		//
		// And the overhead of 'Transfer-Encoding: chunked' is eliminated...
		header('Content-Length: ' . strlen($output));
		echo $output;
	}

	abstract protected function renderOutput(array $data ): string;

	/**
	 * @param string $text
	 * @param Exception $cause
	 */
	protected function setError(string $text, Exception $cause): void
	{
		// Traces only in DEVELOPMENT mode
		// for security reasons, because traces may contain sensitive information.
		if (!defined('DEVELOPMENT') || DEVELOPMENT)
			$apiException = $this->exceptionToArray($cause);
		else
			$apiException = null;

		$apiResponse = new APIResponse(
			$text,
			[ [
					'status'=> 'error',
					'text'  => $text,
					'log'   => (!defined('DEVELOPMENT') || DEVELOPMENT) ? $cause->getMessage() : '',
				]
			],
			[],
			'',
			'',
			false,
			'',
			Startup::VERSION,
			Startup::API_LEVEL,
			$apiException
		);

		$this->outputData(null,Hydrator::toArray($apiResponse) );
	}

}
