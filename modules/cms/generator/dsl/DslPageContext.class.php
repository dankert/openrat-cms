<?php

namespace cms\generator\dsl;

use cms\generator\PageContext;
use cms\model\BaseObject;
use cms\model\Language;
use cms\model\Model;
use dsl\context\BaseScriptableObject;
use dsl\DslRuntimeException;

class DslPageContext  extends BaseScriptableObject
{
	private $pageContext;

	/**
	 * DslPageContext constructor.
	 * @param $pageContext PageContext
	 */
	public function __construct( $pageContext ) {

		$this->pageContext = clone $pageContext; // the original must no be changed

		$this->language = ( new Language( $pageContext->languageId ) )->load()->getName();
		$this->model    = ( new Model   ( $pageContext->modelId    ) )->load()->getName();
	}


	/**
	 * Language name.
	 * @var string
	 */
	public $language;


	/**
	 * Model name.
	 * @var string
	 */
	public $model;


	protected function getProject() {
		return (new BaseObject($this->pageContext->sourceObjectId))->load()->getProject();
	}

	public function setLanguage( $name ) {
		if   ( $languageId = array_search( $name,$this->getProject()->getLanguages() ) )
			$this->pageContext->languageId = $languageId;
		else
			throw new DslRuntimeException("language with name '".$this->language."' does not exist.");

	}


	public function setModel( $name ) {
		if   ( $modelId = array_search( $name,$this->getProject()->getModels() ) )
			$this->pageContext->modelId    = $modelId;
		else
			throw new DslRuntimeException("model with name '".$this->model."' does not exist.");
	}


	/**
	 * Creates a link to an object.
	 *
	 * @param $object DslObject
	 */
	public function linkTo( $object ) {

		$from = (new BaseObject( $this->pageContext->sourceObjectId ))->load();
		$to   = (new BaseObject( $object->id                        ))->load();
		return $this->pageContext->getLinkScheme()->linkToObject( $from, $to );
	}

}