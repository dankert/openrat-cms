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



/**
 * Darstellen einer Inhaltes
 *
 * @version $Revision$
 * @author $Author$
 * @package openrat.objects
 */

class Value
{
	/**
	 * ID dieser Inhaltes
	 * @type Integer
	 */
	var $valueid=0;

	/**
	 * Seiten-Objekt der ?bergeordneten Seite
	 * @type Object
	 */
	var $page;
	
	/**
	 * Objekt-ID, auf die verlinkt wird
	 * @type Integer
	 */
	var $linkToObjectId=0;

	/**
	 * Text-Inhalt
	 * @type String
	 */
	var $text='';
	
	/**
	 * Zahl. Auch Flie?kommazahlen werden als Ganzzahl gespeichert
	 * @type Integer
	 */
	var $number=0;

	
	/**
	 * Datum als Unix-Timestamp
	 * @type Integer
	 */
	var $date=0;
	
	/**
	 * Element-Objekt
	 * @type Object
	 */
	var $element;
	
	/**
	 * Element-Id
	 * @type Integer
	 */
	var $elementid;
	
	/**
	 * Der eigentliche Inhalt des Elementes
	 * @type String
	 */
	var $value;
	
	/**
	 * TimeStamp der letzten Aenderung
	 * @type Integer
	 */
	var $lastchangeTimeStamp;
	
	/**
	 * Benutzer-ID der letzten Aenderung
	 * @type Integer
	 */
	var $lastchangeUserId;

	/**
	 * Benutzername der letzten Aenderung
	 * @type Integer
	 */
	var $lastchangeUserName;
	
	/**
	 * Schalter, ob dieser Inhalt der aktive Inhalt ist
	 * @type Boolean
	 */
	var $active;
	
	/**
	 * Schalter, ob dieser Inhalt der Inhalt ist, der veroeffentlicht
	 * werden soll
	 * @type Boolean
	 */
	var $publish;
	
	/**
	 * Konstruktor
	 */
	function Value()
	{
		$this->lastchangeUserId    = 0;
		$this->lastchangeTimeStamp = 0;
		
		$language = Session::getProjectLanguage();
		$this->languageid = $language->languageid;
	}


	/**
	 * Umwandeln von BB-Code in Wiki-Textauszeichnungen
	 *
	 * @param text zu bearbeitender Text
	 *
	 * @return String Ausgabe
	 */
	function convert_bbcode( $inhalt )
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
	function convert_html( $inhalt )
	{
		$inhalt = eregi_replace('<b(.*)>(.*)</b>','*\\2*' ,$inhalt);
		$inhalt = eregi_replace('<i(.*)>(.*)</i>','_\\2_' ,$inhalt);
		$inhalt = eregi_replace('<a(.*)href="(.*)">(.*)</a>','"\\3"->"\\2"' ,$inhalt);
		return $inhalt;
	}
	
	
	
