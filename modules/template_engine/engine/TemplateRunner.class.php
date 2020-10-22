<?php


namespace template_engine\engine;
use DomainException;
use DOMDocument;
use DOMElement;
use Exception;
use LogicException;
use template_engine\element\XMLFormatter;
use template_engine\element\PHPBlockElement;
use template_engine\components\html\Component;
use template_engine\components\html\NativeHtmlComponent;

/**
 * Executes a template.
 *
 * @author Jan Dankert
 */
class TemplateRunner
{
	/**
	 * @var \cms\action\RequestParams
	 */
	public $request;

	/**
	 * Executes the required template and writes the output to standard-out..
	 *
	 * @param $templateFile string filename of template
	 * @param $outputData array output data
	 */
    public function executeTemplate($templateFile, $outputData)
    {
        if ( ! is_file($templateFile) )
            throw new LogicException("Template file '$templateFile' was not found.");

		// Extracting all output data into the actual context
        extract($outputData);

        // Include the template
        require_once($templateFile);
    }

}

