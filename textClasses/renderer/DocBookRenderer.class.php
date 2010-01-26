<?php

/**
 * Renderer fuer das DOCBOOK-Format.
 * 
 * Das Docbook-Format ist von der OASIS spezifiert und ermoeglicht die
 * strukturierte Darstellung von Text-Dokumenten.
 * 
 * Dieses Klasse erzeugt aus dem internen DOM-Baum ein DocBook-XML-Dokument.
 * 
 * @author Jan Dankert, $Author$
 * @version $Revision$
 * @package openrat.text
 */
class DocBookRenderer
{
	var $linkedObjectIds = array();
	var $encodeHtml      = false;
		

	/**
	 * Rendert ein Dokument-Element.
	 *
	 * @param Object $child Element
	 * @return String
	 */
	function renderElement( $child )
	{
		global $conf;
		
		$attr = array();
		$val  = '';
		$praefix = '';
		$suffix  = '';
		$empty   = false;

		switch( strtolower(get_class($child)) )
		{
			case 'macroelement':
				$tag = '';
				break;
				
			case 'tableofcontentelement':
				$tag = 'toc';
				break;

			case 'rawelement':
				$tag = '';
				$val = $child->src;
				
				break;

			case 'textelement':
				$tag = 'para';

				$val = $child->text;
				$val = Text::encodeHtml( $val );
				$val = Text::replaceHtmlChars( $val );
				break;

			case 'footnoteelement':
				$tag = 'footnote';
				break;

			case 'codeelement':
				
				$tag = 'emphasis';
				$attr['role'] = 'code';
				break;

			case 'quoteelement':
				$tag = 'blockquote';
				break;


			case 'paragraphelement':
				$tag = 'para';
				break;

			case 'speechelement':
				$tag = 'citiation';
				break;

			case 'linebreakelement':
				$tag   = '';
				$val   = "\n";
				break;

			case 'linkelement':
				$tag = 'ulink';
				$attr['url'] = htmlspecialchars($child->getUrl());
				break;

			case 'imageelement':
				$empty       = true;
				$tag = 'graphic';
				$attr['fileref'] = $child->getUrl();
				break;

			case 'strongelement':
				$tag = 'emphasis';
				$attr['role'] = 'strong';
				break;

			case 'emphaticelement':
				$tag = 'emphasis';
				$attr['role'] = 'italic';
				break;

			case 'insertedelement':
				$tag = 'emphasis';
				$attr['role'] = 'inserted';
				break;

			case 'removedelement':
				$tag = 'emphasis';
				$attr['role'] = 'removed';
				break;

			case 'headlineelement':
				$tag = 'chapter'; // $child->level ?
				
				$l = new LinkElement();
				$l->name = $child->getName();
				$child->children[] = $l;
				
				break;

			case 'tableelement':
				$tag = 'table';
				break;

			case 'tablelineelement':
				$tag = 'row';
				break;

			case 'definitionlistelement':
				$tag = 'variablelist';
				break;

			case 'definitionitemelement':
				if	( !empty($child->key) )
				{
					$tag = 'listitem';
					$val = $child->key;
				}
				else
				{
					$tag = 'term';
				}
				break;

			case 'tablecellelement':
				//if	( $child->isHeading )
				$tag = 'entry';
				break;

			case 'listelement':
				$tag = 'itemizedlist';
				break;
				
			case 'teletypeelement':
				$tag = 'emphasis';
				$attr['role'] = 'code';
				break;
				
			case 'numberedlistelement':
				$tag = 'orderedlist';
				break;
				
			case 'listentryelement':
				$tag = 'listitem';
				break;

			default:
				
				$tag = 'unknown-element';
				$attr['class'] = strtolower(get_class($child));
				break;
		}				

		$val .= $praefix;
		foreach( $child->children as $c )
		{
			$val .= $this->renderElement( $c );
		}

		$val .= $suffix;
		return $this->renderXmlElement($tag,$val,$empty,$attr);
		
	}



	/**
	 * Erzeugt ein XML-Element.
	 *
	 * @param String $tag Name des Tags
	 * @param String $value Inhalt
	 * @param boolean $empty abk�rzen, wenn Inhalt leer ("<... />")
	 * @param Array $attr Attribute als Array<String,String>
	 * @return String
	 */
	function renderXmlElement( $tag,$value,$empty,$attr=array() )
	{
		global $conf;
		if	( $tag == '' )
			return $value;
			
		$val = '<'.$tag;
		foreach( $attr as $attrName=>$attrInhalt )
		{
			$val .= ' '.$attrName.'="'.$attrInhalt.'"';
		}
		
		if	( $value == '' && $empty )
		{
			$val .= ' />';
			return $val;
		}
		
		$val .= '>'.$value.'</'.$tag.'>';
		return $val;
	}

	
	
	/**
	 * Rendering des Dokumentes.<br>
	 *
	 * @return String
	 */
	function render()
	{
		$this->renderedText = '';
		$this->renderedText .= '<?xml version="1.0" encoding="UTF-8" ?>';
		$this->renderedText .= '<!DOCTYPE book PUBLIC "-//OASIS//DTD DocBook XML V4.2//EN" "http://www.oasis-open.org/docbook/xml/4.2/docbookx.dtd">';
		
		foreach( $this->children as $child )
			$this->renderedText .= $this->renderElement( $child );

		return $this->renderedText;
	}
}

?>