	/**
	 * Umwandeln von Wiki-Textauszeichnungen in HTML-Auszeichnungen
	 *
	 * @param text zu bearbeitender Text
	 * @param html Boolean, ob HTML-Tags erlaubt sind
	 *
	 * @return String Ausgabe
	 */
	function decode_wiki( $text,$html=false )
	{
		global $conf_languagedir,
		       $conf_php;
		global $conf;

		$neu = array();

		$toc = array();
		$tocid = 0;
	
		$pre   = false;
		$quote = false;
		$br    = false;
		$ul    = false;
		$ol    = false;
		$li    = true;
		$level = 0;
		$lis   = array();
		$table = false;
		$p     = false;

		// Links
		if   ( $this->element->html )
			$pf = '>';
		else $pf = '&amp;gt;';

		if   ( $this->element->html )
			$pf = '>';
		else $pf = '&amp;gt;';
		
		// Zeichenkette in die einzelnen Zeilen zerlegen
		$zeilen = explode("\n",$text);
		
		foreach( $zeilen as $zeile )
		{
			# Leer- und Sonderzeichen am Zeilenende entfernen
			$zeile = chop( $zeile );
			
			// Backtick am Zeilenbeginn schaltet Wikiauszeichnungen aus
			if	( substr($zeile,0,1) == '`' && !$pre )
			{
				$zeile = substr($zeile,1);
				$nowiki = true;
			}
			else
			{
				$nowiki = false;
			}

			// Zitat Anfang
			if   ( $zeile == $pf  &&  !$quote && !$pre )
			{
				if	( $p )
				{
					$neu[] = '</p>';
					$p = false;
				}

				$zeile = '<blockquote>';
				$quote = true;
			}
	
			// Zitat Ende
			if   ( $zeile == $pf &&  $quote  && !$pre )
			{
				if	( $p )
				{
					$neu[] = '</p>';
					$p = false;
				}
				$zeile = '</blockquote>';
				$quote = false;
			}
		
			// Pr?formatierter Text Anfang
			if   ( $zeile == '='  &&  !$pre )
			{
				if	( $p )
				{
					$neu[] = '</p>';
					$p = false;
				}

				$zeile = '<pre>';
				$pre = true;
			}
	
			// Pr?formatierter Text Ende
			if   ( $zeile == '='  &&  $pre )
			{
				$zeile = '</pre>';
				$pre = false;
			}
		

			// ?berschriften
			if	( preg_match('/^([+]{1,}) ?(.*)/',$zeile,$match) && !$nowiki && !$pre && !$quote )
			{
				if	( $p )
				{
					$neu[] = '</p>';
					$p = false;
				}

				$tocid++;
				$hlev = strlen($match[1]);
				$toc[] = array('level'=>$hlev,'id'=>$tocid,'text'=>$match[2]);
				$zeile = '<h'.$hlev.'><a name="toc'.$tocid.'"></a>'.$match[2].'</h'.$hlev.'>';
			}

			// Bei pr?formatierem Text keine weiteren Formatierungen durchf?hren	
			if   ( !$pre )
			{
				// Tabellen
				$beg = substr($zeile,0,1);
				
				if   ( $beg == '|' )
				{
					if   ( !$table )
					{
						if	( $p )
						{
							$neu[] = '</p>';
							$p = false;
						}
	
						$neu[] = '<table>';
						$table = true;
					}
					
					$zeile = ereg_replace( '^\|','<tr><td>',$zeile );
					$zeile = ereg_replace( '\|?$','</td></tr>',$zeile );
					$zeile = str_replace( '|','</td><td>',$zeile );

					// Spalten?bergreifende Zellen
					$zeile = str_replace('<td></td><td>','<td colspan\="2">',$zeile);
					for( $i=2; $i<=10; $i++)
						$zeile = str_replace('</td><td colspan\="'.$i.'"></td><td>','</td><td colspan\="'.($i+1).'">',$zeile);

					// Spalten-?berschriften <th>
					$zeile = eregi_replace( '<td([^<]*)>!([^<]+)</td>','<th\\1>\\2</th>',$zeile );

					// CSS-Klassen
					$zeile = eregi_replace( '<t([dh][^<]*)>\(([a-zA-Z0-9]+)\)([^<]+)</td>','<t\\1 class\="\\2">\\3</td>',$zeile );
				}
				else
				{
					if( $table )
					{
						$table = false;
						$neu[] = '</table>';
					}
				}


				// Aufz?hlungen		
				if	( preg_match('/^( *)([\*#-]) (.*)/',$zeile,$match) && !$nowiki )
				{
					if	( $p )
					{
						$neu[] = '</p>';
						$p = false;
					}

					$lev  = strlen($match[1])+1;
					$type = $match[2];
					$text = $match[3];
					
					if	( $level == $lev ) $neu[] = '</li>';

					while( $level < $lev )
					{
						$level++;

						if	( $match[2]=='#')
							$neu[] = '<ol class="level'.$level.'">';
						else	$neu[] = '<ul class="level'.$level.'">';

						$lis[$level] = $match[2]; 
					}

					while( $level > $lev )
					{
						$neu[] = '</li>';
						if	( $lis[$level]=='#')
							$neu[] = '</ol>';
						else	$neu[] = '</ul>';

						$level--;
					}

					$zeile = '<li>'.$text;
				}
				else
				{
					while( $level > 0 )
					{
						if	( $lis[$level]=='#')
							$neu[] = '</ol>';
						else	$neu[] = '</ul>';
						$level--;
					}
				}
			}
	
			
			// Abs?tze einrichten
			if   (!$pre && !$ol && !$ul && !$table && substr($zeile,0,1)!='<' )
			{
				if   ( $zeile != '' && $p )
				{
					$neu[] = '<br/>';
				}
	
				if   ( $zeile == '' && $p )
				{
					$neu[] = '</p>';
					$p = false;
				}
	
				if   ( $zeile != '' && !$p )
				{
					$neu[] = '<p>';
					$p = true;
				}
			}
		
	
	
			// Textauszeichnungen fett,kursiv,fest		
			if   ( !$pre && !$nowiki )  // nicht bei praeformatiertem Text
			{
				$html = $conf['html'];
				// *Fett*	
				$zeile = ereg_replace( '\*([^\*]+[^\\])\*'      , $html['tag_strong_open'].'\\1'.$html['tag_strong_close']       , $zeile );
	
				// _kursiv_
				$zeile = ereg_replace( '_([^_]+[^\\])_'         , $html['tag_emphatic_open'].'\\1'.$html['tag_emphatic_close']   , $zeile );

				// "Wortliche Rede"
				if	( !$html )
					$zeile = ereg_replace( '([^\-].{1,4})"([^"\-]+[^\\])"([^\-])', '\\1'.$html['tag_speech_open'].'\\2'.$html['tag_speech_close'].'\\3' , $zeile );
	
				// =feste Breite=
				$zeile = ereg_replace( '=([^=]+[^\\])='         , $html['tag_teletype_open'].'\\1'.$html['tag_teletype_close']   , $zeile );


				// Text->... umsetzen nach "Text"->... (Anfuehrungszeichen ergaenzen)
				$zeile = ereg_replace( '([A-Za-z0-9._????????-]+)-'.$pf, '"\\1"-'.$pf, $zeile );

				// ...->Link umsetzen nach ...->"Link" (Anfuehrungszeichen ergaenzen)
				$zeile = ereg_replace( '-'.$pf.'([A-Za-z0-9.:_\/\,\?\=\&-]+)', '-'.$pf.'"\\1"',$zeile );

				# Links ...->"nnn" ersetzen mit ...->"object:nnn"
				$zeile = ereg_replace( '-'.$pf.'\"([0-9]+)\"', '-'.$pf.'"object:\\1"', $zeile );

				// Links ->... url-kodieren
//				preg_match_all( '|-'.$pf.'\"([^\"]+)\"|',$zeile,$urls,PREG_SET_ORDER );
//				foreach( $urls as $url )
//				{
//					echo $url[1];
//					$urlneu = urlencode( $url[1] );
//					echo "wird zu $urlneu<br>";
//					$zeile = str_replace( $url[0],'-'.$pf.'"'.$urlneu.'"',$zeile );
//				}

				# Links "mit->..."
				$zeile = ereg_replace( '\"([^\"]+)\"-'.$pf.'\"([^\"]+)\"', '<a href="\\2">\\1</a>', $zeile );
		
				// alleinstehende externe Links
				$zeile = ereg_replace( '([^"])((https?|ftps?|news|gopher):\/\/([A-Za-z0-9._\/\,-]*))', '\\1<a href="\\2">\\4</a>', $zeile );
				$zeile = ereg_replace( '^((https?|ftps?|news|gopher):\/\/([A-Za-z0-9._\/\,-]*))', '<a href="\\1">\\3</a>', $zeile );
				
				// Einbinden von Bildern
				$zeile = ereg_replace( '(ima?ge?):\/?\/?(([0-9]+))(\{.*\})?', '<img src="object:\\2" class="text" alt="" />', $zeile );
				$zeile = ereg_replace( '{([0-9]+)}'                         , '<img src="object:\\1" class="text" alt="" />', $zeile );
		
				# mailto:...-Links
				$zeile = ereg_replace( '([A-Za-z0-9._-]+@[A-Za-z0-9._-]+)', '<a href="mailto:\\1">\\1</a>', $zeile );

				// Links object:nnn ersetzen
				preg_match_all( '|object:([0-9]+)|',$zeile,$objects,PREG_SET_ORDER );
				foreach( $objects as $object )
				{
					$var = $this->page->path_to_object( $object[1] );
					$zeile = str_replace( $object[0],$var,$zeile );
				}

				$zeile = ereg_replace( '([^\\\\])\\\\','\\1', $zeile );
			}
			$neu[] = $zeile;
		}
		
		if   ( $ol    ) $neu[] = '</ol>';
		if   ( $ul    ) $neu[] = '</ul>';
		if   ( $table ) $neu[] = '</table>';
		if   ( $pre   ) $neu[] = '</pre>';
		if   ( $p     ) $neu[] = '</p>';
		
	
		$text = implode("\n",$neu);
		
		// Inhaltsverzeichnis

		$toctext = array();
		foreach( $toc as $t )
		{
			if	($t['level'] == 1 && count($toctext)>0) $toctext[] = '';
			$toctext[] = str_repeat('&nbsp;',$t['level']*2).'<a href="#toc'.$t['id'].'">'.$t['text'].'</a>';
		}
		$text = str_replace( '##TOC##',implode("<br/>\n",$toctext),$text ); // Inhaltsverzeichnis einf?gen
		
//		foreach( $ini_chars  as $key=>$val)
//		{
//			$text = str_replace( chr($key),$val,$text );
//		}
		foreach( $conf['replace'] as $replace )
		{
			$repl = explode(',',$replace);
			if	( count($repl) == 2 )
				$text = str_replace( $repl[0],$repl[1],$text );
		}
		
		return $text;
	}


