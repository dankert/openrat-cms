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
use cms\model\Folder;
use cms\model\Link;
use cms\model\Page;
use cms\model\Project;
use util\Macro;
use util\Text;


/**
 * Erstellen einer Teaser-Liste.
 *
 * @author Jan Dankert
 */
class LastChanges extends Macro
{
	var $title_html_tag        = 'h3';
	var $css_class             = 'macro-lastchanges';
	var $teaserElementId       = '';
	var $teaserMaxLength       = 100;
	var $plaintext             = 'true';
	var $linktitle             = 'true';
	var $linktext              = 'true';
	var $timeelementid         = 0;
	var $folderid              = 0;
	var $showPages             = true;
	var $showLinks             = false;
	var $includeTemplateIds    = array();
	var $excludeTemplateIds    = array();
	var $limit                 = -1;
	
	/**
	 * Bitte immer eine Beschreibung benutzen, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $description = 'Creates a teaser list of pages in a folder';

	// 
	function execute()
	{
		if	( $this->folderid === 'self' )
		{
			$page = $this->getPage();
			$page->load();
			$folderid = $page->parentid;
			$f = new Folder( $folderid );
			$changes = $f->getLastChanges();
		}
		elseif	( $this->folderid > 0 )
		{
			$f = new Folder( $this->folderid );
			$changes = $f->getLastChanges();
		}
		else
        {
            $project = new Project( $this->page->projectid );
            $changes = $project->getLastChanges();
        }

				
		$count = 0;
		
		foreach( $changes as $o )
		{
			if ($o['objectid'] == $this->getObjectId() )
				continue;
			
			if	( ($o['typeid']==BaseObject::TYPEID_PAGE && istrue($this->showPages)) ||
				  ($o['typeid']==BaseObject::TYPEID_LINK && istrue($this->showLinks))  ) // Nur wenn gewünschter Typ
			{
				if	( $o['typeid']==BaseObject::TYPEID_LINK ) {
					$l = new Link( $o['objectid'] );
					$l->load();

					$p = new Page( $l->linkedObjectId );
				}
				elseif ( $o['typeid']==BaseObject::TYPEID_PAGE )
				{
					$p = new Page( $o['objectid'] );
				}
				else
					continue;
				
				$p->load();

				// Template zulässig?
				if	( !empty($this->includeTemplateIds) )
					if	( !in_array($p->templateid,$this->includeTemplateIds))
						continue;
				
				// Template zulässig?
				if	( !empty($this->excludeTemplateIds) )
					if	( in_array($p->templateid,$this->excludeTemplateIds))
						continue;
				
				$count++;
				if	( $this->limit >= 0 && $count > $this->limit)
					break; // Maximale Anzahl erreicht.
				
				$desc = $p->desc;
				$p->generate_elements();
				
				if	( !empty($this->teaserElementId) )
				{
					$value = $p->values[$this->teaserElementId];
					$desc = $value->value;
					if	( istrue($this->plaintext)  )
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
					$value = $p->values[$this->timeelementid];
					$time = $value->value;
				}

				$this->output('<div class="'.$this->css_class.'">');
				
				if	( istrue($this->linktitle) )
				{
					$url = $this->pathToObject($o['objectid']);
					$this->output( '<a href="'.$url.'"><div>' );
				}
				
				$this->output('<h6>'.$time.'</h6>');
				
				
				$this->output( '<h3>');
				$this->output( $p->name );
				$this->output( '</h3>' );
					
				$this->output( '<p>' );
				$this->output( $desc );
				$this->output( '</p>'   );
				
				if	( istrue($this->linktitle) )
				{
					$this->output( '</div></a>' );
				}
						
				$this->output( '</div>' );
			}
		}
	}
}