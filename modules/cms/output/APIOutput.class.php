<?php

namespace cms\output;

use BadMethodCallException;
use cms\action\RequestParams;
use cms\api\API;
use cms\base\Startup;
use cms\Dispatcher;
use Exception;
use util\Http;
use logger\Logger;
use \util\exception\ObjectNotFoundException;
use util\exception\UIException;
use util\exception\SecurityException;
use util\json\JSON;
use util\Session;
use util\XML;
use util\YAML;

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
			'output'  => $data,
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
			'message' => $text
		];

		// Traces only in DEVELOPMENT mode
		// for security reasons, because traces may contain sensitive information.
		if (!defined('DEVELOPMENT') || DEVELOPMENT)
			$data['cause'] = $this->exceptionToArray($cause);

		$this->outputData($data);
	}

}
