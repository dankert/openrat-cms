<?php

namespace cms\api;

use BadMethodCallException;
use cms\action\RequestParams;
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
class API
{
	const OUTPUT_PHPARRAY     = 1;
	const OUTPUT_PHPSERIALIZE = 2;
	const OUTPUT_JSON         = 3;
	const OUTPUT_XML          = 4;
	const OUTPUT_YAML         = 5;
	const OUTPUT_HTML         = 6;
	const OUTPUT_PLAIN        = 7;


	/**
     * Führt einen API-Request durch.
     */
    public static function execute()
    {
    	$createDataWithError = function( $status, $message, $cause ) {

			Logger::warn($cause);
			API::sendHTTPStatus($status, $message);

			$data = [
				'status'  => $status,
				'message' => $message
			];

			// Traces only in DEVELOPMENT mode
			// for security reasons, because traces may contain sensitive information.
			if (!defined('DEVELOPMENT') || DEVELOPMENT)
				$data['cause'] = API::exceptionToArray($cause);

			return $data;
		};

        try {
            $request = new RequestParams();

            $dispatcher = new Dispatcher();

            $dispatcher->request = $request;

            $data = $dispatcher->doAction();

        } catch (BadMethodCallException $e) {
            $data = $createDataWithError( 204, 'Method not found'  , $e );
        } catch (ObjectNotFoundException $e) {
			$data = $createDataWithError( 204, 'Object not found'  , $e );
        } catch (UIException $e) {
			$data = $createDataWithError( 500, 'Internal CMS Error', $e );
        } catch (SecurityException $e) {
			$data = $createDataWithError( 403, 'Forbidden'          , $e );
        } catch (Exception $e) {
			$data = $createDataWithError( 500, 'Internal Server Error', $e );
        }


        if ( Logger::isTraceEnabled() )
            Logger::trace('Output' . "\n" . print_r($data, true));

        // Weitere Variablen anreichern.
        $data['session'] = ['name' => session_name(), 'id' => session_id(), 'token' => Session::token()];
        $data['version'] = Startup::VERSION;
        $data['api'    ] = Startup::API_LEVEL;


        switch (API::discoverOutputType()) {

            case self::OUTPUT_PHPARRAY:
                header('Content-Type: application/php-array; charset=UTF-8');
                $output = print_r($data, true);
                break;

			case self::OUTPUT_PLAIN:
				header('Content-Type: text/plain; charset=UTF-8');
				$output = print_r($data, true);
				break;

			case self::OUTPUT_PHPSERIALIZE:
                header('Content-Type: application/php-serialized; charset=UTF-8');
                $output = serialize($data);
                break;

            case self::OUTPUT_JSON:
                header('Content-Type: application/json; charset=UTF-8');
	            $output = JSON::encode($data);
                break;

            case self::OUTPUT_XML:
                $xml = new XML();
                $xml->root = 'server'; // Name des XML-root-Elementes
                header('Content-Type: application/xml; charset=UTF-8');
                $output = $xml->encode($data);
                break;

            case self::OUTPUT_HTML:
                header('Content-Type: text/html; charset=UTF-8');
                $output  = '<html><body><h1>API response:</h1><hr /><pre>';
                $output .= print_r($data,true);
                $output .= '</pre></body></html>';
                break;

            case self::OUTPUT_YAML:
                header('Content-Type: application/yaml; charset=UTF-8');
                $output = YAML::dump($data);
                break;
        }


        if (!headers_sent())
            // HTTP Spec:
            // "Applications SHOULD use this field to indicate the transfer-length of the
        	//  message-body, unless this is prohibited by the rules in section 4.4."
            //
            // And the overhead of 'Transfer-Encoding: chunked' is eliminated...
            header('Content-Length: ' . strlen($output));

        echo $output;
    }

    /**
     * Discovering the output-type for this API-request
     *
     * @return int constant of self::CMS_API_OUTPUT_*
     */
    private static function discoverOutputType()
    {
        $types = Http::getAccept();

        $reqOutput = strtolower(@$_REQUEST['output']);

        // First check: The output parameter has precedence over HTTP headers
        if ( $reqOutput == 'php-array')
            return self::OUTPUT_PHPARRAY;

        if ( $reqOutput == 'php')
            return self::OUTPUT_PHPSERIALIZE;

        if ( $reqOutput == 'json')
            return self::OUTPUT_JSON;

        if ( $reqOutput == 'xml')
            return self::OUTPUT_XML;

        if ( $reqOutput == 'yaml')
            return self::OUTPUT_YAML;

        // Lets check the HTTP request headers
        if (in_array('application/php-array', $types) )
            return self::OUTPUT_PHPARRAY;

        if (in_array('application/php-serialized', $types) )
            return self::OUTPUT_PHPSERIALIZE;

        if (in_array('application/json', $types) )
            return self::OUTPUT_JSON;

        if (in_array('application/xml', $types) )
            return self::OUTPUT_XML;

        if (in_array('application/yaml', $types) )
            return self::OUTPUT_YAML;

        if (in_array('text/html', $types))
            return self::OUTPUT_HTML;  // normally an ordinary browser.

        return self::OUTPUT_PLAIN; // Fallback
    }

    /**
     * @param $status int HTTP-Status
     * @param $text string Statustext
     */
    private static function sendHTTPStatus($status, $text)
    {
        if (headers_sent()) {
            //echo "$status $text";
            ; // There is nothing we can do. Every output would destroy the JSON, XML, whatever.
        } else {
            header('HTTP/1.0 ' . intval($status) . ' ' . $text);
        }
    }

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
                )), API::removeArgsFromTrace($e->getTrace()))
        );

        // the cause of the exception is another exception.
        if   ( $e->getPrevious() )
            $data['cause'] = API::exceptionToArray($e->getPrevious() );

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
}
