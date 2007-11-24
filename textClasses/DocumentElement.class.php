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



	/**
	 * Ein Text wird geparst.<br>
	 * <br>
	 * Zerlegt den Text zeilenweise und erzeugt die Unterobjekte.<br>
	 * 
	 * @param Ein- oder mehrzeiliger roher Text
	 */
	function parse( $text )
	{
//		set_time_limit(1);
		$zeilen = array();
		$nr     = 0;
		
		foreach( $text as $t )
		{
//			$t = $this->fixLinks( $t );  // Verweise vervollstaendigen.
			$zeilen[++$nr] = new Line( rtrim($t) );
		}

		// $zeilen enthält eine Liste von Zeilenobjekten.
		// Der Index ist die Zeilennr. und beginnt bei 1.
//		Html::debug($zeilen,"Zeilen");
		
		$this->children = $this->parseMultiLineText( $zeilen );
	}



	/**
	 * Erzeugt aus einer Liste von Zeilenobjekten ein DOM in Form eines Objektbaumes.
	 * 
	 * @param zeilen Liste von Zeilenobjekten. Array beginnt bei 1.
	 * @return Liste von Textobjekten
	 */
	function parseMultiLineText( $zeilen )
	{
		global $conf;
		
		$children     = array();           // Initiales Anlegen der Unterobjektliste.
		$anzahlZeilen = count( $zeilen );  // Anzahl Zeilen
		
		// Erzwingt am Anfang und Ende eine leere Zeile, damit
		// nächste und vorige Zeile in der folgenden Schleife immer gefüllt ist.
		$zeilen[0]               = new Line('');
		$zeilen[$anzahlZeilen+1] = new Line(''); 
		
		for	( $zeileNr=1; $zeileNr<=$anzahlZeilen; $zeileNr++ )
		{

			$letzteZeile   = $zeilen[$zeileNr-1];
			$dieseZeile    = $zeilen[$zeileNr  ];
			$naechsteZeile = $zeilen[$zeileNr+1];

//			Html::debug($dieseZeile,"Zeile");
			
			// Leerzeilen ignorieren
			if	( $dieseZeile->isEmpty )
			{
				continue;
			}
			
			// Inhaltsverzeichnis
			// Text nicht parsen
			if	( $dieseZeile->isTableOfContent )
			{
				$children[] = new TableOfContentElement();
				continue;
			}


			// Parser deaktiviert für diese Zeile
			// Text nicht parsen
			if	( $dieseZeile->isUnparsed )
			{
				$children[] = new TextElement( $dieseZeile->value );
				continue;
			}


			// Ueberschriften Teil 1
			// Markierung in der Folgezeile mit "...", "---" oder "==="			
			if	( $naechsteZeile->isHeadlineUnderline )
			{
				$headline = new HeadlineElement($naechsteZeile->level);
				$headline->children = $this->parseSimple( $dieseZeile->value);
				$children[] = $headline;
				$zeileNr++;
				continue; // Naechste Zeile
			}


			// Ueberschriften Teil 2
			// Markierung mit "+++..." am Zeilenbeginn.			
			if	( $dieseZeile->isHeadline )
			{
				$headline = new HeadlineElement($dieseZeile->level);
				$headline->children = $this->parseSimple( $dieseZeile->value);
				$children[] = $headline;
				continue; // Naechste Zeile
			}
			
			// Zitate Teil 1
			// Zitat ist in separater Zeile angekündigt			
			if	( $dieseZeile->isQuote )
			{
				$bisZeileNr = $zeileNr+1;
				do
				{
					$bisZeileNr++;
				}
				while( !$zeilen[$bisZeileNr]->isQuote && $bisZeileNr<=$anzahlZeilen );
				
				$quote = new QuoteElement();
				$zeilenAuszug = array();
				$nr=0;
				for( $zn=$zeileNr+1;$zn<$bisZeileNr;$zn++)
				{
					$zeilenAuszug[++$nr] = $zeilen[$zn];
				}
				$quote->children = $this->parseMultiLineText($zeilenAuszug);
				$zeileNr = $bisZeileNr+1;
				$children[] = $quote;
				continue;
			}
			

			
			// Zitate Teil 2
			// Markierung am Zeilenanfang
			if	( $dieseZeile->isQuotePraefix )
			{
				$bisZeileNr = $zeileNr;
				while( $bisZeileNr<=$anzahlZeilen && $zeilen[$bisZeileNr]->isQuotePraefix  )
					$bisZeileNr++;
				$bisZeileNr--;
//				Html::debug($bisZeileNr,"Bis-Zeile-Nr.");
				$quote = new QuoteElement();
				
				$zeilenAuszug = $this->getListenAuszug( $zeilen,$zeileNr,$bisZeileNr);
//				Html::debug($zeilenAuszug,"Auszug");
//				die();
				$quote->children = $this->parseMultiLineText($zeilenAuszug);
				$zeileNr = $bisZeileNr;
				$children[] = $quote;
				continue;
			}
			

			
			// Definitionsliste
			// Markierung am Zeilenanfang
			if	( $dieseZeile->isDefinition )
			{
				$bisZeileNr = $zeileNr;
				while( $bisZeileNr<=$anzahlZeilen && $zeilen[$bisZeileNr]->isDefinition )
					$bisZeileNr++;
				$bisZeileNr--;

				$defList = new DefinitionListElement();
				
				$zeilenAuszug = $this->getListenAuszug( $zeilen,$zeileNr,$bisZeileNr);
//				Html::debug($zeilenAuszug,"Auszug");
//				die();
				foreach( $zeilenAuszug as $zeile )
				{
					$sep = $conf['editor']['text-markup']['definition-sep'];
					list($defKey, $defValue) = explode($sep, $zeile->value);
					
					$defEntry = new DefinitionItemElement();
					$defEntry->key       = $defKey;
					$defEntry->children  = $this->parseSimple($defValue);
					$defList->children[] = $defEntry;
				}
				$zeileNr = $bisZeileNr;
				$children[] = $defList;
				continue;
			}
			

			
			// Code
			if	( $dieseZeile->isCode)
			{
				$bisZeileNr = $zeileNr+1;
				while( $bisZeileNr<$anzahlZeilen && !$zeilen[$bisZeileNr]->isCode  )
					$bisZeileNr++;
				
				$code = new CodeElement();
				$code->language = trim($dieseZeile->value);
				
				for( $zn=$zeileNr+1;$zn<$bisZeileNr;$zn++)
				{
					$code->children[] = new TextElement( $zeilen[$zn]->source );
					
					if	( $zn < $bisZeileNr-1 )
						$code->children[] = new LineBreakElement();
				}
				$zeileNr = $bisZeileNr;
				$children[] = $code;
				continue;
			}


			// Tabellen
			if	( $dieseZeile->isTable )
			{
				$bisZeileNr = $zeileNr;
				while( $bisZeileNr<=$anzahlZeilen && $zeilen[$bisZeileNr]->isTable )
					$bisZeileNr++;
				
				$tabelle = new TableElement();
				$zeilenAuszug = array();
				for( $zn=$zeileNr;$zn<=$bisZeileNr;$zn++)
				{
					$zeilenAuszug[$zn-$zeileNr+1] = $zeilen[$zn];
				}
				$tabelle->children = $this->parseTable($zeilenAuszug);
				$children[] = $tabelle;
				$zeileNr = $bisZeileNr+1;
				continue;
			}


			// Listen
			if	( $dieseZeile->isList || $dieseZeile->isNumberedList )
			{
				
				$bisZeileNr = $zeileNr;
				while( $bisZeileNr<=$anzahlZeilen &&
				       ($zeilen[$bisZeileNr]->isList || $zeilen[$bisZeileNr]->isNumberedList) )
					$bisZeileNr++;
				$bisZeileNr--;

				if	( $dieseZeile->isList )
					$liste = new ListElement();
				else
					$liste = new NumberedListElement();
					
				$zeilenAuszug = array();
				$nr=0;

				for( $zn=$zeileNr;$zn<=$bisZeileNr;$zn++)
				{
					$zeilenAuszug[++$nr] = $zeilen[$zn];
				}

				$liste->children = $this->parseList($zeilenAuszug,1);
				$children[] = $liste;
				$zeileNr = $bisZeileNr;
				continue;
			}



			if	( $dieseZeile->isNormal )
			{
//				Html::debug($dieseZeile,"normale Zeile");
				// Textabsaetze
				$bisZeileNr = $zeileNr;
				while( $bisZeileNr <= $anzahlZeilen      &&
				       $zeilen[$bisZeileNr  ]->isNormal     )
				{
					$bisZeileNr++;
				}
				$bisZeileNr--;
//				Html::debug($zeileNr,"Zeile");
//				Html::debug($bisZeileNr,"bisZeile-P");
//				die();	
				
				$para = new ParagraphElement();
				for( $zn=$zeileNr;$zn<=$bisZeileNr;$zn++)
				{
					if	( !$zeilen[$zn]->isNormal )
						continue;
	
					if	( $zeilen[$zn]->isUnparsed )
						$para->children[] = new TextElement( $zeilen[$zn]->source );
						
					foreach( $this->parseSimple($zeilen[$zn]->value) as $e )
						$para->children[] = $e;
					
					if	( $zn < $bisZeileNr )
						$para->children[] = new LineBreakElement();
				}
				
				$zeileNr = $bisZeileNr;
				$children[] = $para;
				
				continue;
			}
			
			Html::debug($dieseZeile,"Unbekannte Zeile");
			die( 'unknown line: '.$dieseZeile );
		}
		
		return $children;
	}



	function getListenAuszug( $liste, $von, $bis )
	{
		$auszug = array();
		$idx    = 0;
		
		for( $j=$von;$j<=$bis;$j++)
		{
			$auszug[++$idx] = new Line($liste[$j]->value);
		}
		
		return $auszug;
	}
	
	
	/**
	 * Parsen einer mehrzeiligen Liste 
	 */
	function parseList( $zeilen,$tiefe )
	{
		$children = array();
		$anzahlZeilen = count( $zeilen );
		$entry    = null;
		for	( $zeileNr=1; $zeileNr<=$anzahlZeilen; $zeileNr++ )
		{
			$dieseZeile = $zeilen[$zeileNr];

			// Listen
			if	( $dieseZeile->indent <= $tiefe )
			{
				if	( $zeileNr > 1 )
					$children[] = $entry;
					
				$entry = new ListEntryElement();
				$entry->children = $this->parseSimple( $dieseZeile->value );
			}
			else
			{
				// Weitere Schachtelung der Liste
				if	( $dieseZeile->isList )
					$liste = new ListElement();
				else
					$liste = new NumberedListElement();				

				$bisZeileNr = $zeileNr;

				while( $bisZeileNr<=$anzahlZeilen && $zeilen[$bisZeileNr]->indent != $tiefe )
					$bisZeileNr++;
				$bisZeileNr--;
				
//				echo "von $zeileNr bis $bisZeileNr (insges. $anzahlZeilen)";
				$zeilenAuszug = array();
				$nr=0;
				for( $zn=$zeileNr;$zn<=$bisZeileNr;$zn++)
				{
					$zeilenAuszug[++$nr] = $zeilen[$zn];
				}
				$liste->children = $this->parseList($zeilenAuszug,$tiefe+1);
				$entry->children[] = $liste;
				$zeileNr = $bisZeileNr;
			}
		}
		$children[] = $entry;
		
		return $children;
	}


	/**
	 * Parsen einer Tabelle.
	 */
	function parseTable( $zeilen )
	{
		$children = array();
		$anzahlZeilen = count( $zeilen );
		for	( $zeileNr=1; $zeileNr<=$anzahlZeilen; $zeileNr++ )
		{
			$dieseZeile    = $zeilen[$zeileNr];

			$zeile = new TableLineElement();
			
			// Listen
			$zellen  = explode('|',$dieseZeile->source);
			$colSpan = 1;
			
			foreach( $zellen as $zellenInhalt )
			{
				if	( $zellenInhalt=='')
				{
					$colSpan++;
					continue;
				}
				
				$zelle = new TableCellElement();
				$zelle->colSpan = $colSpan;
				$colSpan = 1;
				
				if	( substr($zellenInhalt,0,1) == '!' )
				{
					$zelle->isHeading = true;
					$zellenInhalt     = substr($zellenInhalt,1);
				}
				
				$zelle->children = $this->parseSimple( $zellenInhalt);
				
				$zeile->children[] = $zelle;
			}
			
			$children[] = $zeile;
		}
		
		return $children;
	}
	


	function parseLinks( $text )
	{
		$conf = Session::getConfig();
		$text_markup = $conf['editor']['text-markup']; 

		$posM = strpos($text,'"'.$text_markup['linkto'].'"');

		if	( $posM === false )
			return false;

		$posL = strpos(substr($text,0,$posM-1),'"');

		if	( $posL === false )
			return false;

		$posR = strpos($text,'"',$posM+4);

		if	( $posR === false )
			return false;

		$parts = array();			
		$parts[] = substr($text,0      ,$posL        );  // Anfang
		$parts[] = substr($text,$posL+1,$posM-$posL-1);  // Linktext
		$parts[] = substr($text,$posM+4,$posR-$posM-4);  // Verweisziel
		$parts[] = substr($text,$posR+1              );  // Rest

		return $parts;
	}
	
	
	/**
	 * Erzeugt ein Bildobjekt
	 */
	function parseImages( $text )
	{
		$posM = strpos($text,'image:');

		if	( $posM === false )
			return false;

		$posL = strpos(substr($text,0,$posM-1),'"');

		if	( $posL === false )
			return false;

		$posR = strpos($text,'"',$posM+4);

		if	( $posR === false )
			return false;

		$parts = array();			
		$parts[] = substr($text,0      ,$posL        );  // Anfang
		$parts[] = substr($text,$posL+1,$posM-$posL-1);  // Linktext
		$parts[] = substr($text,$posM+4,$posR-$posM-4);  // Verweisziel
		$parts[] = substr($text,$posR+1              );  // Rest
		
		return $parts;
	}
	
	
		
	function parseSimpleParts( $text,$sepLinks,$sepRechts )
	{
		$posL = strpos($text,$sepLinks);

		if	( $posL === false )
			return false;

		$posR = strpos($text,$sepRechts,$posL+strlen($sepLinks));

		if	( $posR === false )
			return false;

		$parts = array();			
		$parts[] = substr($text,0      ,$posL        );
		$parts[] = substr($text,$posL+strlen($sepLinks),$posR-$posL-strlen($sepLinks));
		$parts[] = substr($text,$posR+strlen($sepRechts)                             );

		return $parts;
	}
	
	
	
	/**
	 * 
	 */
	function parseEscapes( $text )
	{
		$posL = strpos($text,'\\');

		if	( $posL === false )
			return false;

		$parts = array();			
		$parts[] = substr($text,0         ,$posL );
		$parts[] = substr($text,$posL+1,1 );
		$parts[] = substr($text,$posL+2   );

		return $parts;
	}
	
	
	
	
	function parseSimpleElement( $text,$sepL,$sepR,$className )
	{
		$erg = $this->parseSimpleParts( $text,$sepL,$sepR );
		if	( is_array($erg) )
		{
			$idx   = -1;
			$elements = array();
			
			$davor = $this->parseSimple($erg[++$idx]);
			foreach( $davor as $davorEl )
				$elements[] = $davorEl;

			$newEl = new $className();
			$newEl->children = $this->parseSimple($erg[++$idx]); 
			$elements[] = $newEl;

			$danach = $this->parseSimple($erg[++$idx]);
			foreach( $danach as $danachEl )
				$elements[] = $danachEl;
			return $elements;
		}
		
		return false;
	}
	
	

	function fixLinks( $text )
	{
		// Text->... umsetzen nach "Text"->... (Anfuehrungszeichen ergaenzen)
		$text = ereg_replace( '([A-Za-z0-9._-]+)\-\>','"\\1"->',$text );
	
		// ...->Link umsetzen nach ...->"Link" (Anfuehrungszeichen ergaenzen)
		$text = ereg_replace( '\->([A-Za-z0-9\.\:\_\/\,\?\=\&-]+)','->"\\1"',$text );

		// alleinstehende externe Links
		// Funktioniert nicht richtig, erstmal deaktiviert.
//		$text = ereg_replace( '((https?|ftps?|news|gopher):\/\/([A-Za-z0-9._\/\,-]+))([^"])','"\\1"->"\\1"\\2',$text );

		// alleinstehende E-Mail Adressen
		$text = ereg_replace( '([A-Za-z0-9._-]+@[A-Za-z0-9\.\_\-]+)([^A-Za-z0-9\.\_\-\"])','"\\1"->"mailto:\\1"\\2',$text );

		// Bilder
		$text = ereg_replace( 'ima?ge?:\/?\/?([A-Za-z0-9\.\:\_\/\,\?\=\&-]+)','{\\1}',$text );
		
		return $text;
	}
	
	
	
	/**
	 * Diese Methode parst einen einfachen, einzeiligen Text und zerlegt diesen in seine Bestandteile.
	 */		
	function parseSimple( $text )
	{
		$conf = Session::getConfig();
		$text_markup = $conf['editor']['text-markup'];
		
		$text = $this->fixLinks($text);
		$elements = array();
		
		if	( trim($text) == '' )
			return $elements;

		$erg = $this->parseLinks( $text );
		if	( is_array($erg) )
		{
			$idx   = -1;
			
			$davor = $this->parseSimple($erg[++$idx]);
			foreach( $davor as $davorEl )
				$elements[] = $davorEl;

			$link = new LinkElement();
			$link->children = $this->parseSimple($erg[++$idx]); 
			$link->setTarget( $erg[++$idx] ); 
			
			if	( $link->objectId != 0 )
				$this->linkedObjectIds[] = $link->objectId;
			$elements[] = $link;

			$danach = $this->parseSimple($erg[++$idx]);
			foreach( $danach as $danachEl )
				$elements[] = $danachEl;

			return $elements;
		}


		$erg = $this->parseSimpleParts( $text,$text_markup['image-begin'],$text_markup['image-end'] );
		if	( is_array($erg) )
		{
			$idx   = -1;
			
			$davor = $this->parseSimple($erg[++$idx]);
			foreach( $davor as $davorEl )
				$elements[] = $davorEl;

			$image = new ImageElement();
			$t = new TextElement($erg[++$idx]);
			$image->setTarget( intval($t->text) );
			$t->text = '';
			$image->children[] = $t;
			 
			if	( $image->objectId != 0 )
				$this->linkedObjectIds[] = $image->objectId;
			$elements[] = $image;

			$danach = $this->parseSimple($erg[++$idx]);
			foreach( $danach as $danachEl )
				$elements[] = $danachEl;

			return $elements;
		}

		$erg = $this->parseEscapes( $text );
		if	( is_array($erg) )
		{
			$idx   = -1;
			
			$davor = $this->parseSimple($erg[++$idx]);
			foreach( $davor as $davorEl )
				$elements[] = $davorEl;

			$t = new TextElement($erg[++$idx]);
			$elements[] = $t;

			$danach = $this->parseSimple($erg[++$idx]);
			foreach( $danach as $danachEl )
				$elements[] = $danachEl;

			return $elements;
		}

		$erg = $this->parseSimpleElement( $text,$text_markup['footnote-begin'],$text_markup['footnote-end'],'FootnoteElement' );
		if	( is_array($erg) )
			return $erg;

		$erg = $this->parseSimpleElement( $text,$text_markup['strong-begin'],$text_markup['strong-end'],'StrongElement' );
		if	( is_array($erg) )
			return $erg;

		$erg = $this->parseSimpleElement( $text,$text_markup['emphatic-begin'],$text_markup['emphatic-end'],'EmphaticElement' );
		if	( is_array($erg) )
			return $erg;

		$erg = $this->parseSimpleElement( $text,$text_markup['code-begin'],$text_markup['code-end'],'TeletypeElement' );
		if	( is_array($erg) )
			return $erg;

		$erg = $this->parseSimpleElement( $text,$text_markup['insert-begin'],$text_markup['insert-end'],'InsertedElement' );
		if	( is_array($erg) )
			return $erg;

		$erg = $this->parseSimpleElement( $text,$text_markup['remove-begin'],$text_markup['remove-end'],'RemovedElement' );
		if	( is_array($erg) )
			return $erg;

		$erg = $this->parseSimpleElement( $text,$text_markup['speech-begin'],$text_markup['speech-end'],'SpeechElement' );
		if	( is_array($erg) )
			return $erg;

		
		$t = new TextElement($text);
		$elements[] = $t;
		
		return $elements;
	}


	
	function renderElement( $child )
	{
		global $conf;
		
		switch( $this->type )
		{
			case 'text/html':
			
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
								$child->children[] = new TextElement(str_repeat('&nbsp;&nbsp;',$h->level));
								$t = new TextElement( $h->getText() );
								$l = new LinkElement();
								$l->fragment=$h->getName();
								$l->children[] = $t;
								$child->children[] = $l;
								$child->children[] = new LineBreakElement();
							}
						}
						break;

					case 'textelement':
						$tag = '';
