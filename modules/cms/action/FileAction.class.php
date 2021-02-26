<?php

namespace cms\action;

use cms\base\Configuration;
use cms\generator\FileContext;
use cms\generator\FileGenerator;
use cms\generator\Producer;
use cms\generator\Publisher;
use cms\generator\PublishOrder;
use cms\model\BaseObject;
use cms\model\File;
use cms\model\Folder;
use util\exception\ValidationException;
use util\Html;
use util\Upload;

// OpenRat Content Management System
// Copyright (C) 2002-2012 Jan Dankert, cms@jandankert.de
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
 * Action-Klasse zum Bearbeiten einer Datei
 *
 * @author Jan Dankert
 */
class FileAction extends ObjectAction
{
	public $security = Action::SECURITY_USER;

    /**
     * @var File
     */
	protected $file;

	/**
	 * Konstruktor
	 */
	function __construct()
    {
        parent::__construct();
    }


    public function init()
    {
		$file = new File( $this->request->getId() );
		$file->languageid = $this->request->getLanguageId();
		$file->load();

        $this->setBaseObject( $file );
	}


	protected function setBaseObject( $file ) {
		$this->file = $file;

		parent::setBaseObject( $file );
	}


	protected function getCompressionTypes()
	{
		$compressionTypes = array();
		if	( function_exists('gzencode'    ) ) $compressionTypes[] = 'gz';
		//if	( function_exists('gzencode'    ) ) $compressionTypes[] = 'zip';
		if	( function_exists('bzipcompress') ) $compressionTypes[] = 'bz2';
		return $compressionTypes;
	}

	protected function getArchiveTypes()
	{
		$archiveTypes = array();
		$archiveTypes[] = 'tar';
		$archiveTypes[] = 'zip';
		return $archiveTypes;
	}

}