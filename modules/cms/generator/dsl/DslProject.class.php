<?php

namespace cms\generator\dsl;

use cms\model\Folder;
use cms\model\Project;

class DslProject implements \dsl\context\DslObject
{
	private $project;

	public $id;
	public $url;
	public $name;

	/**
	 * DslPage constructor.
	 * @param Project $project
	 */
	public function __construct($project)
	{
		$this->project = $project;

		$this->id   = $project->getId();
		$this->name = $project->name;
		$this->url  = $project->url;
	}

	/**
	 * @return array
	 * @throws \util\exception\ObjectNotFoundException
	 */
	public function languages() {

		return array_map( function( $language ) {
			return get_object_vars($language);
		} ,$this->project->getLanguages() );
	}

	/**
	 * @return array
	 * @throws \util\exception\ObjectNotFoundException
	 */
	public function models() {

		return array_map( function($model ) {
			return get_object_vars($model);
		} ,$this->project->getModels() );
	}

	/**
	 * @return DslObject
	 * @throws \util\exception\ObjectNotFoundException
	 */
	public function root() {

		$oid = $this->project->getRootObjectId();
		$folder = new Folder( $oid );
		return new DslObject( $folder->load() );
	}

}