//						$tag = 'span';
						$val = $this->replaceHtmlChars( $child->text );

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
								
						$val = '<sup><small>'.$nr.'</small></sup>';

						if	( $nr == 1 )
						{
							$this->footnotes[] = new TextElement('&mdash;');
							$le = new LinkElement();
							$le->name = "footnote";
							$this->footnotes[] = $le;
							$this->footnotes[] = new TextElement('&mdash;');
						}
						$this->footnotes[] = new LineBreakElement();
						$this->footnotes[] = new TextElement($val);
						$this->footnotes[] = new TextElement(' ');
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

				$val .= $praefix;
				foreach( $child->children as $c )
				{
					$val .= $this->renderElement( $c );
				}

				$val .= $suffix;
//				echo "text:$val";
				return $this->renderHtmlElement($tag,$val,$empty,$attr);
				
			case 'text/plain':
			default:
				$className = strtolower(get_class($child));
				$val = '';

				if	( $className == 'textelement' )
					$val .= $child->text;
				
				foreach( $child->children as $c )
				{
					$val .= $this->renderElement( $c );
				}

				return $val;
			
//				die( 'unknown document type: '.$this->type );
		}
		
	}



	/**
	 * 
	 */
	function replaceHtmlChars( $text )
	{
		global $conf;
		
		foreach( explode(' ',$conf['editor']['html']['replace']) as $repl )
		{
			list( $ersetze, $mit ) = explode(':',$repl);
			$text = str_replace($ersetze, $mit, $text);
		}
		
		return $text;
	}


	
	function render( $extension='txt' )
	{
		global $conf;
		
		if	( isset($conf['mime-types'][$extension]))
			$this->type = $conf['mime-types'][$extension];
		else
			$this->type = 'text/html';
			
		$this->renderedText = '';
		$this->footnotes    = array();
		
		foreach( $this->children as $child )
			$this->renderedText .= $this->renderElement( $child );

		foreach( $this->footnotes as $child )
			$this->renderedText .= $this->renderElement( $child );
			
		return $this->renderedText;
	}
	
	
	
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
			// Die Kurzform ist abhängig vom Rendermode.
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
	
}

?>