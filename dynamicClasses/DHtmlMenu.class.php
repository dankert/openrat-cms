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
// Revision 1.1  2005-01-04 20:00:12  dankert
// Darstellung eines DHTML-Menues
//
// Revision 1.2  2004/12/28 22:57:56  dankert
// Korrektur Vererbung, "api" ausgebaut
//
// Revision 1.1  2004/10/14 21:15:29  dankert
// Erzeugen und Anzeigen einer Sitemap
//
// ---------------------------------------------------------------------------



/**
 * Erstellen eines Menues
 * @author Jan Dankert
 */
class DHtmlMenu extends Dynamic
{
	/**
	 * Bitte immer alle Parameter in dieses Array schreiben, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $parameters  = Array(
		'beforeEntry'=>'Chars before an active menu entry'
		);

	/**
	 * Bitte immer eine Beschreibung benutzen, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $description = 'You *have to* include doiMenuDOM.js in the page!<br/>Put the code below in head section:<br/><tt>&lt;script type="text/javascript" src="{{your-elementname}}.js"&gt;&lt;/script&gt;</tt><br/>The file is distributed with OpenRat';


	var $position = 'relative';
	/*
       $menu.SetCorrection(0,0);
       $menu.SetCellSpacing(2);
       $menu.SetItemDimension(50,20);
       
       $menu.SetBackground('#990000','','','');
       //menu.SetShadow(true,'#B0B0B0',6);
       $menu.SetItemText('black','center','bold','','');
       $menu.SetItemBackground('#FFCCCC','','','');
       $menu.SetItemBorder(0,'buttonface','solid');
       $menu.SetItemTextHL('white','center','bold','','');
       $menu.SetItemBackgroundHL('','','','');
       $menu.SetItemBorderHL(0,'black','solid');
       $menu.SetItemTextClick('#990000','center','bold','','');
       $menu.SetItemBackgroundClick('white','','','');
       $menu.SetItemBorderClick(0,'black','solid');
       $menu.SetBorder(0,'navy','solid');
       
       $menu._pop.SetCorrection(3,0);
       $menu._pop.SetItemDimension(150,20);
       $menu._pop.SetPaddings(2);
       $menu._pop.SetBackground('#990000','','','');
       $menu._pop.SetSeparator(150,'center','black','');
       $menu._pop.SetExpandIcon(true,'++-',6);
       $menu._pop.SetBorder(0,'','');
       $menu._pop.SetShadow(true,'#E8E8E8',6);
       $menu._pop.SetDelay(500);
       $menu._pop.SetItemBorder(0,'','');
       $menu._pop.SetItemBorderHL(1,'#990000','solid');
       $menu._pop.SetItemPaddings(1);
       $menu._pop.SetItemPaddingsHL(0);
       $menu._pop.SetItemText('black','','bold','','');
       $menu._pop.SetItemTextHL('#990000','','bold','','');
       $menu._pop.SetItemBackground('#FFCCCC','','','');
       $menu._pop.SetItemBackgroundHL('white','','','');
      */
      
	/**
	 * Erstellen des DHTML-Menues
	 */
	function execute()
	{
		// Erstellen eines Untermenues
		
		// Ermitteln der aktuellen Seite
		$thispage = new Page( $this->getObjectId() );
		$thispage->load(); // Seite laden
		
		$this->outputLn('<script name="javascript" type="text/javascript">');
		$menu = 'menu'.$this->getRootObjectId();

		$this->outputLn("  var menu".$this->getRootObjectId()." = new TMainMenu('$menu','horizontal');");

		$ro = new Folder($this->getRootObjectId());
		$this->showFolder( $ro );

		$this->output("
       $menu.SetPosition('relative',0,0);
       $menu.SetCorrection(0,0);
       $menu.SetCellSpacing(2);
       $menu.SetItemDimension(50,20);
       
       $menu.SetBackground('#990000','','','');
       $menu.SetShadow(true,'#B0B0B0',6);
       $menu.SetItemText('black','center','bold','','');
       $menu.SetItemBackground('#FFCCCC','','','');
       $menu.SetItemBorder(0,'buttonface','solid');
       $menu.SetItemTextHL('white','center','bold','','');
       $menu.SetItemBackgroundHL('','','','');
       $menu.SetItemBorderHL(0,'black','solid');
       $menu.SetItemTextClick('#990000','center','bold','','');
       $menu.SetItemBackgroundClick('white','','','');
       $menu.SetItemBorderClick(0,'black','solid');
       $menu.SetBorder(0,'navy','solid');
       
       $menu._pop.SetCorrection(3,0);
       $menu._pop.SetItemDimension(150,20);
       $menu._pop.SetPaddings(2);
       $menu._pop.SetBackground('#990000','','','');
       $menu._pop.SetSeparator(150,'center','black','');
       $menu._pop.SetExpandIcon(true,'++-',6);
       $menu._pop.SetBorder(0,'','');
       $menu._pop.SetShadow(true,'#E8E8E8',6);
       $menu._pop.SetDelay(500);
       $menu._pop.SetItemBorder(0,'','');
       $menu._pop.SetItemBorderHL(1,'#990000','solid');
       $menu._pop.SetItemPaddings(1);
       $menu._pop.SetItemPaddingsHL(0);
       $menu._pop.SetItemText('black','','bold','','');
       $menu._pop.SetItemTextHL('#990000','','bold','','');
       $menu._pop.SetItemBackground('#FFCCCC','','','');
       $menu._pop.SetItemBackgroundHL('white','','','');
       $menu.Build();
");

		$this->outputLn('</script');
	}
	
	
	function showFolder( $fo )
	{
		foreach( $fo->getObjects() as $o )
		{
			if	( $o->isFolder )
			{	$nf = new Folder($o->objectid);
				$pl = $nf->getFirstPageOrLink();
				if	( is_object($pl) )
				{
					$this->outputLn(" var menu".$o->objectid." = new TPopMenu('".$o->name."','','a','".$this->pathToObject($pl->objectid)."','".$o->desc."');");
					$this->outputLn(" menu".$fo->objectid.".Add(menu".$o->objectid.");");
					$this->showFolder( $nf );
				}
			}

			if	( $o->isPage || $o->isPage )
			{
				$this->outputLn(" var menu".$o->objectid." = new TPopMenu('".$o->name."','','a','".$this->pathToObject($o->objectid)."','".$o->desc."');");
				$this->outputLn(" menu".$fo->objectid.".Add(menu".$o->objectid.");");
			}
		}
	}

}

?>