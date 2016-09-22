<?php

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
class WikiParser
{
	var $linkedObjectIds = array();
	
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

		// $zeilen enth�lt eine Liste von Zeilenobjekten.
		// Der Index ist die Zeilennr. und beginnt bei 1.
//		Html::debug($zeilen,"Zeilen");
		
		return $this->parseMultiLineText( $zeilen );
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
		// n�chste und vorige Zeile in der folgenden Schleife immer gef�llt ist.
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


			// Parser deaktiviert f�r diese Zeile
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
			// Zitat ist in separater Zeile angek�ndigt			
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
	
	

	/**
	 * Zerlegt einen einfachen Text in ein Array.
	 *
	 * @param String $text Eingabe-Test
	 * @param String $sepLinks Linke Begrenzung
	 * @param String $sepRechts Rechte Begrenzung
	 * @return Array
	 */
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
	
	
	
	/**
	 * Parst einen einzeiligen Text und erzeugt daraus Elemente.
	 *
	 * @param String $text Zu parsender Text
	 * @param String $sepL Linke Begrenzung des Elementes
	 * @param String $sepR Rechte Begrenzung des Elementes
	 * @param String $className Klassenname des Elementes, welches es zu erzeugen gilt.
	 * @return Array
	 */
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
	
	

	/**
	 * Korrigiert kurze Links.
	 *
	 * @param String $text
	 * @return String
	 */
	function fixLinks( $text )
	{
		// Text->... umsetzen nach "Text"->... (Anfuehrungszeichen ergaenzen)
		$text = preg_replace( '/([A-Za-z0-9._-]+)\-\>/','"\\1"->',$text );
	
		// ...->Link umsetzen nach ...->"Link" (Anfuehrungszeichen ergaenzen)
		$text = preg_replace( '/\->([A-Za-z0-9\.\:\_\/\,\?\=\&-]+)/','->"\\1"',$text );

		// alleinstehende externe Links
		// Funktioniert nicht richtig, erstmal deaktiviert.
//		$text = ereg_replace( '((https?|ftps?|news|gopher):\/\/([A-Za-z0-9._\/\,-]+))([^"])','"\\1"->"\\1"\\2',$text );

		// alleinstehende E-Mail Adressen
		$text = preg_replace( '/([A-Za-z0-9._-]+@[A-Za-z0-9\.\_\-]+)([^A-Za-z0-9\.\_\-\"])/','"\\1"->"mailto:\\1"\\2',$text );

		// Bilder
		$text = preg_replace( '/ima?ge?:\/?\/?([A-Za-z0-9\.\:\_\/\,\?\=\&-]+)/','{\\1}',$text );
		
		return $text;
	}
	
	
	
	/**
	 * Diese Methode parst einen einfachen, einzeiligen Text und zerlegt diesen in seine Bestandteile.
	 * 
	 * @param String $text
	 * @return Array
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

		$erg = $this->parseSimpleParts( $text,$text_markup['macro-begin'],$text_markup['macro-end'] );
		if	( is_array($erg) )
		{
			$idx   = -1;
			
			$davor = $this->parseSimple($erg[++$idx]);
			foreach( $davor as $davorEl )
				$elements[] = $davorEl;

			$macro = new MacroElement();
			$inh   = explode(' ',$erg[++$idx]);
			$macro->name = $inh[0];
			unset($inh[0]);
			foreach( $inh as $attr )
			{
				if	( empty($attr)) continue;
				
				list($attr_name,$attr_val) = explode($text_markup['macro-attribute-value-seperator'],$attr);
				$attr_val = trim($attr_val,$text_markup['macro-attribute-quote']);
				$macro->attributes[$attr_name] = $attr_val;
			}
			
			$elements[] = $macro;

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
}

?>