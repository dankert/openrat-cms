<?php

namespace cms\output;

use BadMethodCallException;
use cms\action\RequestParams;
use cms\base\Configuration;use cms\base\Language as L;
use cms\base\Startup;use cms\Dispatcher;
use cms\output\BaseOutput;
use Exception;
use template_engine\engine\TemplateRunner;
use util\Http;
use logger\Logger;
use LogicException;
use \util\exception\ObjectNotFoundException;
use util\exception\UIException;
use util\exception\SecurityException;
use template_engine\engine\TemplateEngine;
use util\Request;use util\Session;use util\text\TextMessage;


/**
 * The HTML output is calling a template for the user interface.
 */
class UIOutput extends BaseOutput
{
    /**
     * Preparing the client...
     */
    protected  function beforeAction($request)
	{
		// Sending the Content-Security-Policy.
		self::setContentSecurityPolicy();

		if   ( @$_REQUEST['scope']=='openid' ) {
			$request->redirectActionAndMethod('login','oidc');
		}
		elseif (empty($request->action)) {
			$request->redirectActionAndMethod('index','show' );
		}

		if   ( $request->isAction )
			throw new \RuntimeException('The HTML output driver does not accept POST requests');

    }



    protected function outputData($request, $data)
    {
        // The action is able to change its method and action name.
        $subaction = $request->method;
        $action    = $request->action;


        $this::outputTemplate($request,$action, $subaction, $data['output'] );
    }



	/**
	 * Sets the timezone so that dates in the UI are displayed in the correct timezone.
	 */
	protected static function setTimezone() {

		if   ( $timezone = self::getCustomTimezone() ) {

			date_default_timezone_set( $timezone );

			if   ( DEVELOPMENT )
				header('X-OR-custom-timezone: '.$timezone );
		}

		// Default: Unchanged, so /etc/timezone or /etc/localtime is used by PHP.
	}


	/**
	 * Gets the custom timezone of the user or the configured timezone.
	 */
	protected static function getCustomTimezone() {

		$user = Request::getUser(); // the user timezone has precedence.
		if   ( $user && $user->timezone && in_array( $user->timezone,timezone_identifiers_list() ) ) // user is set and a timezone is set and timezone is valid
			return( $user->timezone ); // Timezone from user setting
		elseif ( $configuredTimezone = Configuration::subset('ui')->get('timezone') )
			return $configuredTimezone; // Timezone from configuration

		return  null;
	}


	/**
	 * Executes and outputs an HTML template.
	 *
	 * @param $request RequestParams
	 * @param $action string action
	 * @param $subaction string method
	 * @param $outputData array Output data
	 */
    private static function outputTemplate($request, $action, $subaction, $outputData)
    {
		$outputData += [
			// the following special data is used in FormComponent for filling the form.
			'_id'    => $request->id,
			'_token' => Session::token(),
		];

        $templateFile = Startup::MODULE_DIR . 'cms/ui/themes/default/html/views/' . $action.'/'.$subaction . '.php';

		self::setTimezone();

		if   ( DEVELOPMENT ) {
			header('X-OR-Template: '.$templateFile               );

			$outputDataClone = $outputData;
			array_walk_recursive($outputDataClone, function(&$v) { $v = htmlspecialchars($v); });
			//array_walk_recursive($outputDataClone, function(&$v) { if(is_string($v)) $v = htmlspecialchars($v); });
			echo "<!--  \n".var_export($outputDataClone,true)."\n-->";
		}

        $engine = new TemplateRunner();
        //$engine->request = $request;
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


	/**
	 * @param $text
	 * @param $cause Exception the cause, or <code>null</code> if not available.
	 */
	protected function setError($text, $cause)
	{
		if ( !headers_sent() )
			// The following HTML contains inline CSS code, so we have to allow inline CSS.
			header('Content-Security-Policy: style-src: inline; default: self');

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title><?php echo $text ?></title>
    <style type="text/css">

        header, main {
            display: block
        }

        body {
            width: 100%;
            height: 100%;
            background-color: rgba(13,8,5,0.58);
            color: white;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            line-height: 1.4;
            font-size: 1.5em;
            text-align: center;
        }

        pre {
            margin:10%;
            width: 80%;
            overflow: visible;
            height: 40%;
            color: silver;
            text-align: left;
            font-size: 0.6rem;
        }

        h1 {
            font-size: 2em;
        }
</style>
</head>
<body>

<header>
    <h1 id="cms-error-message"><?php echo $text ?></h1>
</header>

<main>
    <p>Something went terribly wrong &#x1F61E;</p>

    <pre id="cms-error-log"><?php // Display exceptions only in development mode, because they may contain sensitive internal information like passwords.
      if ($cause) {
		if (defined('DEVELOPMENT') && DEVELOPMENT  ) {
		  echo $cause->__toString();
		}
		else {
			while (true) {
				echo($cause->getMessage());
				$previous = $cause->getPrevious();
				if ($previous) {
					echo "\n\n" . 'Caused by:'."\n";
					$cause = $previous;
				} else
					break;
			}
		}
	  }
    ?></pre>
</main>

</body>
</html><?php

	}

	public function getContentType()
	{
		return 'text/html';
	}
}
