<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// OpenRat Content Management System
// Copyright (C) 2002-2004 Jan Dankert, cms@jandankert.de
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
// Revision 1.15  2007-05-21 20:04:10  dankert
// Korrektur f?r Anzeige des Vorlagen-Quelltextes.
//
// Revision 1.14  2007-04-08 21:33:42  dankert
// Bei Ausw?hlen einer Vorlage die Elementliste starten.
//
// Revision 1.13  2007/03/11 00:27:12  dankert
// Beim Ausw?hlen einer Vorlage aus der Liste diese sofort anzeigen.
//
// Revision 1.12  2006/01/29 17:18:59  dankert
// Steuerung der Aktionsklasse ?ber .ini-Datei, dazu umbenennen einzelner Methoden
//
// Revision 1.11  2006/01/23 23:10:46  dankert
// *** empty log message ***
//
// Revision 1.10  2005/11/07 22:32:20  dankert
// Neue Methode "edit()"
//
// Revision 1.9  2005/01/05 23:11:14  dankert
// Nach hinzuf?gen von Elementen nicht speichern
//
// Revision 1.8  2004/12/27 23:34:51  dankert
// Aenderung Konstruktor
//
// Revision 1.7  2004/12/19 15:17:11  dankert
// div. Korrekturen
//
// Revision 1.6  2004/12/15 23:25:13  dankert
// Sprachvariablen korrigiert
//
// Revision 1.5  2004/09/30 20:31:19  dankert
// Auch leere Extension speichern
//
// Revision 1.4  2004/07/09 20:57:29  dankert
// Dynamische Bereiche (IFEMPTY...)
//
// Revision 1.3  2004/05/07 21:34:58  dankert
// Url ?ber Html::url erzeugen
//
// Revision 1.2  2004/05/02 14:49:37  dankert
// Einf?gen package-name (@package)
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------

