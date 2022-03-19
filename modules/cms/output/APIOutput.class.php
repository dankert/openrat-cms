<?php

namespace cms\output;

use BadMethodCallException;
use cms\action\RequestParams;
use cms\base\Startup;
use Exception;
use util\exception\ClientException;
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
    private static function exceptionToArray($e)
    {
        $data = array(
            'error'=>get_class($e),
            'description'=>$e->getMessage(),
            'code'=>$e->getCode(),

            'trace'=>array_merge( array( array(
                'file'=>$e->getFile(),
                'line'=>$e->getLine(),
                'function'=>'',
                'class'   => ''
                )), self::removeArgsFromTrace($e->getTrace()))
        );

        // the cause of the exception is another exception.
        if   ( $e->getPrevious() )
            $data['cause'] = self::exceptionToArray($e->getPrevious() );

        return $data;
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


    /**
     * Removing the call argument from the trace.
     *
     * This is because of security reasons. The arguments could be an information leak.
     *
     * @param $trace array
     * @return array
     */
    private static function removeArgsFromTrace($trace)
    {
        foreach( $trace as &$t )
        {
            unset($t['args']);
        }

        return $trace;
    }

	protected function outputData($request, $data)
	{
		$data += [
			'session' => [
				'name'  => session_name(),
				'id'    => session_id(),
				'token' => Session::token()
			],
			'version' => Startup::VERSION,
			'api'     => Startup::API_LEVEL,
		];

		$output = $this->renderOutput( $data );

		// HTTP Spec:
		// "Applications SHOULD use this field to indicate the transfer-length of the
		//  message-body, unless this is prohibited by the rules in section 4.4."
		//
		// And the overhead of 'Transfer-Encoding: chunked' is eliminated...
		header('Content-Length: ' . strlen($output));
		echo $output;
	}

	abstract protected function renderOutput( $data );

	protected function setError($text, $cause)
	{
		$data = [
			'message' => $text,
			'notices' => [
				[
					'status'=>'error',
					'text'  =>$text,
				]
			],
			'errors'  => [],
		];

		// Traces only in DEVELOPMENT mode
		// for security reasons, because traces may contain sensitive information.
		if (!defined('DEVELOPMENT') || DEVELOPMENT)
			$data['cause'] = $this->exceptionToArray($cause);

		$this->outputData(null,$data);
	}

}
