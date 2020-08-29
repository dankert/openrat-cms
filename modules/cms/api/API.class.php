<?php

namespace cms\api;

use BadMethodCallException;
use cms\action\RequestParams;
use cms\Dispatcher;
use Exception;
use util\Http;
use JSON;
use logger\Logger;
use ObjectNotFoundException;
use util\exception\UIException;
use util\exception\SecurityException;
use util\XML;

define('CMS_API_REQ_PARAM_SUBACTION', 'subaction');
define('CMS_API_REQ_PARAM_ACTION', 'action');

define('CMS_API_OUTPUT_PHPARRAY', 1);
define('CMS_API_OUTPUT_PHPSERIALIZE', 2);
define('CMS_API_OUTPUT_JSON', 3);
define('CMS_API_OUTPUT_XML', 4);
define('CMS_API_OUTPUT_YAML', 5);
define('CMS_API_OUTPUT_HTML', 6);

class API
{
    /**
     * Führt einen API-Request durch.
     */
    public static function execute()
    {
        try {
            $request = new RequestParams();

            $dispatcher = new Dispatcher();

            $dispatcher->request = $request;

            $data = $dispatcher->doAction();

        } catch (BadMethodCallException $e) {
            Logger::warn($e);

            API::sendHTTPStatus(204, 'Method not found');
            $data = array('status' => 204) + API::exceptionToArray( $e );
        } catch (ObjectNotFoundException $e) {
            Logger::warn($e);

            API::sendHTTPStatus(204, 'Object not found');
            $data = array('status' => 204)+ API::exceptionToArray( $e );
        } catch (UIException $e) {
            Logger::warn($e);

            API::sendHTTPStatus(500, 'Internal CMS Error');
            $data = array('status' => 500)+ API::exceptionToArray( $e );
        } catch (SecurityException $e) {
            Logger::warn($e);
            //Logger::info('API request not allowed: ' . $e->getMessage());
            API::sendHTTPStatus(403, 'Forbidden');
            $data = array('status' => 403)+ API::exceptionToArray( $e );
        } catch (Exception $e) {
            Logger::warn($e);
            API::sendHTTPStatus(500, 'Internal Server Error');
            $data = array('status' => 500)+ API::exceptionToArray( $e );
        }


        if (Logger::$level >= LOGGER_LOG_TRACE)
            Logger::trace('Output' . "\n" . print_r($data, true));

        // Weitere Variablen anreichern.
        $data['session'] = array('name' => session_name(), 'id' => session_id(), 'token' => token());
        $data['version'] = OR_VERSION;
        $data['api'] = '2';


        switch (API::discoverOutputType()) {

            case CMS_API_OUTPUT_PHPARRAY:
                header('Content-Type: application/php-array; charset=UTF-8');
                $output = print_r($data, true);
                break;

            case CMS_API_OUTPUT_PHPSERIALIZE:
                header('Content-Type: application/php-serialized; charset=UTF-8');
                $output = serialize($data);
                break;

            case CMS_API_OUTPUT_JSON:
                header('Content-Type: application/json; charset=UTF-8');
                if (function_exists('json_encode'))
                {
                    // Native Methode ist schneller..
                    if ( version_compare(PHP_VERSION, '5.5', '>=' ) )
                        $jsonOptions = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK | JSON_PARTIAL_OUTPUT_ON_ERROR;
                    else
                        $jsonOptions = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK;

                    $output = json_encode($data, $jsonOptions);
                }
                else
                {
                    // Fallback, falls json_encode() nicht existiert...
                    $json = new JSON();
                    $output = $json->encode($data);
                }
                break;

            case CMS_API_OUTPUT_XML:
                require_once(OR_SERVICECLASSES_DIR . "XML.class." . PHP_EXT);
                $xml = new XML();
                $xml->root = 'server'; // Name des XML-root-Elementes
                header('Content-Type: application/xml; charset=UTF-8');
                $output = $xml->encode($data);
                break;

            case CMS_API_OUTPUT_HTML:
                header('Content-Type: text/html; charset=UTF-8');
                $output  = '<html><body><h1>API response:</h1><hr /><pre>';
                $output .= print_r($data,true);
                $output .= '</pre></body></html>';
                break;

            case CMS_API_OUTPUT_YAML:
                header('Content-Type: application/yaml; charset=UTF-8');
                $output = \util\YAML::dump($data);
                break;
        }


        if (!headers_sent())
            // HTTP Spec:
            // Applications SHOULD use this field to indicate the transfer-length of the message-body, unless this is prohibited by the rules in section 4.4.
            //
            // And the overhead of Transfer-Encoding chunked is eliminated...
            header('Content-Length: ' . strlen($output));

        echo $output;
    }

    /**
     * Discovering the output-type for this API-request
     *
     * @return int constant of CMS_API_OUTPUT_*
     */
    private static function discoverOutputType()
    {
        $types = Http::getAccept();

        $reqOutput = @$_REQUEST['output'];

        if (in_array('application/php-array', $types) || $reqOutput == 'php-array')
            return CMS_API_OUTPUT_PHPARRAY;

        if (in_array('application/php-serialized', $types) || $reqOutput == 'php')
            return CMS_API_OUTPUT_PHPSERIALIZE;

        if (in_array('application/json', $types) || $reqOutput == 'json')
            return CMS_API_OUTPUT_JSON;

        if (in_array('application/xml', $types) || $reqOutput == 'xml')
            return CMS_API_OUTPUT_XML;

        if (in_array('application/yaml', $types) || $reqOutput == 'yaml')
            return CMS_API_OUTPUT_YAML;

        if (in_array('text/html', $types))
            return CMS_API_OUTPUT_HTML;  // normally an ordinary browser.

        return CMS_API_OUTPUT_YAML;
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
        if   ( $e->getPrevious() != null )
            $data['previous'] = API::exceptionToArray($e->getPrevious() );

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
