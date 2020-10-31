<?php


namespace template_engine\element;


use template_engine\engine\TemplateEngine;
use util\text\variables\VariableResolver;

class PHPBlockElement extends HtmlElement
{
	public $beforeBlock;
	public $inBlock;

	public function __construct()
	{
		parent::__construct( null );
	}


	/**
	 * @param $format XMLFormatter
	 * @return string
	 */
	public function render($format )
	{
		$content = $format->getIndentation();

		$content .= '<?php '.$this->beforeBlock.' { '.$this->inBlock.' ?>';

		$content .= $this->renderChildren( $format );

		$content .= $format->getIndentationOnClose();
		$content .= ' <?php } ?>';

		return $content;
	}





	public function textasvarname($value)
	{
		return $this->value($value);
	}


	public function varname($value)
	{
		return $this->value($value);
	}



	public static function value( $value )
	{
		$res = new VariableResolver();
		$res->namespaceSeparator = ':';
		$res->renderOnlyVariables = true;

		$res->addDefaultResolver( function($var) {
			return '$'.$var;
		} );

		$res->addResolver('config', function($name) {
			$config_parts = explode('/', $name);
			return TemplateEngine::OUTPUT_ALIAS.'::config([' . "'" . implode("'" . ',' . "'", $config_parts) . "'" . '])';
		});

		return $res->resolveVariables( $value );
	}


	public function includeResource($file )
	{
		return "include_once( 'modules/template_engine/components/html/component_".$file."');";
	}

}