<?php

namespace dsl\ast;

class DslFunctionCall implements DslStatement
{
	private $statements;
	public $name;

	public function execute( $context ) {

		//echo "ausführen function"; echo "<pre>"; var_dump($this); echo "</pre>";
		//var_dump($this->name);
		//echo "<pre>"; var_dump($context); echo "</pre>";
		$function = @$context[$this->name];
		if   ( $function instanceof \dsl\context\DslFunction )
			$function->execute( $this->statements[0]->value );
		//else
			//throw new \Exception('function \''.$this->name.'\' not found.');
	}

	public function parse($tokens)
	{
		$this->statements[] = $tokens;
	}
}