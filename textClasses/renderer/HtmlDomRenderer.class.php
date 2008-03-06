<?php

/**
 * Dokument-Objekt.<br>
 * Diese Objekt verkörpert das Root-Objekt in einem DOM-Baum.<br>
 * <br>
 * Dieses Objekt kann Text parsen und seine Unterobjekte selbst erzeugen.<br>
 * 
 * @author Jan Dankert, $Author$
 * @version $Revision$
 * @package openrat.text
 */
class HtmlDomRenderer
{
	var $linkedObjectIds = array();
	
	/**
	 * Fußnoten.
	 *
	 * @var Array
	 */
	var $footnotes       = array();

	var $encodeHtml = false;
	
	var $path       = array();
	
	var $domId      = '';
	
	
	function HtmlEditorRenderer()
	{
		global $REQ;
		$this->domId = !empty($REQ['domid'])?$REQ['domid']:'';
	}
	
	/**
	 * Rendert ein Dokument-Element.
	 *
	 * @param Object $child Element
	 * @return String
	 */
	function renderElement( $child )
	{
		global $conf;
		
		$this->path[] = $child;
		
		$val  = '<br/>';
		foreach( $this->path as $p )
			$val .= '&nbsp;&nbsp;&nbsp;&nbsp;';

		$val .= '<a href="#'.$this->getPathAsString().'">_</a>';
			
				$attr = array();
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
						$tag = 'text';

						$val .= $child->text;
						
						if	( $this->getPathAsString() == $this->domId )
						{
							$val = '<form><textarea name="" rows="5" cols="50">'.$val.'</textarea><input type="submit" /></form>';
						}
						else
						{
//							if	( $this->encodeHtml )
//								$val = Text::encodeHtml( $val );
//							$val = Text::replaceHtmlChars( $val );
							#$val .= '<a href="?domid='.$this->getPathAsString().'"><img src="./editor/editor/filemanager/browser/default/images/icons/txt.gif"></a>';
						}
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
							// Wenn keine Sprache verfügbar, dann ein einfaches PRE-Element erzeugen.
							$tag = 'pre';
						else
						{
							// Wenn Sprache verfügbar, dann den GESHI-Parser bemühen.
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
						$tag     = 'cite';
						
						// Danke an: http://www.apostroph.de/tueddelchen.php
						//TODO: Abhängigkeit von Spracheinstellung implementieren.
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
						
						if	( $this->getPathAsString() == $this->domId )
						{
							$tag = '';
							$val = '<form><input type="text" name="" size="15" value="'.$child->getUrl().'" /><input type="text" name="" size="5" value="'.$child->objectId.'" /><input type="submit" /></form>';
						}
						else
						{
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
							$suffix = '<a href="?domid='.$this->getPathAsString().'"><img src="./themes/default/images/editor/link.png"></a>';
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
							
							// Breite/Höhe des Bildes bestimmen.
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
						$suffix = '<a href="#"><img src="./themes/default/images/editor/image.png"></a>';
						break;

					case 'strongelement':
						$tag = 'strong';
						break;

					case 'emphaticelement':
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

				$val = $this->renderHtmlElement($tag,$val,$empty,$attr);
				$val .= $praefix;
				$val .= $suffix;
				
				foreach( $child->children as $c )
				{
					$val .= $this->renderElement( $c );
				}

//				echo "text:$val";

				unset( $this->path[ count($this->path)-1 ] );
				return $val;
	}



	/**
	 * Erzeugt ein HTML-Element.
	 *
	 * @param String $tag Name des Tags
	 * @param String $value Inhalt
	 * @param boolean $empty abkürzen, wenn Inhalt leer ("<... />")
	 * @param Array $attr Attribute als Array<String,String>
	 * @return String
	 */
	function renderHtmlElement( $tag,$value,$empty,$attr=array() )
	{
		$val = 'Tag='.$tag;
		foreach( $attr as $attrName=>$attrInhalt )
		{
			$val .= ' '.$attrName.'="'.$attrInhalt.'"';
		}
		
		
		$val .= ' value='.$value.'';
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
	
	
	/**
	 *
	 */
	function getPathAsString()
	{
		$path = array();
		foreach( $this->path as $p )
		{
			$path[] = strtolower( substr(get_class($p),0,-7) );
		}
		
		return implode('_',$path);
	}
}

?>