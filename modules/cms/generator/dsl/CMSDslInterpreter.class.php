<?php

namespace cms\generator\dsl;

use cms\generator\BaseContext;
use cms\generator\PageContext;
use cms\model\BaseObject;
use dsl\context\BaseScriptableObject;
use dsl\executor\DslInterpreter;

class CMSDslInterpreter extends DslInterpreter
{
	public function __construct()
	{
		parent::__construct( DslInterpreter::FLAG_THROW_ERROR + DslInterpreter::FLAG_SECURE );


		$this->addContext( [
			'console'  => new DslConsole(),
			'cms'      => new DslCms(),
			'http'     => new DslHttp(),
			'json'     => new DslJson(),
			'Pdf'      => function() { return new DslPdf(); },
			'Mqtt'     => new class extends BaseScriptableObject {
				public static function open( $url,$user,$password ) {
					return new DslMqtt( $url,$user,$password );
				}
			}
		]);
	}

	/**
	 * @param $pageContext PageContext
	 * @return void
	 * @throws \util\exception\ObjectNotFoundException
	 */
	public function setPageContext( $pageContext ) {

		$this->addContext( [
			'page'     => new DslObject( (new BaseObject($pageContext->objectId))->load() ),
			'context'  => new DslPageContext( $pageContext ),
			'project'  => new DslProject( (new BaseObject($pageContext->objectId))->load()->getProject() ),
		]);
	}

	/**
	 * @param $context BaseContext
	 * @return void
	 * @throws \util\exception\ObjectNotFoundException
	 */
	public function setContext( $context ) {

		$this->addContext( [
			'object'   => new DslObject( (new BaseObject($context->getObjectId()))->load() ),
			'project'  => new DslProject( (new BaseObject($context->getObjectId()))->load()->getProject() ),
		]);
	}


	public function setValue( $value ) {

		$this->addContext( [
			'value'    => $value,
		]);
	}
}