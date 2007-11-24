<?php

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

	function transform()
	{
		$this->parseDocument();
		$this->renderDocument();
		
		$this->text = $this->renderedText;
	}



	/**
	 * Parsen eines Textes.<br>
	 * Der Text muss in der Eigenschaft 'text' bereits zur Verfügung stehen.<br>
	 * Der Text wird geparst und als DOM (Document object model) intern gespeichert.
	 */	
	
	function parseDocument()
	{
		// Den Text zeilenweise aufteilen.
		$zeilen = explode("\n",$this->text);
		
		// Dokument erzeugen und den Text parsen.
		$this->doc          = new DocumentElement();
		$this->doc->element = $this->element;
		$this->doc->parse( $zeilen );
	}



	/**
	 * Das interne Dokumente wird gerendet.<br>
	 * Die fertige Ausgabe steht anschliessend in der Eigenschaft "renderedText" zur Verfügung.
	 */	
	function renderDocument()
	{
		$text = $this->doc->render( $this->page->mimeType() );

		// Liste der verlinkten Objekt-Ids.
		// Die Objekt-Ids werden absteigend sortiert, damit z.B. '33' vor '3' ersetzt wird.		
		$linkedObjectIds = $this->doc->linkedObjectIds;
		rsort( $linkedObjectIds,SORT_NUMERIC );

		// Links object:nnn ersetzen
		//
		// Das Dokument-Objekt hat keine Information über die aktuelle Seite,
		// daher werden die Links auf Objekte hier gesetzt.
		foreach( $linkedObjectIds as $objectId )
		{
			$targetPath = $this->page->path_to_object( $objectId );
			$text = str_replace( 'object:'  .$objectId, $targetPath, $text );
			$text = str_replace( 'object://'.$objectId, $targetPath, $text );
		}
		
		$this->renderedText = $text;
	}
}

?>