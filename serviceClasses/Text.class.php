<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// DaCMS Content Management System
// Copyright (C) 2002 Jan Dankert, jandankert@jandankert.de
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
// ---------------------------------------------------------------------------
// $Log$
// Revision 1.10  2009-04-18 00:56:14  dankert
// Beim Verarbeiten von if-empty-Bereichen der Seitenvorlage keine regulären Ausdrücke mehr verwenden (da Binärausgaben wie PDF-Dokumente dabei beschädigt werden).
//
// Revision 1.9  2007-11-27 21:16:33  dankert
// Bugfix in "encodeHtmlSpecialChars()"
//
// Revision 1.8  2007-11-27 21:10:35  dankert
// Verschieben von "replaceHtmlChars()" nach Klasse Text.
//
// Revision 1.7  2007-11-24 13:22:04  dankert
// Neue Methode "encodeHtmlSpecialChars()"
//
// Revision 1.6  2007-11-17 13:36:06  dankert
// Methode "textdiff()" in Text-Klasse verschoben.
//
// Revision 1.5  2006/12/09 16:56:40  dankert
// Methode "encodeHtml()" ersetzt nun auch Umlaute gem. Konfiguration.
//
// Revision 1.4  2005/04/16 22:26:15  dankert
// Erweiterung Methode maxLength()
//
// Revision 1.3  2005/02/17 21:22:22  dankert
// Weitere Funktionen f?r HTML und BB-Code
//
// Revision 1.2  2004/05/02 15:04:16  dankert
// Einf�gen package-name (@package)
//
// Revision 1.1  2004/04/24 17:03:28  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


