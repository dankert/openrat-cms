<?php
// OpenRat Content Management System
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


/**
 * Nuetzliche Funktionen fuer das Bearbeiten von Texten/Zeichenketten
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class Text
{
	/**
	 * 
	 * @param unknown $key
	 * @param unknown $text
	 * @return string|unknown
	 */
    public static function accessKey( $key, $text )
	{
		$pos = strpos(strtolower($text),strtolower($key));
		
		if	( $pos !== false )
			return substr($text,0,max($pos,0)).'<span class="accesskey">'.substr($text,$pos,1).'</span>'.substr($text,$pos+1);
		else
			return $text;
	}

    /**
     * Alias fuer Methode maxLength()
     *
     * @param $text
     * @param $laenge
     * @return string
     * @deprecated use maxlength() !
     */
    public static function maxLaenge($text, $laenge)
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
	public static function maxLength( $text,$laenge=20,$append='...',$where=STR_PAD_RIGHT )
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
    public static function bbCode2Wiki( $inhalt )
	{
		$inhalt = preg_replace('/\[b\]([^\[]*)\[\/b\]/i'       , '*\\1*' ,$inhalt);
		$inhalt = preg_replace('/\[i\]([^\[]*)\[\/i\]/i'       , '_\\1_' ,$inhalt);
		$inhalt = preg_replace('/\[code\]([^\[]*)\[\/code\]/i' , '=\\1=' ,$inhalt);

		$inhalt = preg_replace('/\[url\]([^\[]*)\[\/url\]/i'          ,'"\\1"->"\\1"' ,$inhalt);
		$inhalt = preg_replace('/\[url=([^\[]*)\]([^\[]*)\[\/url\]/i' ,'"\\2"->"\\1"' ,$inhalt);

		return $inhalt;
	}


	/**
	 * Umwandeln von einfachen HTML-Befehlen in Wiki-Textauszeichnungen
	 *
	 * @param text zu bearbeitender Text
	 *
	 * @return String Ausgabe
	 */
    public static function Html2Wiki( $inhalt )
	{
		$inhalt = preg_replace('/<b(.*)>(.*)<\/b>/i','*\\2*' ,$inhalt);
		$inhalt = preg_replace('/<i(.*)>(.*)<\/i>/i','_\\2_' ,$inhalt);
		$inhalt = preg_replace('/<a(.*)href="(.*)">(.*)<\/a>/i','"\\3"->"\\2"' ,$inhalt);

		return $inhalt;
	}


	/**
	 * HTML-Entitaeten fuer HTML-Tags verwenden
	 *
	 * @param String Text, in dem HTML-Tags umgewandelt werden sollen
	 * @return String Ausgabe
	 */
    public static function encodeHtml( $inhalt )
	{
		//$inhalt = str_replace('&','&amp;',$inhalt);
		$inhalt = str_replace('"','&quot;',$inhalt);
		$inhalt = str_replace('<','&lt;' ,$inhalt);
		$inhalt = str_replace('>','&gt;' ,$inhalt);

		return $inhalt;
	}

	
	
	/**
	 * Ersetzt Sonderzeichen durch HTML-�quivalente.<br>
	 * Z.B. Ersetzt "(c)" durch "&copy;".
	 */
    public static function replaceHtmlChars( $text )
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
    public static function encodeHtmlSpecialChars( $inhalt )
	{
		return Text::replaceHtmlChars( $inhalt );
	}

	
	
	/**
	 * Vergleicht 2 Text-Arrays und ermittelt eine Darstellung der Unterschiede
	 *
	 */
    public static function diff( $from_text,$to_text )
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
	
	
	/**
	 * Saeubert eine Zeichenkette.
	 * 
	 *  Es werden ungueltige Zeichen aus einer Zeichenkette entfernt. Es wird mit einer Whitelist
	 *  gearbeitet, d.h. die erlaubten Zeichen werden angegeben. 
	 * 
	 * @param $eingabe Die Eingabe-Zeichenkette, aus der ungueltige Zeichen entfernt werden sollen.
	 * @param $erlaubt Die erlaubten Zeichen (eine "White-List")
	 * @return String die aufgeräumte Zeichenkette
	 */
    public static function clean( $eingabe, $erlaubt )
	{
		$first  = strtr( $eingabe, $erlaubt, str_repeat("\x01", strlen($erlaubt)) );
		$second = strtr( $eingabe, $first  , str_repeat("\x00", strlen($first )) );
		return str_replace("\x00",'',$second);
	}


    /**
     * Searches for Object-Ids in a text.
     * Searches in the provided text for URLs with "__OID__nnn__", where nnn is an object id.
     * @param $text
     * @return array
     */
    public static function parseOID( $text )
	{
		$oids    = array();
		$treffer = array();

		// This are all chars which are used in our URLs.
        // Sure, there are more, but not used by this system.
        $urlChars = '[A-Za-z0-9_.:,\/=+&?-]';
		
		preg_match_all('/('.$urlChars.'*)__OID__([0-9]+)__('.$urlChars.'*)/', $text, $treffer,PREG_SET_ORDER);
		
		foreach( $treffer as $t ) {

		    $id    = $t[2];
		    $match = $t[0];

		    if   ( !isset( $oids[$id]))
                $oids[$id] = array();

		    $oids[$id][] = $match;
        }

		return $oids;
	}
}

