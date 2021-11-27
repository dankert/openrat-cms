<?php

namespace cms\action;

namespace cms\action;
use cms\model\Content;
use cms\model\Folder;
use cms\model\Permission;
use cms\model\Element;
use cms\model\Page;
use cms\model\Project;
use cms\model\Template;
use cms\model\TemplateModel;
use cms\model\Value;
use language\Messages;
use util\exception\SecurityException;
use util\exception\ValidationException;
use util\Html;
use util\Session;


// OpenRat Content Management System
// Copyright (C) 2002-2009 Jan Dankert
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

/**
 * Action-Klasse zum Bearbeiten einer Seitenvorlage.
 * 
 * @author Jan Dankert
 * @package openrat.actions
 */

class TemplateAction extends BaseAction
{
    /**
     * @var Template
     */
	protected $template;
	private $element;


	function __construct()
	{
        parent::__construct();

    }


    public function init()
    {
		$this->template = new Template( $this->request->getId() );

		$this->template->load();

		$this->setTemplateVar( 'templateid',$this->template->templateid );

		if	( intval($this->request->getText('elementid')) != 0 )
		{
			$this->element = new Element( $this->request->getText('elementid') );
			$this->element->load();
			$this->setTemplateVar( 'elementid',$this->element->elementid );
		}
	}




	/**
	 * User must be an project administrator.
	 */
	public function checkAccess() {
		$project      = new Project( $this->template->projectid );
		$rootFolderId = $project->getRootObjectId();

		$rootFolder = new Folder( $rootFolderId );
		$rootFolder->load();

		if   ( ! $rootFolder->hasRight( Permission::ACL_PROP )  )
			throw new SecurityException();
	}


	protected function getTemplateModels()
	{
		$project = new Project($this->template->projectid);
		$versions = [];

		$templatemodels = [];
		foreach ($project->getModels() as $modelId => $modelName) {
			$templatemodels[] = new TemplateModel($this->template->templateid, $modelId);
		}

		return $templatemodels;
	}



	protected function ensureValueIdIsInAnyTemplate( $valueId ) {

		$versions = [];

		foreach( $this->getTemplateModels() as $templateModel )
		{
			$templateModel->load();

			$content = new Content( $templateModel->getContentid() );

			$versions = array_merge( $versions, $content->getVersionList() );
		}

		if   ( ! in_array( $valueId, $versions ))
			throw new SecurityException( 'value-id is not contained in the version list of this file' );
	}
}