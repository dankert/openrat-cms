<?php

namespace util;

use cms\model\BaseObject;
use cms\model\Page;
use cms\model\Url as MUrl;
use \util\exception\ObjectNotFoundException;
use wikiparser\model\DocumentElement;
use wikiparser\parser\WikiParser;

/**
 * Transformieren eines Textes.<br>
 * Ein Text wird geparst und neu gerendert.
 *
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class Transformer
{
	var $text = '';
	var $doc;
	var $page;
	var $element;
    /**
     * @var \cms\generator\PageContext
     */
    public $pageContext;

    function transform()
	{
		$this->parseDocument();
		$this->renderDocument();

		$this->text = $this->renderedText;
	}


	/**
	 * Parsen eines Textes.<br>
	 * Der Text muss in der Eigenschaft 'text' bereits zur Verf�gung stehen.<br>
	 * Der Text wird geparst und als DOM (Document object model) intern gespeichert.
	 */

	function parseDocument()
	{
		// Den Text zeilenweise aufteilen.
		$zeilen = explode("\n", $this->text);

		// Dokument erzeugen und den Text parsen.
		$parser = new WikiParser();
		$this->doc = new DocumentElement();
		$this->doc->element = $this->element;
		$this->doc->parse($zeilen);
		$this->doc->page = $this->page;
		$this->doc->pageContext = $this->pageContext;
	}


	/**
	 * Das interne Dokumente wird gerendet.<br>
	 * Die fertige Ausgabe steht anschliessend in der Eigenschaft "renderedText" zur Verf�gung.
	 */
	function renderDocument()
	{
		$this->doc->encodeHtml = !$this->element->html;

		$text = $this->doc->render($this->page->mimeType());

		// Liste der verlinkten Objekt-Ids.
		// Die Objekt-Ids werden absteigend sortiert, damit z.B. '33' vor '3' ersetzt wird.		
		$linkedObjectIds = $this->doc->linkedObjectIds;
		rsort($linkedObjectIds, SORT_NUMERIC);

		// Links object:nnn ersetzen
		//
		// Das Dokument-Objekt hat keine Information ueber die aktuelle Seite,
		// daher werden die Links auf Objekte hier gesetzt.
		foreach ($linkedObjectIds as $objectId) {
			$linkFormat = $this->pageContext->getLinkScheme();
			$target = new BaseObject($objectId);
			try {
				$target->load();
				$sourcePage = new Page( $this->pageContext->sourceObjectId );
				$targetPath = $linkFormat->linkToObject( $sourcePage, $target );

				// Hack: Sonderzeichen muessen in URLs maskiert werden, aber nur bei URLs die aus Link-Objekten kommen, bei allem
				// anderen (insbesondere Preview-Links zu andereen Seiten) darf die Umsetzung nicht erfolgen.
				// Der Renderer kann dies nicht tun, denn der erzeugt nur "object://..."-URLs.
				// Beispiel: "...?a=1&b=2" wird zu "...?a=1&amp;b=2"
				if ($target->isUrl) {
					$l = new MUrl($objectId);
					$l->load();
					if ($this->page->mimeType() == 'text/html')
						$targetPath = htmlspecialchars($targetPath);
				}
			} catch (ObjectNotFoundException $e) {
				$targetPath = '';
			}

			$text = str_replace('object:' . $objectId, $targetPath, $text);
			$text = str_replace('object://' . $objectId, $targetPath, $text);
		}

		$this->renderedText = $text;
	}
}