/**
 * Nuetzliche Funktionen fuer das Bearbeiten von Texten/Zeichenketten
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class Text
{
	/**
	 * Alias fuer Methode maxLength()
	 *
	 * @deprecated use maxlength() !
	 */
	function maxLaenge( $laenge,$text )
	{
		return Text::maxLength($text,$laenge);
	}


	/**
	 * Einen Text auf eine bestimmte Laenge begrenzen.
	 *
	 * Ist der Text zu lang, so wird abgeschnitten und
	 * eine Zeichenkette angehaengt.
	 *
	 * @param String Text, der zu begrenzen ist
	 * @param Integer maximale Laenge des Textes (optional)
	 * @param Text, der an gekuerzten Text angehangen wird (optional)
	 */
	function maxLength( $text,$laenge=20,$append='...',$where=STR_PAD_RIGHT )
	{
		if	( strlen($text) > $laenge )
		{
			if	( $where == STR_PAD_RIGHT )
				$text = substr($text,0,$laenge).$append;
			elseif	( $where == STR_PAD_BOTH )
				$text = substr($text,0,$laenge/2).$append.substr($text,strlen($text)-($laenge/2));
		}

		return $text;
	}


	/**
	 * Umwandeln von BB-Code in Wiki-Textauszeichnungen
	 *
	 * @param text zu bearbeitender Text
	 *
	 * @return String Ausgabe
	 */
	function bbCode2Wiki( $inhalt )
	{
		$inhalt = eregi_replace('\[b\]([^\[]*)\[\/b\]'       , '*\\1*' ,$inhalt);
		$inhalt = eregi_replace('\[i\]([^\[]*)\[\/i\]'       , '_\\1_' ,$inhalt);
		$inhalt = eregi_replace('\[code\]([^\[]*)\[\/code\]' , '=\\1=' ,$inhalt);

		$inhalt = eregi_replace('\[url\]([^\[]*)[\/url\]'          ,'"\\1"->"\\1"' ,$inhalt);
		$inhalt = eregi_replace('\[url=([^\[]*)\]([^\[]*)\[\/url\]','"\\2"->"\\1"' ,$inhalt);

		return $inhalt;
	}


	/**
	 * Umwandeln von einfachen HTML-Befehlen in Wiki-Textauszeichnungen
	 *
	 * @param text zu bearbeitender Text
	 *
	 * @return String Ausgabe
	 */
	function Html2Wiki( $inhalt )
	{
		$inhalt = eregi_replace('<b(.*)>(.*)</b>','*\\2*' ,$inhalt);
		$inhalt = eregi_replace('<i(.*)>(.*)</i>','_\\2_' ,$inhalt);
		$inhalt = eregi_replace('<a(.*)href="(.*)">(.*)</a>','"\\3"->"\\2"' ,$inhalt);

		return $inhalt;
	}


	/**
	 * HTML-Entitaeten fuer HTML-Tags verwenden
	 *
	 * @param String Text, in dem HTML-Tags umgewandelt werden sollen
	 * @return String Ausgabe
	 */
	function encodeHtml( $inhalt )
	{
		$inhalt = str_replace('&','&amp;',$inhalt);
		$inhalt = str_replace('<','&lt;' ,$inhalt);
		$inhalt = str_replace('>','&gt;' ,$inhalt);

		return $inhalt;
	}

	
	
	/**
	 * Ersetzt Sonderzeichen durch HTML-�quivalente.<br>
	 * Z.B. Ersetzt "(c)" durch "&copy;".
	 */
	function replaceHtmlChars( $text )
	{
		global $conf;
		
		foreach( explode(' ',$conf['editor']['html']['replace']) as $repl )
		{
			list( $ersetze, $mit ) = explode(':',$repl.':');
			$text = str_replace($ersetze, $mit, $text);
		}
		
		return $text;
	}
	
	
	
	/**
	 * HTML-Entitaeten fuer HTML-Tags verwenden
	 *
	 * @param String Text, in dem HTML-Tags umgewandelt werden sollen
	 * @return String Ausgabe
	 */
	function encodeHtmlSpecialChars( $inhalt )
	{
		return Text::replaceHtmlChars( $inhalt );
	}

	
	
	/**
	 * Vergleicht 2 Text-Arrays und ermittelt eine Darstellung der Unterschiede
	 *
	 */
	function diff( $from_text,$to_text )
	{
		// Zaehler pro Textarray
		$pos_from = -1;
		$pos_to   = -1;

		// Ergebnis-Arrays
		$from_out = array();
		$to_out   = array();

		while( true )
		{
			$pos_from++;
			$pos_to  ++;

			if	( !isset($from_text[$pos_from]) &&
				  !isset($to_text  [$pos_to  ]) )
			{
				// Text in ist 'neu' und 'alt' zuende. Ende der Schleife.
				break;
			}
			elseif
				(  isset($from_text[$pos_from]) &&
				  !isset($to_text  [$pos_to]) )
			{
				// Text in 'neu' ist zuende, die Restzeilen von 'alt' werden ausgegeben
				while( isset($from_text[$pos_from]) )
				{
					$from_out[] = array('text'=>$from_text[$pos_from],'line'=>$pos_from+1,'type'=>'old');  
					$to_out  [] = array();
					$pos_from++;
				}
				break;  
			}
			elseif
				( !isset($from_text[$pos_from]) &&
				   isset($to_text  [$pos_to]) )
			{
				// Umgekehrter Fall: Text in 'alt' ist zuende, Restzeilen aus 'neu' werden ausgegeben
				while( isset($to_text[$pos_to]) )
				{
					$from_out[] = array();  
					$to_out  [] = array('text'=>$to_text[$pos_to],'line'=>$pos_to+1,'type'=>'new');  
					$pos_to++;
				}
				break;  
			}
			elseif
				( rtrim($from_text[$pos_from]) != rtrim($to_text[$pos_to]) )
			{
				// Zeilen sind vorhanden, aber ungleich
				// Wir suchen jetzt die naechsten beiden Zeilen, die gleich sind.
				$max_entf = min(count($from_text)-$pos_from-1,count($to_text)-$pos_to-1);

				#echo "suche start, max_entf=$max_entf, pos_from=$pos_from, pos_to=$pos_to<br/>";
				
				for ( $a=0; $a<=$max_entf; $a++ )
				{
					#echo "a ist $a<br/>";
					for	( $b=0; $b<=$max_entf; $b++ )
					{
						#echo "b ist $b<br/>";
						if	( trim($from_text[$pos_from+$b]) != '' &&
							  $from_text[$pos_from+$b] == $to_text[$pos_to+$a] )
						{
							$pos_gef_from = $pos_from+$b;
							$pos_gef_to   = $pos_to  +$a;
							break;
						}

						if	( trim($from_text[$pos_from+$a]) != ''  &&
							  $from_text[$pos_from+$a] == $to_text[$pos_to+$b] )
						{
							$pos_gef_from = $pos_from+$a;
							$pos_gef_to   = $pos_to  +$b;
							break;
						}
					}

					if	( $b <=$max_entf)
					{
						break;
					}
				}

				if	( $a<=$max_entf )
				{
					// Gleiche Zeile gefunden
					#echo "gefunden, pos_gef_from=$pos_gef_from, pos_gef_to=$pos_gef_to<br/>";
					
					if	( $pos_gef_from - $pos_from == 0 )
						$type = 'new';
					elseif
						( $pos_gef_to - $pos_to == 0 )
						$type = 'old';
					else
						$type = 'notequal';

					while( $pos_gef_from - $pos_from > 0 &&
					       $pos_gef_to   - $pos_to   > 0    )
					{
						$from_out[] = array('text'=>$from_text[$pos_from],'line'=>$pos_from+1,'type'=>$type);
						$to_out  [] = array('text'=>$to_text  [$pos_to  ],'line'=>$pos_to+1  ,'type'=>$type);
						
						$pos_from++;
						$pos_to++;
					}

					while( $pos_gef_from - $pos_from > 0 )
					{
						$from_out[] = array('text'=>$from_text[$pos_from],'line'=>$pos_from+1,'type'=>$type);
						$to_out  [] = array();
						$pos_from++;
					}

					while( $pos_gef_to - $pos_to   > 0 )
					{
						$from_out[] = array();
						$to_out  [] = array('text'=>$to_text  [$pos_to  ],'line'=>$pos_to+1  ,'type'=>$type);
						$pos_to++;
					}
					$pos_from--;
					$pos_to--;
				}
				else
				{
					// Keine gleichen Zeilen gefunden
					#echo "nicht gefunden, i=$i, j=$j, pos_from war $pos_from, pos_to war $pos_to<br/>";

					while( true )
					{
						if	( !isset($from_text[$pos_from]) &&
						      !isset($to_text  [$pos_to  ]) )
						{
							break;
						}
						elseif
							(  isset($from_text[$pos_from]) &&
							  !isset($to_text  [$pos_to  ]) )
						{
							$from_out[] = array('text'=>$from_text[$pos_from],'line'=>$pos_from+1,'type'=>'notequal');  
							$to_out  [] = array();
						}
						elseif
							( !isset($from_text[$pos_from]) &&
							   isset($to_text  [$pos_to  ]) )
						{
							$from_out[] = array();  
							$to_out  [] = array('text'=>$to_text  [$pos_to  ],'line'=>$pos_to+1  ,'type'=>'notequal');
						}
						else
						{
							$from_out[] = array('text'=>$from_text[$pos_from],'line'=>$pos_from+1,'type'=>'notequal');  
							$to_out  [] = array('text'=>$to_text  [$pos_to  ],'line'=>$pos_to+1  ,'type'=>'notequal');
						}
						$pos_from++;  
						$pos_to++;
					}
				}
			}
			else
			{
				// Zeilen sind gleich
				$from_out[] = array('text'=>$from_text[$pos_from],'line'=>$pos_from+1,'type'=>'equal');  
				$to_out  [] = array('text'=>$to_text  [$pos_to  ],'line'=>$pos_to+1  ,'type'=>'equal');  
			}
		}
		
		return( array($from_out,$to_out) );
	}
	
	
	function entferneVonBis($text,$von,$bis)
	{
		$beg = strpos($text,$von);
		$end = strpos($text,$bis);
		if	( $beg!==false && $end !==false )
			$text = substr($src,0,$beg).substr($src,$end);
		return $text;
	}
}

 
?>