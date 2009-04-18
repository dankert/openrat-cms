<?php

/**
 * Dokument-Objekt.<br>
 * Diese Objekt verk�rpert das Root-Objekt in einem DOM-Baum.<br>
 * <br>
 * Dieses Objekt kann Text parsen und seine Unterobjekte selbst erzeugen.<br>
 * 
 * @author Jan Dankert, $Author$
 * @version $Revision$
 * @package openrat.text
 */
class HtmlRenderer
{
	var $linkedObjectIds = array();
	var $encodeHtml = false;
		
	/**
	 * Fu�noten.
	 *
	 * @var Array
	 */
	var $footnotes       = array();


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

				if	( count($child->children) > 0 )
				{
					$subChild1 = $child->children[0];
					
					if	( !empty($subChild1->class) )
						$attr['class'] = $subChild1->class;
					
					if	( !empty($subChild1->style) )
						$attr['style'] = $subChild1->style;
					
					if	( !empty($subChild1->title) )
						$attr['title'] = $subChild1->title;
				}
				
				switch( strtolower(get_class($child)) )
				{
					case 'tableofcontentelement':
						$tag = 'p';
						foreach( $this->children as $h)
						{
							if	( strtolower(get_class($h))=='headlineelement' )
							{
								$child->children[] = new RawElement(str_repeat('&nbsp;&nbsp;',$h->level));
								$t = new TextElement( $h->getText() );
								$l = new LinkElement();
								$l->fragment=$h->getName();
								$l->children[] = $t;
								$child->children[] = $l;
								$child->children[] = new LineBreakElement();
							}
						}
						break;

					case 'rawelement':
						$tag = '';
						$val = $child->src;
						
						break;

					case 'textelement':
						$tag = '';
//						$tag = 'span';

						$val = $child->text;
						if	( $this->encodeHtml )
							$val = Text::encodeHtml( $val );
						$val = Text::replaceHtmlChars( $val );
						break;

					case 'footnoteelement':
						$tag = 'a';
						$attr['href'] = '#footnote';
						
						$title = '';
						foreach( $child->children as $c )
							$title .= $this->renderElement($c);
						$attr['title'] = strip_tags($title);
						 
						$nr = 1;
						foreach( $this->footnotes as $fn )
							if ( strtolower(get_class($fn))=='linebreakelement')
								$nr++;
								
						$val = $nr;
						if	( @$conf['editor']['footnote']['bracket'])
							$val = '('.$nr.')';
						if	( @$conf['editor']['footnote']['sup'])
							$val = '<sup><small>'.$nr.'</small></sup>';
								

						if	( $nr == 1 )
						{
							$this->footnotes[] = new RawElement('&mdash;');
							$le = new LinkElement();
							$le->name = "footnote";
							$this->footnotes[] = $le;
							$this->footnotes[] = new RawElement('&mdash;');
						}
						$this->footnotes[] = new LineBreakElement();
						$this->footnotes[] = new RawElement($val);
						$this->footnotes[] = new RawElement(' ');
						foreach( $child->children as $c )
							$this->footnotes[] = $c;
						
						$child->children = array();

						break;

					case 'codeelement':
						
						if	( empty($child->language) )
							// Wenn keine Sprache verf�gbar, dann ein einfaches PRE-Element erzeugen.
							$tag = 'pre';
						else
						{
							// Wenn Sprache verf�gbar, dann den GESHI-Parser bem�hen.
							$tag    = '';
							$source = '';
							foreach( $child->children as $c )
								if	( strtolower(get_class($c)) == 'textelement')
									$source .= $c->text."\n";
							$child->children = array();
							require_once('./geshi/geshi.php');
							$geshi = new Geshi($source,$child->language);
							$val = $geshi->parse_code(); 
						}
						break;

					case 'quoteelement':
						$tag = 'blockquote';
						break;


					case 'paragraphelement':
						$tag = 'p';
						break;

					case 'speechelement':
						if	( isset($conf['editor']['html']['tag_speech']) )
							$tag = $conf['editor']['html']['tag_speech'];
						else
							$tag = 'cite';
						
						// Danke an: http://www.apostroph.de/tueddelchen.php
						//TODO: Abh�ngigkeit von Spracheinstellung implementieren.
						$language = 'de';
						switch( $language )
						{
							case 'de': // deutsche Notation
								$praefix = '&bdquo;';
								$suffix  = '&ldquo;';
								break;
							case 'fr':
								$praefix = '&laquo;';
								$suffix  = '&raquo;';
								break;
							default: // englische Notation
								$praefix = '&ldquo;';
								$suffix  = '&rdquo;';
						}
						
						if	( $conf['editor']['html']['override_speech'] )
						{
							$praefix = $conf['editor']['html']['override_speech_open' ];
							$suffix  = $conf['editor']['html']['override_speech_close'];
						}
						break;

					case 'linebreakelement':
						$tag   = 'br';
						$empty = true;
						break;

					case 'linkelement':
						$tag = 'a';
						if	( !empty($child->name) )
							$attr['name'] = $child->name;
						else
							$attr['href'] = htmlspecialchars($child->getUrl());

						if	( Object::available( $child->objectId ) )
						{
							$file = new File( $child->objectId );
							$file->load();
							$attr['title'] = $file->description;
							unset( $file );
						}
						break;

					case 'imageelement':
						$empty       = true;
						$attr['alt'] = '';
						
						if	( ! Object::available( $child->objectId ) )
						{
							$tag = '';
						}
						elseif	( empty($attr['title']) )
						{
							$tag = 'img';
							$attr['src']    = $child->getUrl();
							$attr['border'] = '0';
							
							// Breite/H�he des Bildes bestimmen.
							$image = new File( $child->objectId );
							
							$image->load();
							$attr['alt'   ]    = $image->name;
							$attr['title' ]    = $image->description;
							
							$image->getImageSize();
							$attr['width' ]    = $image->width;
							$attr['height']    = $image->height;
							unset($image);
						}
						else
						{
							$tag = 'dl';
							
							if	( empty($attr['class']) )
								$attr['class'] = "image";
								
							$child->children = array();
							$dt = new DefinitionListItemElement();
							$dt->children[] = new TextElement('(image)');
							$dt->children[] = $child;
							$child->children[] = $dt;

							$dd = new DefinitionListEntryElement();
							$dd->children[] = new TextElement('(image)');
							$dd->children[] = new TextElement($attr['title']);
							$child->children[] = $dd;
						}
						break;

					case 'strongelement':
						if	( isset($conf['editor']['html']['tag_strong']) )
							$tag = $conf['editor']['html']['tag_strong'];
						else
							$tag = 'strong';
						break;

					case 'emphaticelement':
						if	( isset($conf['editor']['html']['tag_emphatic']) )
							$tag = $conf['editor']['html']['tag_emphatic'];
						else
							$tag = 'em';
						break;

					case 'insertedelement':
						$tag = 'ins';
						break;

					case 'removedelement':
						$tag = 'del';
						break;

					case 'headlineelement':
						$tag = 'h'.$child->level;
						
						$l = new LinkElement();
						$l->name = $child->getName();
						$child->children[] = $l;
						
						break;

					case 'tableelement':
						$tag = 'table';
						break;

					case 'tablelineelement':
						$tag = 'tr';
						break;

					case 'definitionlistelement':
						$items = $child->children;
						$newChildren = array();
						foreach( $items as $item )
						{
							$def = new DefinitionItemElement();
							$def->key = $item->key;
							$item->key = ''; 
							$newChildren[] = $def;
							$newChildren[] = $item;
						}
//						Html::debug($newChildren,'Children-neu');
						$child->children = $newChildren;
						$tag = 'dl';
						break;

					case 'definitionitemelement':
						if	( !empty($child->key) )
						{
							$tag = 'dt';
							$val = $child->key;
						}
						else
						{
							$tag = 'dd';
						}
						break;

					case 'tablecellelement':
						if	( $child->isHeading )
							$tag = 'th'; else $tag = 'td';
							
						if	( $child->rowSpan > 1 )
							$attr['rowspan'] = $child->rowSpan;
						if	( $child->colSpan > 1 )
							$attr['colspan'] = $child->colSpan;
						break;

					case 'listelement':
						$tag = 'ul';
						break;
						
					case 'teletypeelement':
						if	( isset($conf['editor']['html']['tag_teletype']) )
							$tag = $conf['editor']['html']['tag_teletype'];
						else
							$tag = 'code';
						break;
						
					case 'numberedlistelement':
						$tag = 'ol';
						break;
						
					case 'listentryelement':
						$tag = 'li';
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
//				echo "text:$val";
				return $this->renderHtmlElement($tag,$val,$empty,$attr);
		
	}



	/**
	 * Erzeugt ein HTML-Element.
	 *
	 * @param String $tag Name des Tags
	 * @param String $value Inhalt
	 * @param boolean $empty abk�rzen, wenn Inhalt leer ("<... />")
	 * @param Array $attr Attribute als Array<String,String>
	 * @return String
	 */
	function renderHtmlElement( $tag,$value,$empty,$attr=array() )
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
			// Inhalt ist leer, also Kurzform verwenden.
			// Die Kurzform ist abh�ngig vom Rendermode.
			// SGML=<tag>
			// XML=<tag />
			if	( $conf['editor']['html']['rendermode'] == 'xml' )
			{
				$val .= ' />';
				return $val;
			}
			else	
			{
				$val .= '>';
				return $val;
			}	
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
		$this->footnotes    = array();
		
		foreach( $this->children as $child )
			$this->renderedText .= $this->renderElement( $child );

		foreach( $this->footnotes as $child )
			$this->renderedText .= $this->renderElement( $child );
			
		return $this->renderedText;
	}
}

?>