<?php
use cms\model\Element;
use cms\model\Template;
use cms\model\Page;

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

class TemplateAction extends Action
{
	public $security = SECURITY_USER;
	
	var $defaultSubAction = 'show';
	var $template;
	var $element;


	function TemplateAction()
	{
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


	function srcPost()
	{
		// Speichern des Quelltextes
		//
		$text = $this->getRequestVar('src','raw');
		
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
		
		$this->addNotice('template',$this->template->name,'SAVED',OR_NOTICE_OK);
	}




	function srcelementPost()
	{
		$text = $this->template->src;

		switch( $this->getRequestVar('type') )
		{
			case 'addelement':
				$text .= "\n".'{{'.$this->getRequestVar('elementid').'}}';
				break;
		
			case 'addicon':
				$text .= "\n".'{{->'.$this->getRequestVar('writable_elementid').'}}';
				break;

			case 'addifempty':
				$text .= "\n".'{{IFEMPTY:'.$this->getRequestVar('writable_elementid').':BEGIN}}  {{IFEMPTY:'.$this->getRequestVar('writable_elementid').':END}}';
				break;

			case 'addifnotempty':
				$text .= "\n".'{{IFNOTEMPTY:'.$this->getRequestVar('writable_elementid').':BEGIN}}  {{IFNOTEMPTY:'.$this->getRequestVar('writable_elementid').':END}}';
				break;
		
			default:
				$this->addValidationError('type');
				$this->callSubAction('srcelement');
				return;
		}
		
		$this->template->src = $text;

		$this->template->save();
		$this->template->load();

		$this->addNotice('template',$this->template->name,'SAVED',OR_NOTICE_OK);
	}


	// Speichern der Template-Eigenschaftens
	//
	function propPost()
	{
		
		if	($this->getRequestVar('name') == "")
		{
			$this->addValidationError('name');
			$this->callSubAction('name');
			return;
		}
		else
		{
			$this->template->name = $this->getRequestVar('name');
			$this->template->save();
			$this->addNotice('template',$this->template->name,'SAVED',OR_NOTICE_OK);
		}
	}


	// Speichern der Template-Eigenschaftens
	//
	function removePost()
	{
		if   ( $this->getRequestVar('delete') != '' )
		{
			$this->template->delete();
			$this->addNotice('template',$this->template->name,'DELETED',OR_NOTICE_OK);
		}
		else
		{
			$this->addNotice('template',$this->template->name,'CANCELED',OR_NOTICE_WARN);
		}
	}


	/**
	 * Entfernen der Vorlage
	 */
	function removeView()
	{
		$this->setTemplateVar('name',$this->template->name);
	}


	/**
	 * Anzeigen aller Seiten der Vorlage.
	 */
	function infoView()
	{
		$pages = array();
		$pageids = $this->template->getDependentObjectIds();
		
		foreach( $pageids as $pageid )
		{
			$page = new Page($pageid);
			$page->load();
			
			$pages[$pageid] = $page->name;
		}
		
		$this->setTemplateVar('pages',$pages);
		$this->setTemplateVar('id'   ,$this->template->templateid);
	}


	// Speichern der Dateiendung
	//
	function extensionPost()
	{
		if	( $this->getRequestVar('type') == "list" )
			$this->template->extension = $this->getRequestVar('extension');
		else
			$this->template->extension = $this->getRequestVar('extensiontext');
		
		$this->template->save(); 
		$this->addNotice('template',$this->template->name,'SAVED','ok');
	}


	function addelView()
	{
		// Die verschiedenen Element-Typen
		$types = array();

		foreach( Element::getAvailableTypes() as $t )
		{
			$types[ $t ] = 'EL_'.$t;
		}

		// Code-Element nur fuer Administratoren (da voller Systemzugriff!)		
		if	( !$this->userIsAdmin() )
			unset( $types['code'] );
		
		$this->setTemplateVar('types',$types);
	}
	
	
	
	/*
	 * Neues Element hinzufuegen.
	 */
	function addelPost()
	{

		$name = $this->getRequestVar('name',OR_FILTER_ALPHANUM);
		if  ( empty($name) )
		{
			$this->addValidationError('name');
			$this->callSubAction('addel');
			return;
		}
		
		$this->template->addElement( $name,$this->getRequestVar('description'),$this->getRequestVar('type') );
		$this->setTemplateVar('tree_refresh',true);
		
		if	( $this->hasRequestVar('addtotemplate') )
		{
			$elnames = $this->template->getElementNames();
			$elid = array_search($name,$elnames);
			$this->template->src .= "\n".'{{'.$elid.'}}';
			$this->template->save();
		}

		$this->addNotice('template',$this->template->name,'SAVED',OR_NOTICE_OK);
	}


	
	/**
	 * Eigenschaften einer Vorlage anzeigen
	 */
	function propView()
	{
		$this->setTemplateVar('name'     ,$this->template->name       );
		$this->setTemplateVar('extension',$this->template->extension  );
		$this->setTemplateVar('mime_type',$this->template->mimeType() );
	}



	/**
	 * Eigenschaften einer Vorlage anzeigen
	 */
	function extensionView()
	{

		global $conf;
		$mime_types = array();
		foreach( $conf['mime-types'] as $ext=>$type )
			$mime_types[$ext] = $ext.' - '.$type;

		$this->setTemplateVar('mime_types',$mime_types);

		$this->setTemplateVar('extension'    ,$this->template->extension);
		$this->setTemplateVar('extensiontext',$this->template->extension);
		
		if	( isset($mime_types[$this->template->extension]) )
			$this->setTemplateVar('type','list');
		else
			$this->setTemplateVar('type','text');
	}

	
	
	/**
	 * Anzeigen des Inhaltes, der Inhalt wird samt Header direkt
	 * auf die Standardausgabe geschrieben
	 */
	function previewView()
	{
		$this->setTemplateVar('preview_url',Html::url('template','show',$this->template->templateid,array('target'=>'none') ) );
	}
	
	


	/**
	 * Voransicht einer Vorlage
	 */
	function showView()
	{
		header('Content-Type: '.$this->template->mimeType().'; charset='.$this->getCharset() );
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
	function editView()
	{
		// Elemente laden 
		$list = array();
	
		foreach( $this->template->getElementIds() as $elid )
		{
			$element = new Element( $elid );
			$element->load();

			$list[$elid] = array();
			$list[$elid]['id'         ] = $elid;
			$list[$elid]['name'       ] = $element->name;
			$list[$elid]['description'] = $element->desc;
			$list[$elid]['type'       ] = $element->type;
			
			unset( $element );
		}
		$this->setTemplateVar('elements',$list);	
		
		
		$text = Text::encodeHtml( $this->template->src );
		$text = str_replace("\n",'<br/>',$text);
	
		foreach( $this->template->getElementIds() as $elid )
		{
			$element = new Element( $elid );
			$element->load();
			$url = 'javascript:openNewAction(\''.$element->name.'\',\'element\',\''.$elid.'\');';
			
			$text = str_replace('{{'.$elid.'}}',
			                    '<a href="'.$url.'" class="element el_'.
			                    $element->getTypeClass().'" title="'.$element->desc.'">{{'.
			                    $element->name.'}}</a>',
			                    $text );
			$text = str_replace('{{-&gt;'.$elid.'}}',
			                    '<a href="'.$url.'" class="element el_'.
			                    $element->getTypeClass().'" title="'.$element->desc.'">{{-&gt;'.
			                    $element->name.'}}</a>',
			                    $text );

			$text = str_replace('{{IFEMPTY:'.$elid.':BEGIN}}',
			                    '<a href="'.$url.'" class="element el_'.$element->getTypeClass().'" title="'.$element->desc.'">{{'.lang('TEMPLATE_SRC_IFEMPTY').':'.
			                    $element->name.':'.lang('TEMPLATE_SRC_BEGIN').'}}</a>',
			                    $text );
			$text = str_replace('{{IFEMPTY:'.$elid.':END}}',
			                    '<a href="'.$url.'" class="element el_'.$element->getTypeClass().'" title="'.$element->desc.'">{{'.lang('TEMPLATE_SRC_IFEMPTY').':'.
			                    $element->name.':'.lang('TEMPLATE_SRC_END').'}}</a>',
			                    $text );

			$text = str_replace('{{IFNOTEMPTY:'.$elid.':BEGIN}}',
			                    '<a href="'.$url.'" class="element el_'.$element->getTypeClass().'" title="'.$element->desc.'">{{'.lang('TEMPLATE_SRC_IFNOTEMPTY').':'.
			                    $element->name.':'.lang('TEMPLATE_SRC_BEGIN').'}}</a>',
			                    $text );
			$text = str_replace('{{IFNOTEMPTY:'.$elid.':END}}',
			                    '<a href="'.$url.'" class="element el_'.$element->getTypeClass().'" title="'.$element->desc.'">{{'.lang('TEMPLATE_SRC_IFNOTEMPTY').':'.
			                    $element->name.':'.lang('TEMPLATE_SRC_END').'}}</a>',
			                    $text );
			                    
			unset( $element );
		}
	
		$this->setTemplateVar('text',$text);
	}


	function srcelementView()
	{
		$elements           = array();
		$writable_elements = array();
	
		foreach( $this->template->getElementIds() as $elid )
		{
			$element = new Element( $elid );
			$element->load();

			$elements[$elid] = $element->name;

			if	( $element->isWritable() )
				$writable_elements[$elid] = $element->name;
		}

		$this->setTemplateVar('elements'         ,$elements         );
		$this->setTemplateVar('writable_elements',$writable_elements);
	}
	
	
	
	/**
	  * Anzeigen des Template-Quellcodes
	  */
	function srcView()
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
	function listingView()
	{
		global $conf_php;

		$list = array();
	
		foreach( Template::getAll() as $id=>$name )
		{
			$list[$id] = array();
			$list[$id]['name'] = $name;
			$list[$id]['url' ] = Html::url('template','el',$id,array());
		}
		
//		$var['templatemodelid'] = htmlentities( $id   );
//		$var['text']            = htmlentities( $text );
		$this->setTemplateVar('templates',$list);
	}

	
	/**
	 * Anzeigen der Maske zum Veröffentlichen.
	 */
	public function pubView()
	{
		
	}
	
	
	
	/**
	 * Veröffentlichen.
	 */
	public function pubPost()
	{
		$objectIds = $this->template->getDependentObjectIds();

		Session::close();
		
		foreach( $objectIds as $objectid )
		{
			$page = new Page( $objectid );
			
			if	( !$page->hasRight( ACL_PUBLISH ) )
				continue;
			
			$page->public = true;
			$page->publish();
			$page->publish->close();
			
			//		foreach( $this->page->publish->publishedObjects as $o )
				//		{
				//			$this->addNotice($o['type'],$o['full_filename'],'PUBLISHED','ok');
				//		}
			
			$this->addNotice( 'page',
					$page->fullFilename,
					'PUBLISHED'.($page->publish->ok?'':'_ERROR'),
					$page->publish->ok,
					array(),
					$page->publish->log  );
		}
	}
	
	
	
	/**
	 * Stellt fest, welche Menüeinträge ggf. ausgeblendet werden.
	 * 
	 * @see actionClasses/Action#checkMenu($name)
	 */
	function checkMenu( $menu ) {

		switch( $menu)
		{
			case 'srcelement':
				// Platzhalter nur hinzufuegbar, wenn es welche gibt.
				return is_object($this->template) &&
				       (count($this->template->getElementIds()) > 0);

			case 'remove':
				// Entfernen von Templates nur dann erlaubt, wenn keine Seiten auf diesem Template basieren.
				return is_object($this->template) &&
				       (count($this->template->getDependentObjectIds()) == 0);

			case 'pages':
				// Anzeige von Seiten nur dann sinnvoll, wenn es auch Seiten gibt.
				return is_object($this->template) &&
				       (count($this->template->getDependentObjectIds()) > 0);

			case 'add':
			case 'addel':
				return !readonly();
				
			default:
				return true;

		}
	}
	
}