	function path_to_page( $pageid )
	{
		return $this->page->path_to_object( $pageid );
	}
	function path_to_object( $pageid )
	{
		return $this->path_to_page( $pageid );
	}


	/**
	 * Laden des aktuellen Inhaltes aus der Datenbank
	 */
	function load()
	{
		$db = db_connection();

		if	( $this->publish )
			$sql = new Sql( 'SELECT * FROM {t_value}'.
			                '  WHERE elementid ={elementid}'.
			                '    AND pageid    ={pageid}'.
			                '    AND languageid={languageid}'.
			                '    AND publish=1' );
		else	$sql = new Sql( 'SELECT * FROM {t_value}'.
			                '  WHERE elementid ={elementid}'.
			                '    AND pageid    ={pageid}'.
			                '    AND languageid={languageid}'.
			                '    AND active=1' );
		$sql->setInt( 'elementid' ,$this->element->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);
		$row = $db->getRow( $sql->query );
		
		if	( count($row) > 0 ) // Wenn Inhalt gefunden
		{
			$this->text           = $row['text'];
			$this->valueid        = intval($row['id']          );
			$this->linkToObjectId = intval($row['linkobjectid']);
			$this->number         = intval($row['number'      ]);
			$this->date           = intval($row['date'        ]);
	
			$this->active         = ( $row['active' ]=='1' );
			$this->publish        = ( $row['publish']=='1' );
	
			$this->lastchangeTimeStamp = intval($row['lastchange_date'  ]);
			$this->lastchangeUserId    = intval($row['lastchange_userid']);
		}
	}


