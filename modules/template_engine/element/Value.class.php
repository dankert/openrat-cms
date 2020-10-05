<?php

namespace template_engine\element;

use template_engine\engine\TemplateEngine;
use util\text\variables\VariableResolver;

class Value
{
    private $value;
    private $expressions = [];

    const CONTEXT_PHP = 0;
    const CONTEXT_HTML = 1;
    const CONTEXT_RAW = 2;


	/**
	 * @param int $type a type from ValueExpression
	 * @param string $name
	 * @return string
	 */
    public static function createExpression($type, $name)
    {
    	$expr = new ValueExpression($type,$name,0);
        return $expr->getAsString();
    }

    public function __construct($value)
    {
    	if   ( $value instanceof ValueExpression )
		{
			$value = $value->getAsString();
		}

		$this->value = $value;
    }


    public function render($context)
    {
    	$res = new VariableResolver();
    	$res->namespaceSeparator = ':';
    	$res->defaultSeparator   = '?';

    	$res->addDefaultResolver( function($name) {
			$parts = explode('.', $name);

			return '\'.'.array_reduce($parts, function ($carry, $item) {
				if (!$carry)
					return '@$' . $item;
				else
					return $carry . '[\''.$item.'\']';
			}, '').'.\'';
		});

		$res->addResolver( 'message',function($name) {

			return '\'.@'.TemplateEngine::OUTPUT_ALIAS.'::lang(\'' . $name . '\').\'';
		});

		$res->addResolver('config', function($name) {
			$config_parts = explode('/', $name);
			return '\'.'.TemplateEngine::OUTPUT_ALIAS.'::config(' . "'" . implode("'" . ',' . "'", $config_parts) . "'" . ').\'';
		});


        switch ($context) {
            case Value::CONTEXT_PHP:
				$escape = function ($expr) use ($context) {
					return $expr;
				};
				break;

            case Value::CONTEXT_HTML:
				$escape = function ($expr) use ($context) {
						return TemplateEngine::OUTPUT_ALIAS.'::escapeHtml(' . $expr . ')';
				};
				break;
			case Value::CONTEXT_RAW:
				$escape = function ($expr) use ($context) {
					return $expr;
				};
				break;
        }

        if   ( $context == self::CONTEXT_PHP ) {
			return '\''.$res->resolveVariables( $this->value ).'\'';

		} else {

			$this->value = str_replace('\'','\\\'',$this->value);
			return '<'.'?'.'php '.'echo '. $escape('\''.$res->resolveVariables( $this->value ).'\'').' ?'.'>';
		}
    }

    public function __xtoString()
	{
		return print_r($this,true);
	}
}