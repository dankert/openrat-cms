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
// Revision 1.7  2004-12-19 15:17:11  dankert
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
		if	( $this->getRequestId() == 0 )
			die('no template-id available');

		$this->template = new Template( $this->getRequestId() );
		$this->template->load();
		$this->setTemplateVar( 'templateid',$this->template->templateid );

		if	( intval($this->getRequestVar('elementid')) != 0 )
		{
			$this->element = new Element( $this->getRequestVar('elementid') );
			$this->element->load();
			$this->setTemplateVar( 'elementid',$this->element->elementid );
		}
	}


	function srcsave()
	{
		// Speichern des Quelltextes
		//
		$text = $this->getRequestVar('src');
		
		// Falls dieses Element hinzugef?gt werden soll
		if   ( $this->getRequestVar('addelement') != '' )
		{
			$text .= "\n".'{{'.$this->getRequestVar('elementid').'}}';
		}

		if   ( $this->getRequestVar('addicon') != '' )
		{
			$text .= "\n".'{{->'.$this->getRequestVar('iconid').'}}';
		}

		if   ( $this->getRequestVar('addifempty') != '' )
		{
			$text .= "\n".'{{IFEMPTY:'.$this->getRequestVar('ifemptyid').':BEGIN}}  {{IFEMPTY:'.$this->getRequestVar('ifemptyid').':END}}';
		}
		if   ( $this->getRequestVar('addifnotempty') != '' )
		{
			$text .= "\n".'{{IFNOTEMPTY:'.$this->getRequestVar('ifnotemptyid').':BEGIN}}  {{IFNOTEMPTY:'.$this->getRequestVar('ifnotemptyid').':END}}';
		}
		
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

		// Wenn Element hinzugef?gt wurde, dann bleibt es beim Quelltext-Modus.
		// Sonst wird zur Anzeige umgeschaltet
	
		if   ( $this->getRequestVar('addelement'   ) != '' ||
		       $this->getRequestVar('addicon'      ) != '' ||
		       $this->getRequestVar('addifempty'   ) != '' ||
		       $this->getRequestVar('addifnotempty') != ''    )
		{
			$this->callSubAction('src');
		}
		else
		{
			$this->callSubAction('show');
		}
	}


	// Speichern der Template-Eigenschaftens
	//
	function propsave()
	{
		if   ( $this->getRequestVar('delete') != '' )
		{
			$this->template->delete();

			$this->callSubAction('listing');
		}
		else
		{
			$this->template->name        = $this->getRequestVar('name');
			$this->template->save();

			$this->callSubAction('show');
		}
	}


	// Speichern der Dateiendung
	//
	function extensionsave()
	{
		$this->template->extension = $this->getRequestVar('extension');
		$this->template->save(); 

		$this->callSubAction('show');
	}


	// Element hinzuf?gen
	//
	function addelement()
	{
		if  ( $this->getRequestVar('name') != '' )
		{
			$this->template->addElement( $this->getRequestVar('name') );
		}

		$this->setTemplateVar('tree_refresh',true);
	
		$this->callSubAction('el');
	}


	function add()
	{
		// Hinzuf?gen eines Templates
		if   ( $this->getRequestVar('name')  != '' )
		{
			Template::add( $this->getRequestVar('name') );
		}

		$this->setTemplateVar('tree_refresh',true);
	
		$this->callSubAction('listing');
	}


	/**
	 * Umbenennen des Elementes
	 */
	function elementrename()
	{
		if   ($this->getRequestVar('delete') != '')
		{
			$this->element->delete();
		}
		elseif ($this->getRequestVar('deletevalues') != '')
		{
			$this->element->deleteValues();
		}
		else
		{ 
			$this->element->name = $this->getRequestVar('name');
			$this->element->desc = $this->getRequestVar('desc');
	
			$this->element->save();
			$this->element->load();
		}
	
		$this->setTemplateVar('tree_refresh',true);
	
		$this->callSubAction('el');
	}


	/**
	 * Speichern der Element-Eigenschaften
	 */
	function elementsave()
	{
		global $conf;
		$ini_date_format = $conf['date_formats'];
	
		foreach( $this->element->getRelatedProperties() as $propertyName )
		{
			switch( $propertyName )
			{
				case 'dateformat':
					$this->element->dateformat   = $ini_date_format[$this->getRequestVar('dateformat')];
					break;

				case 'subtype':
					$this->element->subtype      = $this->getRequestVar('subtype');
					break;

				case 'defaultText':
					$this->element->defaultText  = $this->getRequestVar('default_text');
					break;

				case 'wiki':
					$this->element->wiki         = $this->getRequestVar('wiki') != '';
					break;

				case 'html':
					$this->element->html         = $this->getRequestVar('html') != '';
					break;

				case 'withIcon':
					$this->element->withIcon     = $this->getRequestVar('with_icon') != '';
					break;

				case 'allLanguages':
					$this->element->allLanguages = $this->getRequestVar('all_languages') != '';
					break;

				case 'writable':
					$this->element->writable     = $this->getRequestVar('writable') != '';
					break;

				case 'decimals':
					$this->element->decimals     = $this->getRequestVar('decimals');
					break;

				case 'decPoint':
					$this->element->decPoint     = $this->getRequestVar('dec_point');
					break;

				case 'thousandSep':
					$this->element->thousandSep  = $this->getRequestVar('thousand_sep');
					break;

				case 'folderObjectId':
					$this->element->folderObjectId  = $this->getRequestVar('folderobjectid'  );
					break;

				case 'defaultObjectId':
					$this->element->defaultObjectId = $this->getRequestVar('default_objectid');
					break;

				case 'code':
					$this->element->code          = $this->getRequestVar('code'            );
					break;
			}
		}
		$this->element->save();

		$this->callSubAction('el');
	}



	/**
	 * Eigenschaften einer Vorlage anzeigen
	 */
	function prop()
	{
		$this->setTemplateVar('extension',$this->template->extension);
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

		$this->forward('template_prop');
	}



	/**
	 * Anzeigen einer Vorlage
	 */
	function show()
	{
		global $conf_php;

		$text = htmlentities( $this->template->src );
		$text = str_replace("\n",'<br>',$text);
	
		foreach( $this->template->getElementIds() as $elid )
		{
			$element = new Element( $elid );
			$element->load();
			$url = Html::url( 'element','edit',$this->template->templateid,array('elementid'=>$elid));
			
			$text = str_replace('{{'.$elid.'}}',
			                    '<a href="'.$url.'" class="el_'.
			                    $element->type.'" target="cms_main_main" title="'.$element->desc.'">{{'.
			                    $element->name.'}}</a>',
			                    $text );
			$text = str_replace('{{-&gt;'.$elid.'}}',
			                    '<a href="'.$url.'" class="el_'.
			                    $element->type.'" target="cms_main_main" title="'.$element->desc.'">{{-&gt;'.
			                    $element->name.'}}</a>',
			                    $text );

			$text = str_replace('{{IFEMPTY:'.$elid.':BEGIN}}',
			                    '<a href="'.$url.'" class="el_'.$element->type.'" title="'.$element->desc.'">{{'.lang('TEMPLATE_SRC_IFEMPTY').':'.
			                    $element->name.':'.lang('TEMPLATE_SRC_BEGIN').'}}</a>',
			                    $text );
			$text = str_replace('{{IFEMPTY:'.$elid.':END}}',
			                    '<a href="'.$url.'" class="el_'.$element->type.'" title="'.$element->desc.'">{{'.lang('TEMPLATE_SRC_IFEMPTY').':'.
			                    $element->name.':'.lang('TEMPLATE_SRC_END').'}}</a>',
			                    $text );

			$text = str_replace('{{IFNOTEMPTY:'.$elid.':BEGIN}}',
			                    '<a href="'.$url.'" class="el_'.$element->type.'" title="'.$element->desc.'">{{'.lang('TEMPLATE_SRC_IFNOTEMPTY').':'.
			                    $element->name.':'.lang('TEMPLATE_SRC_BEGIN').'}}</a>',
			                    $text );
			$text = str_replace('{{IFNOTEMPTY:'.$elid.':END}}',
			                    '<a href="'.$url.'" class="el_'.$element->type.'" title="'.$element->desc.'">{{'.lang('TEMPLATE_SRC_IFNOTEMPTY').':'.
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
			$list[$elid]['url' ] = Html::url('element','edit',$this->template->templateid,array('elementid'=>$elid));
			$list[$elid]['name'] = $element->name;
			$list[$elid]['desc'] = $element->desc;
			$list[$elid]['type'] = $element->type;
			
			unset( $element );
		}
		$this->setTemplateVar('el',$list);	
		$this->forward('template_el');
	}


	/**
	  * Anzeigen des Template-Quellcodes
	  */
	function src()
	{
		$elements            = array();
		$icon_elements       = array();
		$ifempty_elements    = array();
		$ifnotempty_elements = array();
		$text = $this->template->src;
	
		foreach( $this->template->getElementIds() as $elid )
		{
			$element = new Element( $elid );
			$element->load();

			$elements[$elid] = $element->name;

			$element = new Element( $elid );
			$element->load();

			if	( $element->isWritable() )
			{
				$icon_elements      [$elid] = lang('GLOBAL_icon'      ).' '.$element->name;
				$ifempty_elements   [$elid] = lang('TEMPLATE_SRC_ifempty'   ).' '.$element->name;
				$ifnotempty_elements[$elid] = lang('TEMPLATE_SRC_ifnotempty').' '.$element->name;
			}
			
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

		$this->setTemplateVar('elements'           ,$elements             );
		$this->setTemplateVar('icon_elements'      ,$icon_elements        );
		$this->setTemplateVar('ifempty_elements'   ,$ifempty_elements     );
		$this->setTemplateVar('ifnotempty_elements',$ifnotempty_elements  );
		$this->setTemplateVar('text'               ,htmlentities($text)   );
	
		$this->forward('template_src');
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
			$list[$id]['url']  = Html::url('main','template',$id);
		}
		
//		$var['templatemodelid'] = htmlentities( $id   );
//		$var['text']            = htmlentities( $text );
		$this->setTemplateVar('templates',$list);
	
		$this->forward('template_list');
		
	}

}