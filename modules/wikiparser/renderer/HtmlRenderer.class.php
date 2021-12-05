<?php

namespace wikiparser\renderer;

use cms\base\Configuration;
use cms\generator\PageContext;
use cms\model\File;
use cms\model\Image;
use cms\model\BaseObject;
use util\ClassUtils;
use util\exception\GeneratorException;
use wikiparser\model\DefinitionItemElement;
use DefinitionListEntryElement;
use DefinitionListItemElement;
use Exception;
use Geshi;
use wikiparser\model\LineBreakElement;
use wikiparser\model\LinkElement;
use cms\macros\MacroRunner;
use wikiparser\model\RawElement;
use util\Text;
use wikiparser\model\TextElement;

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
	public $linkedObjectIds = array();
	public $encodeHtml = false;

	/**
	 * Fu�noten.
	 *
	 * @var array
	 */
	public $footnotes = array();

	/**
	 * @var string
	 */
	public $renderedText;

	/**
	 * @var \cms\model\Page
	 */
	public $page;

	/**
	 * @var PageContext
	 */
	public $pageContext;

	/**
	 * @var array
	 */
	public $children;


	/**
	 * Rendert ein Dokument-Element.
	 *
	 * @param BaseObject $child Element
	 * @return String
	 */
	function renderElement($child)
	{
		$footnoteConfig = Configuration::subset('editor')->subset('footnote');
		$htmlConfig     = Configuration::subset(['editor','html']);

		$attr = array();
		$val = '';
		$praefix = '';
		$suffix = '';
		$empty = false;

		if (count($child->children) > 0) {
			$subChild1 = $child->children[0];

			if (!empty($subChild1->class))
				$attr['class'] = $subChild1->class;

			if (!empty($subChild1->style))
				$attr['style'] = $subChild1->style;

			if (!empty($subChild1->title))
				$attr['title'] = $subChild1->title;
		}

		switch (strtolower(ClassUtils::getSimpleClassName($child))) {
			case 'tableofcontentelement':
				$tag = 'p';
				foreach ($this->children as $h) {
					if (strtolower(get_class($h)) == 'headlineelement') {
						$child->children[] = new RawElement(str_repeat('&nbsp;&nbsp;', $h->level));
						$t = new TextElement($h->getText());
						$l = new LinkElement();
						$l->fragment = $h->getName();
						$l->children[] = $t;
						$child->children[] = $l;
						$child->children[] = new LineBreakElement();
					}
				}
				break;

			case 'rawelement':
				$tag = '';

				break;

			case 'textelement':
				$tag = '';
//						$tag = 'span';

				$val = $child->text;
				if ($this->encodeHtml)
					$val = Text::encodeHtml($val);
				$val = Text::replaceHtmlChars($val);
				break;

			case 'footnoteelement':
				$tag = 'a';
				$attr['href'] = '#footnote';

				$title = '';
				foreach ($child->children as $c)
					$title .= $this->renderElement($c);
				$attr['title'] = strip_tags($title);

				$nr = 1;
				foreach ($this->footnotes as $fn)
					if (strtolower(get_class($fn)) == 'linebreakelement')
						$nr++;

				$val = $nr;
				if ($footnoteConfig->is('bracket') )
					$val = '(' . $nr . ')';
				if ($footnoteConfig->is('sup'))
					$val = '<sup><small>' . $nr . '</small></sup>';


				if ($nr == 1) {
					$this->footnotes[] = new RawElement('&mdash;');
					$le = new LinkElement();
					$le->name = "footnote";
					$this->footnotes[] = $le;
					$this->footnotes[] = new RawElement('&mdash;');
				}
				$this->footnotes[] = new LineBreakElement();
				$this->footnotes[] = new RawElement($val);
				$this->footnotes[] = new RawElement(' ');
				foreach ($child->children as $c)
					$this->footnotes[] = $c;

				$child->children = array();

				break;

			case 'codeelement':

				if (empty($child->language))
					// Wenn keine Sprache verf�gbar, dann ein einfaches PRE-Element erzeugen.
					$tag = 'pre';
				else {
					// Wenn Sprache verf�gbar, dann den GESHI-Parser bem�hen.
					$tag = '';
					$source = '';
					foreach ($child->children as $c)
						if (strtolower(get_class($c)) == 'textelement')
							$source .= $c->text . "\n";
					$child->children = array();
					require_once(__DIR__ . '/../../../geshi/geshi.php');
					$geshi = new Geshi($source, $child->language);
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
				if ($htmlConfig->has('tag_speech'))
					$tag = $htmlConfig->get('tag_speech');
				else
					$tag = 'cite';

				// Danke an: http://www.apostroph.de/tueddelchen.php
				//TODO: Abh�ngigkeit von Spracheinstellung implementieren.
				$language = 'de';
				switch ($language) {
					case 'de': // deutsche Notation
						$praefix = '&bdquo;';
						$suffix = '&ldquo;';
						break;
					case 'fr':
						$praefix = '&laquo;';
						$suffix = '&raquo;';
						break;
					default: // englische Notation
						$praefix = '&ldquo;';
						$suffix = '&rdquo;';
				}

				if ($htmlConfig->is('override_speech')) {
					$praefix = $htmlConfig->get('override_speech_open');
					$suffix = $htmlConfig->get('override_speech_close');
				}
				break;

			case 'macroelement':

				$tag = '';

				$className = ucfirst($child->name);

				$runner = new MacroRunner();
				try {
					$val .= $runner->executeMacro($className, $child->attributes, $this->page,$this->pageContext);
				} catch (Exception $e) {
					throw new GeneratorException('Could not execute the macro '.$className,$e);
				}

				break;

			case 'linebreakelement':
				$tag = 'br';
				$empty = true;
				break;

			case 'linkelement':
				$tag = 'a';
				if (!empty($child->name))
					$attr['name'] = $child->name;
				else
					$attr['href'] = htmlspecialchars($child->getUrl());

				if (BaseObject::available($child->objectId)) {
					$file = new File($child->objectId);
					$file->load();
					$attr['title'] = $file->getDefaultName()->description;
					unset($file);
				}
				break;

			case 'imageelement':
				$empty = true;
				$attr['alt'] = '';

				if (!BaseObject::available($child->objectId)) {
					$tag = '';
				} elseif (empty($attr['title'])) {
					$tag = 'img';
					$attr['src'] = $child->getUrl();
					$attr['border'] = '0';

					// Breite/H�he des Bildes bestimmen.
					$image = new Image($child->objectId);

					$image->load();
					$attr['alt'  ] = $image->getDefaultName()->name;
					$attr['title'] = $image->getDefaultName()->description;

					$image->getImageSize();
					$attr['width'] = $image->width;
					$attr['height'] = $image->height;
					unset($image);
				} else {
					$tag = 'dl';

					if (empty($attr['class']))
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
				if ($htmlConfig->has('tag_strong'))
					$tag = $htmlConfig->get('tag_strong');
				else
					$tag = 'strong';
				break;

			case 'emphaticelement':
				if ($htmlConfig->has('tag_emphatic'))
					$tag = $htmlConfig->get('tag_emphatic');
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
				$tag = 'h' . $child->level;

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
				foreach ($items as $item) {
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
				if (!empty($child->key)) {
					$tag = 'dt';
					$val = $child->key;
				} else {
					$tag = 'dd';
				}
				break;

			case 'tablecellelement':
				if ($child->isHeading)
					$tag = 'th'; else $tag = 'td';

				if ($child->rowSpan > 1)
					$attr['rowspan'] = $child->rowSpan;
				if ($child->colSpan > 1)
					$attr['colspan'] = $child->colSpan;
				break;

			case 'listelement':
				$tag = 'ul';
				break;

			case 'teletypeelement':
				if ($htmlConfig->has('tag_teletype'))
					$tag = $htmlConfig->get('tag_teletype');
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
		foreach ($child->children as $c) {
			$val .= $this->renderElement($c);
		}

		$val .= $suffix;
		return $this->renderHtmlElement($tag, $val, $empty, $attr);

	}


	/**
	 * Erzeugt ein HTML-Element.
	 *
	 * @param String $tag Name des Tags
	 * @param String $value Inhalt
	 * @param boolean $empty abk�rzen, wenn Inhalt leer ("<... />")
	 * @param array $attr Attribute als Array<String,String>
	 * @return String
	 */
	function renderHtmlElement($tag, $value, $empty, $attr = array())
	{
		$htmlConfig = Configuration::subset(['editor','html']);
		if ($tag == '')
			return $value;

		$val = '<' . $tag;
		foreach ($attr as $attrName => $attrInhalt) {
			$val .= ' ' . $attrName . '="' . $attrInhalt . '"';
		}

		if ($value == '' && $empty) {
			// Inhalt ist leer, also Kurzform verwenden.
			// Die Kurzform ist abh�ngig vom Rendermode.
			// SGML=<tag>
			// XML=<tag />
			if ($htmlConfig->get('rendermode') == 'xml') {
				$val .= ' />';
				return $val;
			} else {
				$val .= '>';
				return $val;
			}
		}

		$val .= '>' . $value . '</' . $tag . '>';
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
		$this->footnotes = array();

		foreach ($this->children as $child)
			$this->renderedText .= $this->renderElement($child);

		foreach ($this->footnotes as $child)
			$this->renderedText .= $this->renderElement($child);

		return $this->renderedText;
	}
}

?>