	/**
	 * Laden eines bestimmten Inhaltes aus der Datenbank
	 */
	function loadWithId( $valueid=0 )
	{
		if	( $valueid != 0 )
			$this->valueid = $valueid;

		$db = db_connection();

		$sql = new Sql( 'SELECT {t_value}.*,{t_user}.name as lastchange_username'.
		                ' FROM {t_value}'.
		                ' LEFT JOIN {t_user} ON {t_user}.id={t_value}.lastchange_userid'.
		                '  WHERE {t_value}.id={valueid}' );
		$sql->setInt( 'valueid',$this->valueid);
		$row = $db->getRow( $sql->query );
		
		$this->text           =        $row['text'        ];
		$this->pageid         = intval($row['pageid'      ]);
		$this->elementid      = intval($row['elementid'   ]);
		$this->languageid     = intval($row['languageid'  ]);
		$this->valueid        = intval($row['id'          ]);
		$this->linkToObjectId = intval($row['linkobjectid']);
		$this->number         = intval($row['number'      ]);
		$this->date           = intval($row['date'        ]);

		$this->active         = ( $row['active' ]=='1' );
		$this->publish        = ( $row['publish']=='1' );

		$this->lastchangeTimeStamp = intval($row['lastchange_date'    ]);
		$this->lastchangeUserId    = intval($row['lastchange_userid'  ]);
		$this->lastchangeUserName  =        $row['lastchange_username'];
	}


