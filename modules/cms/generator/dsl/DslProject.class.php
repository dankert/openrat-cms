<?php

namespace cms\generator\dsl;

use cms\model\Folder;
use cms\model\Page;
use cms\model\Project;
use dsl\context\DslObject;

class DslProject implements DslObject
{
	private $project;

	public $id;

	/**
	 * DslPage constructor.
	 * @param Project $project
	 */
	public function __construct($project)
	{
		$this->project = $project;

		$this->id = $project->getId();
	}

	/**
	 * @return array
	 * @throws \util\exception\ObjectNotFoundException
	 */
	public function languages() {
		return $this->project->getLanguages();
	}
	/**
	 * @return array
	 * @throws \util\exception\ObjectNotFoundException
	 */
	public function models() {
		return $this->project->getLanguages();

	}
	/**
	 * @return DslObject
	 * @throws \util\exception\ObjectNotFoundException
	 */
	public function root() {
		$oid = $this->project->getRootObjectId();
		$folder = new Folder( $oid );
		$folder->load();
		return new \cms\generator\dsl\DslObject( $folder );
	}

}