<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// OpenRat Content Management System
// Copyright (C) 2002 Jan Dankert, jandankert@jandankert.de
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
// ---------------------------------------------------------------------------
// $Log$
// Revision 1.2  2005-01-04 19:59:55  dankert
// Allgemeine Korrekturen, Erben von "Dynamic"-klasse
//
// Revision 1.1  2004/11/10 22:43:35  dankert
// Beispiele fuer dynamische Templateelemente
//
// ---------------------------------------------------------------------------
use cms\model\Object;


/**
 * Erstellen eines Links.
 * 
 * @author Jan Dankert
 */
class NextPage extends Macro
{
	public $targetid = 0;
	public $classes = '';
	public $name = '';
	public $title = '';
	
	function execute()
	{
		// Lesen des Ordners
		$o = new Object( $this->targetid );
		$o->load();
		
		if	( empty($this->name ) ) $this->name  = $o->name;
		if	( empty($this->title) ) $this->title = $o->description;

		$this->output( '<a href="'.$this->pathToObject($this->targetid).' title="'.$this->title.'" class="'.$this->classes.'">'.$this->name.'</a>' );
	}
}