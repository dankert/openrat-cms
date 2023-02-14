<?php


namespace cms\generator\filter;


use cms\generator\dsl\DslCms;
use cms\generator\dsl\DslConsole;
use cms\generator\dsl\DslHttp;
use cms\generator\dsl\DslJson;
use cms\generator\dsl\DslObject;
use cms\generator\dsl\DslPageContext;
use cms\generator\dsl\DslProject;
use cms\model\BaseObject;
use dsl\DslException;
use dsl\executor\DslInterpreter;
use logger\Logger;
use util\exception\GeneratorException;
use util\Text;

class ScriptFilter extends AbstractFilter
{
	public $script;

	public function filter( $value )
	{
		$interpreter = new DslInterpreter(DslInterpreter::FLAG_THROW_ERROR + DslInterpreter::FLAG_SECURE );

		$interpreter->addContext( [
			'project'  => new DslProject( (new BaseObject($this->context->getObjectId()))->load()->getProject() ),
			'console'  => new DslConsole(),
			'cms'      => new DslCms(),
			'value'    => $value,
			'http'     => new DslHttp(),
			'json'     => new DslJson(),
		]);

		try {
			$interpreter = new DslInterpreter(DslInterpreter::FLAG_THROW_ERROR + DslInterpreter::FLAG_SECURE);
			$interpreter->runCode( $this->script );
			return $interpreter->getOutput();
		}
		catch( DslException $e ) {
			throw new GeneratorException('Script error in filter script'."\n".Text::makeLineNumbers($this->script),$e);
		}
	}
}