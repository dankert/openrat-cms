<?php

// Die DOM-Klassen sind nur bei der Erzeugung von Seiten notwendig.
//if	( !empty($REQ[REQ_PARAM_ACTION]) && in_array($REQ[REQ_PARAM_ACTION],array('pageelement','page','folder')) )
{
	require_once( __DIR__.'/'.'parser/WikiParser.class.php' );
	require_once( __DIR__.'/'.'renderer/HtmlRenderer.class.php' );
	require_once( __DIR__.'/'.'renderer/XhtmlRenderer.class.php' );
	require_once( __DIR__.'/'.'renderer/HtmlDomRenderer.class.php' );
	require_once( __DIR__.'/'.'renderer/PdfRenderer.class.php' );
	require_once( __DIR__.'/'.'renderer/TextRenderer.class.php' );
	require_once( __DIR__.'/'.'renderer/DocBookRenderer.class.php' );
	require_once( __DIR__.'/'.'renderer/LatexRenderer.class.php' );
	require_once( __DIR__.'/'.'AbstractElement.class.php' );
	require_once( __DIR__.'/'.'QuoteElement.class.php' );
	require_once( __DIR__.'/'.'CodeElement.class.php' );
	require_once( __DIR__.'/'.'DocumentElement.class.php' );
	require_once( __DIR__.'/'.'EmphaticElement.class.php' );
	require_once( __DIR__.'/'.'FootnoteElement.class.php' );
	require_once( __DIR__.'/'.'HeadlineElement.class.php' );
	require_once( __DIR__.'/'.'LineBreakElement.class.php' );
	require_once( __DIR__.'/'.'LinkElement.class.php' );
	require_once( __DIR__.'/'.'ImageElement.class.php' );
	require_once( __DIR__.'/'.'MacroElement.class.php' );
	require_once( __DIR__.'/'.'TeletypeElement.class.php' );
	require_once( __DIR__.'/'.'SpeechElement.class.php' );
	require_once( __DIR__.'/'.'ListElement.class.php' );
	require_once( __DIR__.'/'.'ListEntryElement.class.php' );
	require_once( __DIR__.'/'.'NumberedListElement.class.php' );
	require_once( __DIR__.'/'.'ParagraphElement.class.php' );
	require_once( __DIR__.'/'.'RawElement.class.php' );
	require_once( __DIR__.'/'.'StrongElement.class.php' );
	require_once( __DIR__.'/'.'TableElement.class.php' );
	require_once( __DIR__.'/'.'TableLineElement.class.php' );
	require_once( __DIR__.'/'.'TableCellElement.class.php' );
	require_once( __DIR__.'/'.'TableOfContentElement.class.php' );
	require_once( __DIR__.'/'.'TextElement.class.php' );
	require_once( __DIR__.'/'.'DefinitionListElement.class.php' );
	require_once( __DIR__.'/'.'DefinitionItemElement.class.php' );
	require_once( __DIR__.'/'.'InsertedElement.class.php' );
	require_once( __DIR__.'/'.'RemovedElement.class.php' );
}
?>