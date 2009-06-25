<?php
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




	function srcaddelement()
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
	function savename()
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
	function delete()
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
	function remove()
	{
		$this->setTemplateVar('name',$this->template->name);
	}


	/**
	 * Anzeigen aller Seiten der Vorlage.
	 */
	function pages()
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
	}


	// Speichern der Dateiendung
	//
	function saveextension()
	{
		if	( $this->getRequestVar('type') == "list" )
			$this->template->extension = $this->getRequestVar('extension');
		else
			$this->template->extension = $this->getRequestVar('extensiontext');
		
		$this->template->save(); 
		$this->addNotice('template',$this->template->name,'SAVED','ok');
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
			$this->setTemplateVar('tree_refresh',true);
			$this->addNotice('template',$this->template->name,'SAVED','ok');
		}
		else
		{
			$this->addValidationError('name');
			$this->callSubAction('addel');
		}

	}


	/**
	 * Vorlage hinzuf�gen.
	 */
	function add()
	{
		$this->setTemplateVar( 'templates',Template::getAll() );

		$examples = array();
		$dir = opendir( 'examples/templates');
		while( $file = readdir($dir) )
		{
			if	( substr($file,0,1) != '.')
			{
				$examples[$file] = $file;
			}
		}
		
		$this->setTemplateVar( 'examples',$examples );
	}
	
	
	
	function addtemplate()
	{
		// Hinzufuegen eines Templates
		if   ( $this->getRequestVar('name') == '' )
		{
			$this->addValidationError('name');
			$this->callSubAction('add');
			return;
		}

		// Hinzufuegen eines Templates
		switch( $this->getRequestVar('type') )
		{
			case 'empty':

				$template = new Template();
				$template->add( $this->getRequestVar('name') );
				$this->addNotice('template',$template->name,'ADDED','ok');
				break;
				
			case 'copy':
				
				$copy_templateid = intval($this->getRequestVar('templateid') );
				
				if	( $copy_templateid == 0 )
				{
					$this->addValidationError('templateid');
					$this->callSubAction('add');
					return;
				}
				
				$template = new Template();
				$template->add( $this->getRequestVar('name') );
				$this->addNotice('template',$template->name,'ADDED','ok');

				$copy_template = new Template( $copy_templateid );
				$copy_template->load();
				foreach( $copy_template->getElements() as $element )
				{
					$element->load();
					$element->templateid = $template->templateid;
					$element->add();
					$element->save();
				}
				
				$this->addNotice('template',$copy_template->name,'COPIED','ok');

				break;

			case 'example':

				$template = new Template();

				$model = Session::getProjectModel();
				$template->modelid = $model->modelid;
				
				$template->add( $this->getRequestVar('name') );

				$example = parse_ini_file('examples/templates/'.$this->getRequestVar('example'),true);

				foreach( $example as $exampleKey=>$exampleElement )
				{
					if	( !is_array($exampleElement) )
					{
						$template->$exampleKey = $exampleElement;
					}
					else
					{
						$element = new Element();
						$element->templateid = $template->templateid;
						$element->name       = $exampleKey;
						$element->writable   = true;
						$element->add();

						foreach( $exampleElement as $ePropName=>$ePropValue)
							$element->$ePropName = $ePropValue;
						
						$element->defaultText = str_replace(';',"\n",$element->defaultText);
						$element->save();
//						Html::debug($element,"Element");
					}
				}
//				Html::debug($template,"Template");
				$template->name = $this->getRequestVar('name');
				$template->src = str_replace(';',"\n",$template->src);
				
				foreach( $template->getElementNames() as $elid=>$elname )
				{
					$template->src = str_replace('{{'.$elname.'}}'  ,'{{'.$elid.'}}'  ,$template->src );
					$template->src = str_replace('{{->'.$elname.'}}','{{->'.$elid.'}}',$template->src );
				}
				
				$template->save();
				$this->addNotice('template',$template->name,'ADDED','ok');

				break;
			default:
				$this->addValidationError('type');
				$this->callSubAction('add');
				return;
		}


		$this->setTemplateVar('tree_refresh',true);
	}

	
	function prop()
	{
	}
	
	
	
	/**
	 * Eigenschaften einer Vorlage anzeigen
	 */
	function name()
	{
		$this->setTemplateVar('name'     ,$this->template->name       );
		$this->setTemplateVar('extension',$this->template->extension  );
		$this->setTemplateVar('mime_type',$this->template->mimeType() );
	}



	/**
	 * Eigenschaften einer Vorlage anzeigen
	 */
	function extension()
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
	function src()
	{
		if	( $this->isEditMode() )
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
		else
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
		
			$this->setTemplateVar('src',$text);
		}
		
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
				return (count($this->template->getElementIds()) > 0);

			case 'remove':
				// Entfernen von Templates nur dann erlaubt, wenn keine Seiten auf diesem Template basieren.
				return (count($this->template->getDependentObjectIds()) == 0);

			case 'pages':
				// Anzeige von Seiten nur dann sinnvoll, wenn es auch Seiten gibt.
				return (count($this->template->getDependentObjectIds()) > 0);
				
			default:
				return true;

		}
	}
	
}