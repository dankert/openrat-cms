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
class DocumentElement extends AbstractElement
{
	var $linkedObjectIds = array();
	
	/**
	 * Fußnoten.
	 *
	 * @var Array
	 */
	var $footnotes       = array();

	var $encodeHtml = false;

	/**
	 * Ein Text wird geparst.<br>
	 * <br>
	 * Zerlegt den Text zeilenweise und erzeugt die Unterobjekte.<br>
	 * 
	 * @param Ein- oder mehrzeiliger roher Text
	 * @param Art des Parsens, Default=Wiki
	 */
	function parse( $text, $type='wiki' )
	{
		$parserClass = ucfirst(strtolower($type)).'Parser';
		$parser = new $parserClass();
		
		$this->children = $parser->parse( $text );
		$this->linkedObjectIds = $parser->linkedObjectIds;
	}




	
	/**
	 * Rendering des Dokumentes.<br>
	 * Die Art und Weise des Renderns ist in Abhängigkeit zum
	 * übergebenen Mime-Type.
	 *
	 * @param String $mimeType Mime-Type, z.B. "text/html"
	 * @return String
	 */
	function render( $mimeType )
	{
		
		switch( $mimeType )
		{
			case 'text/html':
				$this->type = 'html';
				break;
			case 'text/plain':
				$this->type = 'text';
				break;
			case 'application/pdf':
				$this->type = 'pdf';
				break;
			case 'application/html-editor':
				$this->type = 'htmlEditor';
				break;
			case 'application/html-dom':
				$this->type = 'htmlDom';
				break;
			default:
				$this->type = 'html';
		}
		
		$rendererClass = ucfirst($this->type).'Renderer';
		
		$renderer = new $rendererClass();
		$renderer->children        = $this->children;
		$renderer->linkedObjectIds = $this->linkedObjectIds;
		$renderer->encodeHtml      = $this->encodeHtml;
			
		return $renderer->render();
	}
}

?>