<?php

namespace cms\output;

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
 */
interface Output
{
    /**
     * Rendering output.
     */
    public function execute();

	/**
	 * Gets the content type.
	 *
	 * @return string
	 */
	public function getContentType();
}