	/**
	 * Alle Versionen des aktuellen Inhaltes werden ermittelt
	 * @return Array
	 */
	function getVersionList()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT {t_value}.*,{t_user}.name as lastchange_username'.
		                '  FROM {t_value}'.
		                '  LEFT JOIN {t_user} ON {t_user}.id={t_value}.lastchange_userid'.
		                '  WHERE elementid ={elementid}'.
		                '    AND pageid    ={pageid}'.
		                '    AND languageid={languageid}'.
		                '  ORDER BY lastchange_date' );
		$sql->setInt( 'elementid' ,$this->element->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);

		$list = array();
		foreach( $db->getAll( $sql->query ) as $row )
		{
			$val = new Value();
			$val->valueid = $row['id'];
			
			$val->text           = $row['text'];
			$val->valueid        = intval($row['id']          );
			$val->linkToObjectId = intval($row['linkobjectid']);
			$val->number         = intval($row['number'      ]);
			$val->date           = intval($row['date'        ]);
	
			$val->active         = ( $row['active' ]=='1' );
			$val->publish        = ( $row['publish']=='1' );
	
			$val->lastchangeTimeStamp = intval($row['lastchange_date'    ]);
			$val->lastchangeUserId    = intval($row['lastchange_userid'  ]);
			$val->lastchangeUserName  = $row['lastchange_username'];
			$list[] = $val;
		}
		return $list;
	}


	/**
	 * Die Anzahl der Versionen des aktuellen Inhaltes wird ermittelt
	 * @return Array
	 */
	function getCountVersions()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT COUNT(*) FROM {t_value}'.
		                '  WHERE elementid ={elementid}'.
		                '    AND pageid    ={pageid}'.
		                '    AND languageid={languageid}' );
		$sql->setInt( 'elementid' ,$this->element->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);

		return $db->getOne( $sql->query );
	}


	/**
	 * Inhalt freigeben
	 */
	function release()
	{
		$db = db_connection();

		$sql = new Sql( 'UPDATE {t_value}'.
		                '  SET publish=0'.
		                '  WHERE elementid ={elementid}'.
		                '    AND pageid    ={pageid}'.
		                '    AND languageid={languageid}' );
		$sql->setInt( 'elementid' ,$this->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);

		$db->query( $sql->query );

		$sql = new Sql( 'UPDATE {t_value}'.
		                '  SET publish=1'.
		                '  WHERE active    = 1'.
		                '    AND elementid ={elementid}'.
		                '    AND pageid    ={pageid}'.
		                '    AND languageid={languageid}' );
		$sql->setInt( 'elementid' ,$this->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);

		$db->query( $sql->query );
	}

	/**
	 * Inhalt speichern
	 */
	function save()
	{
		global $SESS;
		$db = db_connection();

		$sql = new Sql( 'UPDATE {t_value}'.
		                '  SET active=0'.
		                '  WHERE elementid ={elementid}'.
		                '    AND pageid    ={pageid}'.
		                '    AND languageid={languageid}' );
		$sql->setInt( 'elementid' ,$this->element->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);

		$db->query( $sql->query );

		if	( $this->publish )
		{
			// Wenn Inhalt sofort veroeffentlicht werden kann, dann
			// alle anderen Inhalte auf nicht-veroeffentlichen stellen 
			$sql = new Sql( 'UPDATE {t_value}'.
			                '  SET publish=0'.
			                '  WHERE elementid ={elementid}'.
			                '    AND pageid    ={pageid}'.
			                '    AND languageid={languageid}' );
			$sql->setInt( 'elementid' ,$this->element->elementid );
			$sql->setInt( 'pageid'    ,$this->pageid    );
			$sql->setInt( 'languageid',$this->languageid);

			$db->query( $sql->query );
		}

		// Naechste ID aus Datenbank besorgen
		$sql = new Sql('SELECT MAX(id) FROM {t_value}');
		$this->valueid = intval($db->getOne($sql->query))+1;

		$sql->setQuery( 'INSERT INTO {t_value}'.
		                '        (id,linkobjectid,text,number,date,elementid,pageid,languageid,active,publish,lastchange_date,lastchange_userid)'.
		                ' VALUES ({valueid},{linkobjectid},{text},{number},{date},{elementid},{pageid},{languageid},1,{publish},{lastchange_date},{lastchange_userid})' );

		$sql->setInt( 'valueid'   ,$this->valueid            );
		$sql->setInt( 'elementid' ,$this->element->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid             );
		$sql->setInt( 'languageid',$this->languageid         );

		if	( intval($this->linkToObjectId)==0)
			$sql->setNull  ( 'linkobjectid' );
		else	$sql->setInt   ( 'linkobjectid',$this->linkToObjectId   );

		if	( $this->text == '' )
			$sql->setNull  ( 'text' );
		else	$sql->setString( 'text',$this->text );

		if	( intval($this->number)==0)
			$sql->setNull  ( 'number' );
		else	$sql->setInt   ( 'number',$this->number );

		if	( intval($this->date)==0)
			$sql->setNull  ( 'date' );
		else	$sql->setInt   ( 'date',$this->date );

		$sql->setBoolean( 'publish'          ,$this->publish          );
		$sql->setInt    ( 'lastchange_date'  ,time()                  );
		$sql->setInt    ( 'lastchange_userid',$SESS['user']['userid'] );

		$db->query( $sql->query );
	}


	/**
	 * Diesen Inhalt l?schen
	 */
	function delete()
	{
		$db = db_connection();
		$sql = new Sql( 'DELETE * FROM {t_value}'.
		                '  WHERE elementid ={elementid}'.
		                '    AND pageid    ={pageid}'.
		                '    AND languageid={languageid}' );
		$sql->setInt( 'elementid' ,$this->element->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);
		$row = $db->getRow( $sql->query );
	}


	/**
	 * Diese Methode erzeugt fuer alle Elementtypen den Inhalt
	 */
	function generate()
	{
		if	( intval($this->valueid)==0 )
			$this->load();
		$db = db_connection();
		global $conf;
	
		$inhalt = '';

//		Logger::debug('Generating Element '.$this->element->name.', type='.$this->element->type );
		switch( $this->element->type )
		{
			case 'list':

				$objectid = $this->linkToObjectId;
				$this->page->up_path();
				
				if   ( intval($objectid) == 0 )
					$objectid = $this->element->defaultObjectId;
	
				if   ( $this->simple )
				{
					$f = new Folder( $objectid );
					$f->load();
					$inhalt = $f->name;
					unset( $f );
				}
				else
				{
					if	( $objectid != $this->page->objectid ) // Rekursion vermeiden
					{
						$f = new Folder( $objectid );
						foreach( $f->getObjectIds() as $oid )
						{
							if	( $oid != $this->page->objectid )  // Rekursion vermeiden
							{
								$o = new Object( $oid );
								$o->load();
								switch( $o->getType() )
								{
									case OR_TYPE_PAGE:
										$p = new Page( $oid );
										$p->public         = $this->page->public;
										$p->up_path        = $this->page->up_path();
										$p->projectmodelid = $this->page->projectmodelid;
										$p->languageid     = $this->languageid;
										$p->load();
										$p->generate();
										$inhalt .= $p->value;
										unset( $p );
										break;
									case OR_TYPE_LINK:
										$l = new Link( $oid );
										$l->load();
										if	( $l->isLinkToObject )
										{
											$op = new Object( $l->linkedObjectId );
											$op->load();
											if	( $op->isPage )
											{
												$p = new Page( $l->linkedObjectId );
												$p->public         = $this->page->public;
												$p->up_path        = $this->page->up_path();
												$p->projectmodelid = $this->page->projectmodelid;
												$p->languageid     = $this->languageid;
												$p->load();
												$p->generate();
												$inhalt .= $p->value;
												unset( $p );
											}
										}
										break;
								}
							}
							else die('FATAL: recursion detected');
						}
					}
					else die('FATAL: recursion detected');
				}

				if	( $this->simple )
				{
					$inhalt = strip_tags( $inhalt );
					$inhalt = str_replace( "\n",'',$inhalt );
					$inhalt = str_replace( "\r",'',$inhalt );
				}
				
				break;


			case 'link':

				$objectid = $this->linkToObjectId;
				
				if   ( intval($objectid) == 0 )
					$objectid = $this->element->defaultObjectId;
	
				if   ( $objectid==0 )
				{
					// Link noch nicht gefuellt
					$inhalt = '';
				}
				elseif   ( $this->simple )
				{
					$o = new Object( $objectid );
					$o->load();
					$inhalt = $o->name;
				}
				else
				{
					$inhalt = $this->page->path_to_object( $objectid );
				}
				
				break;


			case 'longtext':
			case 'text':
			case 'select':

				$inhalt = $this->text;
	
				if   ( $inhalt == '' )
					$inhalt = $this->element->defaultText;

				// Wenn HTML nicht erlaubt ist, dann die HTML-Tags ersetzen
				if   ( !$this->element->html )
				{
					//$inhalt = htmlentities($inhalt);
					
					$inhalt = str_replace('<','&lt;' ,$inhalt);
					$inhalt = str_replace('>','&gt;' ,$inhalt);
					$inhalt = str_replace('&','&amp;',$inhalt);
				}

				if   ( !$this->element->html && $this->element->wiki && $conf['wiki']['convert_html'] )
					$inhalt = $this->convert_html( $inhalt );

				if   ( $this->element->wiki && $conf['wiki']['convert_bbcode'] )
					$inhalt = $this->convert_bbcode( $inhalt );
	
				// Schnellformatierung ('Wiki') durchf?hren
				if   ( $this->element->wiki )
				{
					$transformer = new Transformer();
					$transformer->text = $inhalt;
					$transformer->page = $this->page;
					$transformer->html = $this->element->html;
					$transformer->type = 'html';
					$transformer->transform();
					$inhalt = $transformer->text;
				}
	
				if   ( $this->simple )
				{
					$inhalt = strip_tags( $inhalt );
					$inhalt = str_replace( "\n",'',$inhalt );
					$inhalt = str_replace( "\r",'',$inhalt );
				}
				
				break;


			// Zahl
			//
			// wird im entsprechenden Format angezeigt.
			case 'number':
	
				$number = $this->number / pow(10,$this->element->decimals);
				$inhalt = number_format( $number,$this->element->decimals,$this->element->decPoint,$this->element->thousandSep );
	
				break;
	
	
			// Datum
			case 'date':

				$date = $this->date;

				if   ( intval($date) == 0 )
				{
					// Datum wurde noch nicht eingegeben
					$date = $this->element->defaultText;
					break;
				}

				// Datum gemaess Elementeinstellung formatieren
				$inhalt = date( $this->element->dateformat,$date );
				
				break;


			// Programmcode (PHP)
			case 'code':

				if   ( $this->page->simple )
					break;

				$this->page->load();

				$code = new Code();
				$code->page = &$this->page;
				$code->setObjectId( $this->page->objectid );
				$code->delOutput();
				$code->code = $this->element->code;

				// Jetzt ausfuehren des temporaeren PHP-Codes				
				$code->execute();

				$inhalt = $code->getOutput();

				break;


			// Programmcode (PHP)
			case 'dynamic':

				if   ( $this->page->simple )
					break;

				$this->page->load();
				$className = $this->element->subtype;
				$fileName  = './dynamicClasses/'.$className.'.class.php';
				if	( is_file( $fileName ) )
				{
					// Fuer den Fall, dass eine Dynamic-Klasse mehrmals pro Vorlage auftritt
					if	( !class_exists($className) )
						require( $fileName );

					if	( class_exists($className) )
					{
						$dynEl = new $className;
						$dynEl->page = &$this->page;

						if	( method_exists( $dynEl,'execute' ) )
						{
							//$dynEl->delOutput();
							$dynEl->objectid = $this->page->objectid;
							$dynEl->page    = &$this->page;

							foreach( $this->element->getDynamicParameters() as $param_name=>$param_value )
							{
								if	( isset( $dynEl->$param_name ) )
								{
									Logger::debug("Setting parameter for dynamic Class $className, ".$param_name.':'.$param_value );
									$dynEl->$param_name = $param_value;
								}
							}

							$dynEl->execute();
							$inhalt = $dynEl->getOutput();
						}
					}
				}

				break;


			// Info-Feld als Datum
			case 'infodate':

				if   ( $this->page->simple )
					break;
				
				switch( $this->element->subtype )
				{
					case 'date_published':
						$inhalt = date( $this->element->dateformat );
						break;
						
					case 'date_saved':
						$inhalt = date( $this->element->dateformat,$this->page->lastchange_date );
						break;

					case 'date_created':
						$inhalt = date( $this->element->dateformat,$this->page->create_date );
						break;

					default:  
						//$inhalt = 'please select subtype. unknown: '.$this->element->subtype;
				}
				
				break;


			// Info-Feld
			case 'info':

				if   ( $this->page->simple )
					break;

				switch( $this->element->subtype )
				{
					case 'db_id':
						$inhalt = $SESS['dbid'];
						break;
					case 'db_name':
						$inhalt = $conf['database_'.$SESS['dbid']]['comment'];
						break;
					case 'project_id':
						$inhalt = $this->page->projectid;
						break;
					case 'project_name':
						$project = new Project( $this->page->projectid );
						$project->load();
						$inhalt = $project->name;
						break;
					case 'language_id':
						$inhalt = $this->page->languageid;
						break;
					case 'language_iso':
						$language = new Language( $this->page->languageid );
						$language->load();
						$inhalt = $language->isoCode;
						break;
					case 'language_name':
						$language = new Language( $this->page->languageid );
						$language->load();
						$inhalt = $language->name;
						break;
					case 'page_id':
						$inhalt = $this->page->objectid;
						break;
					case 'page_name':
						$inhalt = $this->page->name;
						break;
					case 'page_desc':
						$inhalt = $this->page->desc;
						break;
					case 'page_fullfilename':
						$inhalt = $this->page->full_filename();
						break;
					case 'page_filename':
						$inhalt = $this->page->filename;
						break;
					case 'page_extension':
						$inhalt = '';
						break;
					case 'edit_url':
						$db = Session::getDatabase();
						$inhalt = Html::url('index','object',$this->page->objectid,array('dbid'=>$db->id));
						break;
					case 'edit_fullurl':
						$inhalt = 'http://';
						$inhalt .= getenv('SERVER_NAME');
						$inhalt .= dirname(getenv('SCRIPT_NAME'));
						$db = Session::getDatabase();
						$inhalt .= '/'.Html::url('index','object',$this->page->objectid,array('dbid'=>$db->id));
						break;
					case 'lastch_user_username':
						$user = new User($this->page->lastchange_userid);
						$user->load();
						$inhalt = $user->name;
						break;
					case 'lastch_user_fullname':
						$user = new User($this->page->lastchange_userid);
						$user->load();
						$inhalt = $user->fullname;
						break;
					case 'lastch_user_mail':
						$user = new User($this->page->lastchange_userid);
						$user->load();
						$inhalt = $user->mail;
						break;
					case 'lastch_user_desc':
						$user = new User($this->page->lastchange_userid);
						$user->load();
						$inhalt = $user->desc;
						break;
					case 'lastch_user_tel':
						$user = new User($this->page->lastchange_userid);
						$user->load();
						$inhalt = $user->tel;
						break;

					case 'create_user_username':
						$user = new User($this->page->create_userid);
						$user->load();
						$inhalt = $user->name;
						break;
					case 'create_user_fullname':
						$user = new User($this->page->create_userid);
						$user->load();
						$inhalt = $user->fullname;
						break;
					case 'create_user_mail':
						$user = new User($this->page->create_userid);
						$user->load();
						$inhalt = $user->mail;
						break;
					case 'create_user_desc':
						$user = new User($this->page->create_userid);
						$user->load();
						$inhalt = $user->desc;
						break;
					case 'create_user_tel':
						$user = new User($this->page->create_userid);
						$user->load();
						$inhalt = $user->tel;
						break;

					case 'act_user_username':
						$user = new User($SESS['user']['id']);
						$user->load();
						$inhalt = $user->name;
						break;
					case 'act_user_fullname':
						$user = new User($SESS['user']['id']);
						$user->load();
						$inhalt = $user->fullname;
						break;
					case 'act_user_mail':
						$user = new User($SESS['user']['id']);
						$user->load();
						$inhalt = $user->mail;
						break;
					case 'act_user_desc':
						$user = new User($SESS['user']['id']);
						$user->load();
						$inhalt = $user->desc;
						break;
					case 'act_user_tel':
						$user = new User($SESS['user']['id']);
						$user->load();
						$inhalt = $user->tel;
						break;
					default:
						//$inhalt = 'please select subtype. unknown: '.$this->element->subtype;
				}
				break;
		}
		
		if   ( $this->page->icons && $this->element->withIcon )
			$inhalt = '<a href="'.Html::url('pageelement','edit',$this->page->objectid,array('elementid'=>$this->element->elementid)).'" title="'.$this->element->desc.'" target="cms_main_main"><img src="'.OR_THEMES_DIR.$conf['interface']['theme'].'/images/icon_el_'.$this->element->type.IMG_EXT.'" border="0" align="left"></a>'.$inhalt;
		
		$this->value = $inhalt;
	}


	/**
	  * Es werden Objekte mit einem Inhalt
	  * @param String Suchbegriff
	  * @return Array Liste der gefundenen Objekt-IDs
	  */
	function getObjectIdsByValue( $text )
	{
		$db = db_connection();
		
		$sql = new Sql( 'SELECT {t_object}.id FROM {t_value} '.
		                ' LEFT JOIN {t_page} '.
		                '   ON {t_page}.id={t_value}.pageid '.
		                ' LEFT JOIN {t_object} '.
		                '   ON {t_object}.id={t_page}.objectid '.
		                ' WHERE {t_value}.text LIKE {text}'.
		                '   AND {t_value}.languageid={languageid}' );
		$sql->setInt   ( 'languageid',$this->languageid );
		$sql->setString( 'text'      ,'%'.$text.'%'     );
		
		return $db->getCol( $sql->query );
	}


	/**
	  * Es werden Objekte mit einer UserId ermittelt
	  * @param Integer Benutzer-Id der letzten ?nderung
	  * @return Array Liste der gefundenen Objekt-IDs
	  */
	function getObjectIdsByLastChangeUserId( $userid )
	{

		$db = db_connection();
		
		$sql = new Sql( 'SELECT {t_object}.id FROM {t_value} '.
		                ' LEFT JOIN {t_page} '.
		                '   ON {t_page}.id={t_value}.pageid '.
		                ' LEFT JOIN {t_object} '.
		                '   ON {t_object}.id={t_page}.objectid '.
		                ' WHERE {t_value}.lastchange_userid={userid}'.
		                '   AND {t_value}.languageid={languageid}' );
		$sql->setInt   ( 'languageid',$this->languageid );
		$sql->setInt   ( 'userid'    ,$userid           );

		return $db->getCol( $sql->query );
	}
}