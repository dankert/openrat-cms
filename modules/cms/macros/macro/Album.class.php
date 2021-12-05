<?php
namespace cms\macros\macro;
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
use cms\model\BaseObject;
use cms\model\File;
use cms\model\Folder;
use cms\model\Image;
use util\Macro;


/**
 * Erzeugt eine Bilder-Liste.
 * 
 * Die Ordner-Id kann als Parameter "folderid" übergeben werden.
 * Falls nicht, wird der aktuelle Ordner, in dem sich die Seite
 * befindet, benutzt.
 * 
 * Es wird eine Definitionsliste mit der CSS-Klasse "album" erzeugt, damit
 * bequem eine Auszeichnung per CSS erfolgen kann. 
 * 
 * Beispiel:
 * <dl class="album">
 *   <dt><img src="bild.jpg" width=".." .. /></dt>
 *   <dd>Beschreibung</dd>
 * </dl>
 * 
 * @author Jan Dankert
 */
class Album extends Macro
{

	/**
	 * Bitte immer eine Beschreibung benutzen, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	public $description = 'Creates an album.';

	public $folderid = 0;

	public $withImages = true;
	public $withFiles = false;

	/**
	 */
	public function execute()
	{
		if	( intval($this->folderid)!=0 )
			$folderid = $this->folderid;
		else
			$folderid = $this->page->parentid;

		$f     = new Folder($folderid);
		$files =  $f->getObjectIdsByType(BaseObject::TYPEID_IMAGE);

		$this->output('<dl class="album">');
		
		foreach( $files as $fileid )
		{
			$file = new Image($fileid);
			$file->load();
			
			$file->getImageSize();
			$img = '<img src="'.$this->pathToObject($fileid).'" alt="'.$file->getNameForLanguage( $this->pageContext->languageId )->name.'" width="'.$file->width.'" height="'.$file->height.'" />';
			$this->output('<dt>'.$img.'</dt><dd>'.$file->getNameForLanguage( $this->pageContext->languageId )->description.'</dd>');

		}
		
		$this->output('</dl>');
	}

}

?>