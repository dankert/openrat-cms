<?php

namespace wikiparser\model;

use Art;
use Ein;
use wikiparser\model\AbstractElement;

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
class DocumentElement extends AbstractElement
{
	var $linkedObjectIds = array();
	var $page;

	/**
	 * Fu�noten.
	 *
	 * @var Array
	 */
	var $footnotes = array();

	var $encodeHtml = false;

	/**
	 * Ein Text wird geparst.<br>
	 * <br>
	 * Zerlegt den Text zeilenweise und erzeugt die Unterobjekte.<br>
	 *
	 * @param Ein- oder mehrzeiliger roher Text
	 * @param Art des Parsens, Default=Wiki
	 */
	function parse($text, $type = 'wiki')
	{
		$parserClass = ucfirst(strtolower($type)) . 'Parser';
		$parser = new $parserClass();

		$this->children = $parser->parse($text);
		$this->linkedObjectIds = $parser->linkedObjectIds;
	}


	/**
	 * Rendering des Dokumentes.<br>
	 * Die Art und Weise des Renderns ist in Abh�ngigkeit zum
	 * �bergebenen Mime-Type.
	 *
	 * @param String $mimeType Mime-Type, z.B. "text/html"
	 * @return String
	 */
	function render($mimeType)
	{

		switch ($mimeType) {
			case 'text/html':
				$this->type = 'html';
				break;
			case 'text/plain':
				$this->type = 'text';
				break;
			case 'application/pdf':
				$this->type = 'pdf';
				break;
			case 'application/html-dom':
				$this->type = 'htmlDom';
				break;
			case 'application/x-latex':
				$this->type = 'latex';
				break;
			case 'text/xhtml':
				$this->type = 'xhtml';
				break;
			case 'application/docbook+xml':
				$this->type = 'docBook';
				break;
			default:
				$this->type = 'html';
		}

		$rendererClass = ucfirst($this->type) . 'Renderer';

		$renderer = new $rendererClass();
		$renderer->children = $this->children;
		$renderer->page = $this->page;
		$renderer->linkedObjectIds = $this->linkedObjectIds;
		$renderer->encodeHtml = $this->encodeHtml;

		return $renderer->render();
	}
}

?>