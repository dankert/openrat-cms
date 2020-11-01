<?php

namespace wikiparser\renderer;
use wikiparser\model\DefinitionItemElement;
use DefinitionListEntryElement;
use DefinitionListItemElement;
use File;
use wikiparser\model\LinkElement;
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
class HtmlDomRenderer
{
	var $linkedObjectIds = array();

	/**
	 * Fu�noten.
	 *
	 * @var Array
	 */
	var $footnotes = array();

	var $encodeHtml = false;

	var $path = array();

	var $domId = '';


	/**
	 * Rendert ein Dokument-Element.
	 *
	 * @param Object $child Element
	 * @return String
	 */
	function renderElement($child)
	{
		$this->path[] = $child;

		$val = '';
//		$val  = '<br/>';
//		foreach( $this->path as $p )
//			$val .= '&nbsp;&nbsp;&nbsp;&nbsp;';

//		$val .= '<a href="#'.$this->getPathAsString().'">_</a>';

		$attr = array();
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

		$praefix .= \cms\base\Language::lang('TEXT_MARKUP_' . strtoupper(substr(get_class($child), 0, -7)));

		switch (strtolower(get_class($child))) {
			case 'rawelement':
				$tag = '';
				$val = $child->src;

				break;

			case 'textelement':
				$tag = 'text';

				$val .= $child->text;

				break;


			case 'linkelement':

				$tag = 'a';
				if (!empty($child->name))
					$attr['name'] = $child->name;
				else
					$attr['href'] = htmlspecialchars($child->getUrl());

				if (Object::available($child->objectId)) {
					$file = new File($child->objectId);
					$file->load();
					$attr['title'] = $file->description;
					unset($file);
				}

				break;

			case 'imageelement':
				$empty = true;
				$attr['alt'] = '';

				if (!Object::available($child->objectId)) {
					$tag = '';
				} elseif (empty($attr['title'])) {
					$tag = 'img';
					$attr['src'] = $child->getUrl();
					$attr['border'] = '0';

					// Breite/H�he des Bildes bestimmen.
					$image = new File($child->objectId);

					$image->load();
					$attr['alt'] = $image->name;
					$attr['title'] = $image->description;

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
				$suffix = '<img src="./themes/default/images/editor/image.png">';
				break;

			case 'strongelement':
				$tag = 'strong';
				break;

			case 'macroelement':
				$tag = 'macro';
				$val = ucfirst($child->name);
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
				$tag = 'code';
				break;

			case 'numberedlistelement':
				$tag = 'ol';
				break;

			case 'listentryelement':
				$tag = 'li';
				break;

			default:

		}

		$val = $this->renderValue($val);
		$val = '<div class="entry">' . $praefix . $val . $suffix . '</div>';

		if (count($child->children) > 0) {
			$val .= '<ul class="tree">';
			foreach ($child->children as $c) {
				$val .= $this->renderElement($c);
			}
			$val .= '</ul>';
		}

//				echo "text:$val";

		unset($this->path[count($this->path) - 1]);
		return '<li><div class="tree" />' . $val . '</li>';
	}


	/**
	 * Rendert einen Inhalt.
	 *
	 * @param String $value Inhalt
	 * @return String
	 */
	function renderValue($value)
	{
		$val = '&nbsp;<em>' . $value . '</em>';
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

		$this->renderedText = '<ul class="tree">';

		foreach ($this->children as $child)
			$this->renderedText .= '' . $this->renderElement($child) . '';
		//$this->renderedText .= '<li><div class="tree" /><div class="entry" /><ul class="tree">'.$this->renderElement( $child ).'</ul></li>';

		foreach ($this->footnotes as $child)
			$this->renderedText .= '<li><div class="tree" /><div class="entry" /><ul class="tree">' . $this->renderElement($child) . '</ul></li>';
		$this->renderedText .= '</ul>';

		return $this->renderedText;
	}


	/**
	 *
	 */
	function getPathAsString()
	{
		$path = array();
		foreach ($this->path as $p) {
			$path[] = strtolower(substr(get_class($p), 0, -7));
		}

		return implode('_', $path);
	}
}

?>