<?php

namespace cms\generator;


use cms\generator\link\PreviewLink;
use cms\generator\link\PublicLink;
use cms\model\BaseObject;
use cms\model\File;
use cms\model\Page;

class Producer {

	public $objectid;

	public $languages;
	public $models;

	const SCHEME_PREVIEW = 1;
	const SCHEME_EDIT    = 2;
	const SCHEME_PUBLIC  = 3;


	/**
	 * @var \util\cache\FileCache
	 */
	private $cache;


	/**
	 * @param $object BaseObject
	 * @param $scheme
	 * @throws \ObjectNotFoundException
	 */
	public function generate( $object,$scheme ) {

		$project = $object->getProject();

		if   ( $this->languages )
			$languages = $this->languages;
		else
			$languages = $project->getLanguageIds();

		if   ( $this->models )
			$models = $this->models;
		else
			$models = $project->getModelIds();


		if   ( $object instanceof File ) {

			$fileContext = new FileContext($object->objectid, $scheme);

			$generator = new FileGenerator( $fileContext);
		}

		if   ( $object instanceof Page ) {

			foreach( $models as $model ) {

				foreach ( $languages as $language ) {
					$pageContext = new PageContext( $object->objectid,$scheme);
					$pageContext->modelId    = $model;
					$pageContext->languageId = $language;

					$generator = new PageGenerator( $pageContext );
				}
			}
		}

		$this->cache = $generator->getCache();
	}


	public function getValue() {
		return $this->cache->get();
	}


	public function getCache() {
		return $this->cache;
	}


	public function publish() {
		$publisher = new Publisher( );
		$publisher->publish( $this->cache->getFilename(), $this->filename, time() );
	}



}