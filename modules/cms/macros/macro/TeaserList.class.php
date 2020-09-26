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
use cms\generator\ValueContext;
use cms\generator\ValueGenerator;
use cms\model\Folder;
use cms\model\Page;
use util\Macro;
use util\Text;


/**
 * Erstellen einer Teaser-Liste.
 *
 * @author Jan Dankert
 */
class TeaserList extends Macro
{
	var $folderid              = 0;
	var $title_html_tag        = 'h2';
	var $time_html_tag         = 'h6';
	var $title_css_class       = 'teaser';
	var $description_css_class = 'teaser';
	var $link_css_class        = 'teaser';
	var $teaserElementId       = '';
	var $teaserMaxLength       = 100;
	var $plaintext             = 'true';
	var $linktitle             = 'true';
	var $linktext              = 'true';
	var $timeelementid         = 0;
	
	/**
	 * Bitte immer eine Beschreibung benutzen, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $description = 'Creates a teaser list of pages in a folder';

	function execute()
	{
		$feed = array();

		// Lesen des Root-Ordners
		if	( intval($this->folderid) == 0 )
			$folder = new Folder( $this->getRootObjectId() );
		else
			$folder = new Folder( intval($this->folderid) );

		$folder->load();

		// Schleife ueber alle Inhalte des Root-Ordners
		foreach( $folder->getObjects() as $o )
		{
			if ( $o->isPage ) // Nur wenn Ordner
			{


				$p = new Page( $o->objectid );
				$p->load();
				
				$desc = $p->desc;

				if	( !empty($this->teaserElementId) )
				{
					$valueContext = new ValueContext( $this->pageContext );
					$valueContext->elementid = $this->teaserElementId;

					$value = new ValueGenerator($valueContext);


					$desc = $value->getCache()->get();

					if	( filter_var($this->plaintext,FILTER_VALIDATE_BOOLEAN)  )
					{
						$desc = strip_tags($desc);
						// Und nur wenn die Tags raus sind duerfen wir nun den Text kuerzen.
						// (sonst drohen offene Tags)
						if	( is_numeric($this->teaserMaxLength) && $this->teaserMaxLength > 0 )
							$desc = Text::maxLength($desc,$this->teaserMaxLength);
					}
				}

				$time = '';
				if	( !empty($this->timeelementid) )
				{
					$valueContext = new ValueContext( $this->pageContext );
					$valueContext->elementid = $this->timeelementid;

					$value = new ValueGenerator($valueContext);

					$time = $value->getCache()->get();
				}
				
				$this->output('<'.$this->time_html_tag.'>'.$time.'</'.$this->time_html_tag.'>');
				
				$url = $this->pathToObject($o->objectid);
				
				$this->output( '<'.$this->title_html_tag.' class="'.$this->title_css_class.'">');
				if	( filter_var($this->linktitle,FILTER_VALIDATE_BOOLEAN))
					$this->output( '<a href="'.$url.'">'.$p->name.'</a>' );
				else
					$this->output( $p->name );
				$this->output( '</'.$this->title_html_tag.'>' );
					
				$this->output( '<p class="'.$this->description_css_class.'">' );
				if	( filter_var($this->linktext,FILTER_VALIDATE_BOOLEAN) )
					$this->output( '<a href="'.$this->pathToObject($o->objectid).'">'.$desc.'</a>' );
				else
					$this->output( $desc );
					
				$this->output( '</p>' );
			}
		}
	}
}