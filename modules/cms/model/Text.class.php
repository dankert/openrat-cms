<?php
namespace cms\model;
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
 * Datei.
 *
 * @author Jan Dankert
 * @package openrat.objects
 */
class Text extends File
{
    /**
     * Konstruktor
     *
     * @param string $objectid
     */
	public function __construct( $objectid='' )
	{

        parent::__construct( $objectid );

        $this->isText = true;
        $this->isFile = false;
		$this->typeid = BaseObject::TYPEID_TEXT;
	}


	public function mimeType()
    {
        return 'text/plain';
    }
}

?>