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
 * Template context
 *
 * @author Jan Dankert
 */
class TemplateContext
{
	public $action;

	public $subaction;

	public $id;
}