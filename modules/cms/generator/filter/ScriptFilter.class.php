<?php


namespace cms\generator\filter;


use cms\generator\dsl\CMSDslInterpreter;
use dsl\DslException;
use util\exception\GeneratorException;
use util\Text;

class ScriptFilter extends AbstractFilter
{
	public $script;

	public function filter( $value )
	{
		$interpreter = new CMSDslInterpreter();
		$interpreter->setContext( $this->context );
		$interpreter->setValue( $value );

		try {
			$interpreter->runCode( $this->script );
			return $interpreter->getOutput();
		}
		catch( DslException $e ) {
			throw new GeneratorException('Script error in filter script'."\n".Text::makeLineNumbers($this->script),$e);
		}
	}
}