/**
 * Action-Klasse zum Bearbeiten einer Seitenvorlage
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class TemplateAction extends Action
{
	var $defaultSubAction = 'show';
	var $template;
	var $element;


	function TemplateAction()
	{
		if	( $this->getRequestId() != 0 )
		{
			$this->template = new Template( $this->getRequestId() );
			$this->template->load();
			$this->setTemplateVar( 'templateid',$this->template->templateid );
		}
		else
		{
			$this->defaultSubAction = 'listing';
		}

		if	( intval($this->getRequestVar('elementid')) != 0 )
		{
			$this->element = new Element( $this->getRequestVar('elementid') );
			$this->element->load();
			$this->setTemplateVar( 'elementid',$this->element->elementid );
		}
	}


	function savesrc()
	{
		// Speichern des Quelltextes
		//
		$text = $this->getRequestVar('src');
		
		foreach( $this->template->getElementNames() as $elid=>$elname )
		{
			$text = str_replace('{{'.$elname.'}}'  ,'{{'.$elid.'}}',$text );
			$text = str_replace('{{->'.$elname.'}}','{{->'.$elid.'}}',$text );
			$text = str_replace('{{'.lang('TEMPLATE_SRC_IFEMPTY'   ).':'.$elname.':'.lang('TEMPLATE_SRC_BEGIN').'}}','{{IFEMPTY:'   .$elid.':BEGIN}}',$text );
			$text = str_replace('{{'.lang('TEMPLATE_SRC_IFEMPTY'   ).':'.$elname.':'.lang('TEMPLATE_SRC_END'  ).'}}','{{IFEMPTY:'   .$elid.':END}}'  ,$text );
			$text = str_replace('{{'.lang('TEMPLATE_SRC_IFNOTEMPTY').':'.$elname.':'.lang('TEMPLATE_SRC_BEGIN').'}}','{{IFNOTEMPTY:'.$elid.':BEGIN}}',$text );
			$text = str_replace('{{'.lang('TEMPLATE_SRC_IFNOTEMPTY').':'.$elname.':'.lang('TEMPLATE_SRC_END'  ).'}}','{{IFNOTEMPTY:'.$elid.':END}}'  ,$text );
		}
	
		$this->template->src = $text;
		$this->template->save();
		$this->template->load();
	}




	function srcaddelement()
	{
		$text = $this->template->src;
	
		// Falls dieses Element hinzugef?gt werden soll
		if   ( $this->hasRequestVar('addelement') )
		{
			$text .= "\n".'{{'.$this->getRequestVar('elementid').'}}';
		}

		if   ( $this->hasRequestVar('addicon') )
		{
			$text .= "\n".'{{->'.$this->getRequestVar('iconid').'}}';
		}

		if   ( $this->hasRequestVar('addifempty') )
		{
			$text .= "\n".'{{IFEMPTY:'.$this->getRequestVar('ifemptyid').':BEGIN}}  {{IFEMPTY:'.$this->getRequestVar('ifemptyid').':END}}';
		}
		if   ( $this->hasRequestVar('addifnotempty') )
		{
			$text .= "\n".'{{IFNOTEMPTY:'.$this->getRequestVar('ifnotemptyid').':BEGIN}}  {{IFNOTEMPTY:'.$this->getRequestVar('ifnotemptyid').':END}}';
		}
		
		$this->template->src = $text;

		$this->template->save();
		$this->template->load();
	}


	// Speichern der Template-Eigenschaftens
	//
	function savename()
	{
		$this->template->name = $this->getRequestVar('name');
		$this->template->save();
	}


	// Speichern der Template-Eigenschaftens
	//
	function delete()
	{
		if   ( $this->getRequestVar('delete') != '' )
		{
			$this->template->delete();
		}
	}


	/**
	 * Entfernen der Vorlage
	 */
	function remove()
	{
	}


	// Speichern der Dateiendung
	//
	function saveextension()
	{
		$this->template->extension = $this->getRequestVar('extension');
		$this->template->save(); 
	}


	function addel()
	{
		// Die verschiedenen Element-Typen
		$types = array();

		foreach( Element::getAvailableTypes() as $t )
		{
			$types[ $t ] = lang('EL_'.$t);
		}

		// Code-Element nur fuer Administratoren (da voller Systemzugriff!)		
		if	( !$this->userIsAdmin() )
			unset( $types['code'] );
		
		$this->setTemplateVar('types',$types);
	}
	
	
	
	// Element hinzuf?gen
	//
	function addelement()
	{
		if  ( $this->getRequestVar('name') != '' )
		{
			$this->template->addElement( $this->getRequestVar('name'),$this->getRequestVar('description'),$this->getRequestVar('type') );
		}

		$this->setTemplateVar('tree_refresh',true);
	}


	function add()
	{
	}
	
	
	
	function addtemplate()
	{
		// Hinzuf?gen eines Templates
		if   ( $this->getRequestVar('name')  != '' )
		{
			Template::add( $this->getRequestVar('name') );
		}

		$this->setTemplateVar('tree_refresh',true);
	
		$this->callSubAction('listing');
	}

	
	function prop()
	{
	}
	
	
	
	/**
	 * Eigenschaften einer Vorlage anzeigen
	 */
	function name()
	{
		$this->setTemplateVar('name'     ,$this->template->name     );
		 
		// von diesem Template abh?ngige Seiten ermitteln
		//
		$list = array();
		foreach( $this->template->getDependentObjectIds() as $oid )
		{
			$page = new Page( $oid );
			$page->load();
			$list[$oid]         = array();
			$list[$oid]['name'] = $page->name;
			$list[$oid]['url' ] = Html::url( 'main','page',$oid );
		}
		$this->setTemplateVar('pages',$list );
	}



	/**
	 * Eigenschaften einer Vorlage anzeigen
	 */
	function extension()
	{
		$this->setTemplateVar('extension',$this->template->extension);
		 
	}



	/**
	 * Voransicht einer Vorlage
	 */
	function show()
	{
		$text = $this->template->src;
	
		foreach( $this->template->getElementIds() as $elid )
		{
			$element = new Element( $elid );
			$element->load();
			$url = Html::url( 'element','edit',$this->template->templateid,array('elementid'=>$elid));
			
			$text = str_replace('{{'.$elid.'}}',$element->name,
			                    $text );
			$text = str_replace('{{->'.$elid.'}}','',
			                    $text );

			$text = str_replace('{{IFEMPTY:'.$elid.':BEGIN}}','',
			                    $text );
			$text = str_replace('{{IFEMPTY:'.$elid.':END}}','',
			                    $text );

			$text = str_replace('{{IFNOTEMPTY:'.$elid.':BEGIN}}','',
			                    $text );
			$text = str_replace('{{IFNOTEMPTY:'.$elid.':END}}','',
			                    $text );
			                    
			unset( $element );
		}
	
		echo $text;
		
		exit();
	}


	/**
	 * Bearbeiten einer Vorlage
	 */
	function edit()
	{
		$text = htmlentities( $this->template->src );
		$text = str_replace("\n",'<br/>',$text);
	
		foreach( $this->template->getElementIds() as $elid )
		{
			$element = new Element( $elid );
			$element->load();
			$url = Html::url( 'element','name',$elid );
			
			$text = str_replace('{{'.$elid.'}}',
			                    '<a href="'.$url.'" class="el_'.
			                    $element->getTypeClass().'" target="cms_main_main" title="'.$element->desc.'">{{'.
			                    $element->name.'}}</a>',
			                    $text );
			$text = str_replace('{{-&gt;'.$elid.'}}',
			                    '<a href="'.$url.'" class="el_'.
			                    $element->getTypeClass().'" target="cms_main_main" title="'.$element->desc.'">{{-&gt;'.
			                    $element->name.'}}</a>',
			                    $text );

			$text = str_replace('{{IFEMPTY:'.$elid.':BEGIN}}',
			                    '<a href="'.$url.'" class="el_'.$element->getTypeClass().'" title="'.$element->desc.'">{{'.lang('TEMPLATE_SRC_IFEMPTY').':'.
			                    $element->name.':'.lang('TEMPLATE_SRC_BEGIN').'}}</a>',
			                    $text );
			$text = str_replace('{{IFEMPTY:'.$elid.':END}}',
			                    '<a href="'.$url.'" class="el_'.$element->getTypeClass().'" title="'.$element->desc.'">{{'.lang('TEMPLATE_SRC_IFEMPTY').':'.
			                    $element->name.':'.lang('TEMPLATE_SRC_END').'}}</a>',
			                    $text );

			$text = str_replace('{{IFNOTEMPTY:'.$elid.':BEGIN}}',
			                    '<a href="'.$url.'" class="el_'.$element->getTypeClass().'" title="'.$element->desc.'">{{'.lang('TEMPLATE_SRC_IFNOTEMPTY').':'.
			                    $element->name.':'.lang('TEMPLATE_SRC_BEGIN').'}}</a>',
			                    $text );
			$text = str_replace('{{IFNOTEMPTY:'.$elid.':END}}',
			                    '<a href="'.$url.'" class="el_'.$element->getTypeClass().'" title="'.$element->desc.'">{{'.lang('TEMPLATE_SRC_IFNOTEMPTY').':'.
			                    $element->name.':'.lang('TEMPLATE_SRC_END').'}}</a>',
			                    $text );
			                    
			unset( $element );
		}
	
		$this->setTemplateVar('text',$text);
		
		$this->forward('template_show');
	}


	// Anzeigen der Template-Elemente
	//
	function el()
	{
		global $conf_php;
		$list = array();
	
		foreach( $this->template->getElementIds() as $elid )
		{
			$element = new Element( $elid );
			$element->load();

			$list[$elid]         = array();
			$list[$elid]['url' ] = Html::url('element','name',$elid);
			$list[$elid]['name'] = $element->name;
			$list[$elid]['desc'] = $element->desc;
			$list[$elid]['type'] = $element->type;
			
			unset( $element );
		}
		$this->setTemplateVar('el',$list);	
	}



	function srcelement()
	{
		$elements            = array();
		$icon_elements       = array();
		$ifempty_elements    = array();
		$ifnotempty_elements = array();
	
		foreach( $this->template->getElementIds() as $elid )
		{
			$element = new Element( $elid );
			$element->load();

			$elements[$elid] = $element->name;

			if	( $element->isWritable() )
			{
				$icon_elements      [$elid] = lang('GLOBAL_icon'      ).' '.$element->name;
				$ifempty_elements   [$elid] = lang('TEMPLATE_SRC_ifempty'   ).' '.$element->name;
				$ifnotempty_elements[$elid] = lang('TEMPLATE_SRC_ifnotempty').' '.$element->name;
			}
		}

		$this->setTemplateVar('elements'           ,$elements             );
		$this->setTemplateVar('icon_elements'      ,$icon_elements        );
		$this->setTemplateVar('ifempty_elements'   ,$ifempty_elements     );
		$this->setTemplateVar('ifnotempty_elements',$ifnotempty_elements  );
	}
	
	
	
	/**
	  * Anzeigen des Template-Quellcodes
	  */
	function src()
	{
		$text = $this->template->src;
	
		foreach( $this->template->getElementIds() as $elid )
		{
			$element = new Element( $elid );
			$element->load();

			$text = str_replace('{{'.$elid.'}}',
			                           '{{'.$element->name.'}}',
			                           $text );
			$text = str_replace('{{->'.$elid.'}}',
			                           '{{->'.$element->name.'}}',
			                           $text );
			$text = str_replace('{{IFEMPTY:'.$elid.':BEGIN}}',
			                           '{{'.lang('TEMPLATE_SRC_IFEMPTY').':'.$element->name.':'.lang('TEMPLATE_SRC_BEGIN').'}}',
			                           $text );
			$text = str_replace('{{IFEMPTY:'.$elid.':END}}',
			                           '{{'.lang('TEMPLATE_SRC_IFEMPTY').':'.$element->name.':'.lang('TEMPLATE_SRC_END').'}}',
			                           $text );
			$text = str_replace('{{IFNOTEMPTY:'.$elid.':BEGIN}}',
			                           '{{'.lang('TEMPLATE_SRC_IFNOTEMPTY').':'.$element->name.':'.lang('TEMPLATE_SRC_BEGIN').'}}',
			                           $text );
			$text = str_replace('{{IFNOTEMPTY:'.$elid.':END}}',
			                           '{{'.lang('TEMPLATE_SRC_IFNOTEMPTY').':'.$element->name.':'.lang('TEMPLATE_SRC_END').'}}',
			                           $text );
		}

		$this->setTemplateVar( 'src',$text );
	}


	// Anzeigen aller Templates
	//
	function listing()
	{
		global $conf_php;

		$list = array();
	
		foreach( Template::getAll() as $id=>$name )
		{
			$list[$id] = array();
			$list[$id]['name'] = $name;
			$list[$id]['url' ] = Html::url('main','template',$id,array(REQ_PARAM_TARGETSUBACTION=>'el'));
		}
		
//		$var['templatemodelid'] = htmlentities( $id   );
//		$var['text']            = htmlentities( $text );
		$this->setTemplateVar('templates',$list);
	}

}