<?php

// Die DOM-Klassen sind nur bei der Erzeugung von Seiten notwendig.
if	( !empty($REQ[REQ_PARAM_ACTION]) && in_array($REQ[REQ_PARAM_ACTION],array('pageelement','page','folder')) )
{
	require_once( OR_TEXTCLASSES_DIR."parser/WikiParser.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."renderer/HtmlRenderer.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."renderer/XhtmlRenderer.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."renderer/HtmlDomRenderer.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."renderer/PdfRenderer.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."renderer/TextRenderer.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."renderer/DocBookRenderer.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."renderer/LatexRenderer.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."AbstractElement.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."QuoteElement.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."CodeElement.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."DocumentElement.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."EmphaticElement.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."FootnoteElement.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."HeadlineElement.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."LineBreakElement.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."LinkElement.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."ImageElement.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."TeletypeElement.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."SpeechElement.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."ListElement.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."ListEntryElement.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."NumberedListElement.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."ParagraphElement.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."RawElement.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."StrongElement.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."TableElement.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."TableLineElement.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."TableCellElement.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."TableOfContentElement.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."TextElement.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."DefinitionListElement.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."DefinitionItemElement.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."InsertedElement.class.".PHP_EXT );
	require_once( OR_TEXTCLASSES_DIR."RemovedElement.class.".PHP_EXT );
}
?>