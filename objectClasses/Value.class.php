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
// Revision 1.2  2004-04-24 15:28:17  dankert
// Korrektur: relative Pfad bei Listen
//
// Revision 1.1  2004/04/24 15:15:12  dankert
// Initiale Version
//
// Revision 1.1  2004/03/13 23:09:48  dankert
// *** empty log message ***
//
// ---------------------------------------------------------------------------


class Value
{
	/**
	 * ID dieser Inhaltes
	 * @type Integer
	 */
	var $valueid=0;

	/**
	 * Seiten-Objekt der übergeordneten Seite
	 * @type Object
	 */
	var $page;
	
	/**
	 * Objekt-ID, auf die verlinkt wird
	 * @type Integer
	 */
	var $linkToObjectId;

	/**
	 * Text-Inhalt
	 * @type String
	 */
	var $text;
	
	/**
	 * Zahl. Auch Fließkommazahlen werden als Ganzzahl gespeichert
	 * @type Integer
	 */
	var $number;

	
	/**
	 * Datum als Unix-Timestamp
	 * @type Integer
	 */
	var $date;
	
	/**
	 * Element-Objekt
	 * @type Object
	 */
	var $element;
	
	/**
	 * Der eigentliche Inhalt des Elementes
	 * @type String
	 */
	var $value;
	
	/**
	 * TimeStamp der letzten Änderung
	 * @type Integer
	 */
	var $lastchangeTimeStamp;
	
	/**
	 * Benutzer-ID der letzten Änderung
	 * @type Integer
	 */
	var $lastchangeUserId;
	
	/**
	 * Konstruktor
	 */
	function Value()
	{
		global $SESS;

		$this->lastchangeUserId    = 0;
		$this->lastchangeTimeStamp = 0;
		
		$this->languageid = $SESS['languageid'];
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

		$neu = array();
	
		$pre   = false;
		$br    = false;
		$ul    = false;
		$ol    = false;
		$table = false;
		$p     = false;
		
		$text = str_replace( "\n===",'H1H1H1',$text );
		$text = str_replace( "\n---",'H2H2H2',$text );
		$text = str_replace( "\n...",'H3H3H3',$text );

		// Zeichenkette in die einzelnen Zeilen zerlegen
		$zeilen = explode("\n",$text);
		
		foreach( $zeilen as $zeile )
		{
			# Leerzeichen und sonstige Sonderzeichen am Zeilenende entfernen
			$zeile = chop( $zeile );
		
			// Präformatierter Text Anfang
			if   ( $zeile == '='  &&  !$pre )
			{
				$zeile = '<pre>';
				$pre = true;
			}
	
			// Präformatierter Text Ende
			if   ( $zeile == '='  &&  $pre )
			{
				$zeile = '</pre>';
				$pre = false;
			}
		

			// Bei präformatierem Text keine weiteren Formatierungen durchführen	
			if   ( !$pre )
			{
				// Überschrift 1. Ordnung	
				if   ( substr($zeile,0,3) == '!!!' )
				{
					$zeile = '<h1>'.substr($zeile,3).'</h1>';
				}
				
				if   ( ereg( 'H1H1H1.*$',$zeile ) )
				{
					$zeile = eregi_replace( 'H1H1H1.*$','',$zeile );
					$zeile = chop( $zeile );
					$zeile = '<h1>'.$zeile.'</h1>';
				}
				

				// Überschrift 2. Ordnung	
				if   ( substr($zeile,0,2) == '!!' )
				{
					$zeile = '<h2>'.substr($zeile,2).'</h2>';
				}

				if   ( ereg( 'H2H2H2.*$',$zeile ) )
				{
					$zeile = eregi_replace( 'H2H2H2.*$','',$zeile );
					$zeile = chop( $zeile );
					$zeile = '<h2>'.$zeile.'</h2>';
				}
		

				// Überschrift 3. Ordnung	
				if   ( substr($zeile,0,1) == '!' )
				{
					$zeile = '<h3>'.substr($zeile,1).'</h3>';
				}

				if   ( ereg( 'H3H3H3.*$',$zeile ) )
				{
					$zeile = eregi_replace( 'H3H3H3.*$','',$zeile );
					$zeile = chop( $zeile );
					$zeile = '<h3>'.$zeile.'</h3>';
				}
	
	
				// Tabellen
				$beg = substr($zeile,0,1);
				
				if   ( $beg == '|' )
				{
					if   ( !$table )
					{
						$neu[] = '<table>';
						$table = true;
					}
					
					$zeile = ereg_replace( '^\|','<tr><td>',$zeile );
					$zeile = ereg_replace( '\|$','</td></tr>',$zeile );
					$zeile = str_replace( '|','</td><td>',$zeile );

					$zeile = eregi_replace( '<td>!([^<]+)</td>','<th>\\1</th>',$zeile );

					$zeile = eregi_replace( '<td>\(([a-zA-Z0-9]+)\)([^<]+)</td>','<td class="\\1">\\2</td>',$zeile );
					$zeile = eregi_replace( '<th>\(([a-zA-Z0-9]+)\)([^<]+)</th>','<th class="\\1">\\2</th>',$zeile );
				}
				else
				{
					if( $table )
					{
						$table = false;
						$neu[] = '</table>';
					}
				}
				
				$beg = substr($zeile,0,2);
			
				// numerierte Aufzaehlungen
				if   ( $beg == '# ' )
				{
					if   ( !$ol )
					{
						$neu[] = '<ol>';
						$ol = true;
					}
					$zeile = '<li>'.substr($zeile,2).'</li>';
				}
				else
				{
					if ( $ol )
					{
						$ol = false;
						$neu[] = '</ol>';
					}
				}
		
		
				// einfache Aufzaehlungen
				if   ( $beg == '- ' || $beg == '* ' || $beg == 'o ' )
				{
					if   ( !$ul )
					{
						$neu[] = '<ul>';
						$ul = true;
					}
					$zeile = '<li>'.substr($zeile,2).'</li>';
				}
				else
				{
					if ( $ul )
					{
						$ul = false;
						$neu[] = '</ul>';
					}
				}
			}
	
			
			// Absätze einrichten
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
			if   ( !$pre )  // nicht bei präformatiertem Text
			{
				// *Fett*	
				$zeile = ereg_replace( '\*([^*]+[^\\])\*' , '<strong>\\1</strong>' , $zeile );
	
				// kursiv
				$zeile = ereg_replace( '_([^_]+[^\\])_'    , ' <em>\\1</em> ' , $zeile );
				//$zeile = ereg_replace( '\/([^\/:]+)\/', ' <em>\\1</em> ' , $zeile );
	
				// feste Breite
				$zeile = ereg_replace( '=([^=]+[^\\])=' , ' <tt>\\1</tt> ' , $zeile );

				$zeile = str_replace( '\*','*',$zeile );
				$zeile = str_replace( '\_','_',$zeile );
				$zeile = str_replace( '\=','=',$zeile );
	
				// Links
				if   ( $this->element->html )
					$pf = '>';
				else $pf = '&gt;';

				// Text->... umsetzen nach "Text"->... (Anfuehrungszeichen ergaenzen)
				$zeile = ereg_replace( '([A-Za-z0-9._?äöüÄÖÜß-]+)-'.$pf, '"\\1"-'.$pf, $zeile );

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
				$zeile = ereg_replace( '(ima?ge?):\/?\/?(([0-9]+))(\{.*\})?', '<img src="object:\\2" />', $zeile );
		
				# mailto:...-Links
				$zeile = ereg_replace( '([A-Za-z0-9._-]+@[A-Za-z0-9._-]+)', '<a href="mailto:\\1">\\1</a>', $zeile );

				// Links object:nnn ersetzen
				preg_match_all( '|object:([0-9]+)|',$zeile,$objects,PREG_SET_ORDER );
				foreach( $objects as $object )
				{
					$var = $this->page->path_to_object( $object[1] );
					$zeile = str_replace( $object[0],$var,$zeile );
				}
			}
			$neu[] = $zeile;
		}
		
		if   ( $ol    ) $neu[] = '</ol>';
		if   ( $ul    ) $neu[] = '</ul>';
		if   ( $table ) $neu[] = '</table>';
		if   ( $pre   ) $neu[] = '</pre>';
		if   ( $p     ) $neu[] = '</p>';
		
	
		$text = implode("\n",$neu);
		
		$ini_chars = parse_ini_file( $conf_languagedir.'/specialchars.ini.'.$conf_php );
		foreach( $ini_chars  as $key=>$val)
		{
			$text = str_replace( $key,$val,$text );
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


	function load()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT * FROM {t_value}'.
		                '  WHERE elementid ={elementid}'.
		                '    AND pageid    ={pageid}'.
		                '    AND languageid={languageid}'.
		                '    AND active=1' );
		$sql->setInt( 'elementid' ,$this->element->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);
		$row = $db->getRow( $sql->query );
		
		$this->text           = $row['text'];
		$this->valueid        = intval($row['id']          );
		$this->linkToObjectId = intval($row['linkobjectid']);
		$this->number         = intval($row['number'      ]);
		$this->date           = intval($row['date'        ]);

		$this->lastchangeTimeStamp = intval($row['lastchange_date'  ]);
		$this->lastchangeUserId    = intval($row['lastchange_userid']);
	}


	function loadWithId()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT * FROM {t_value}'.
		                '  WHERE id={valueid}' );
		$sql->setInt( 'valueid',$this->valueid);
		$row = $db->getRow( $sql->query );
		
		$this->text           = $row['text'];
		$this->valueid        = intval($row['id']          );
		$this->linkToObjectId = intval($row['linkobjectid']);
		$this->number         = intval($row['number'      ]);
		$this->date           = intval($row['date'        ]);

		$this->lastchangeTimeStamp = intval($row['lastchange_date'  ]);
		$this->lastchangeUserId    = intval($row['lastchange_userid']);
	}


	/**
	 * Alle Versionen des aktuellen Inhaltes werden ermittelt
	 * @return Array
	 */
	function getVersionList()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT id FROM {t_value}'.
		                '  WHERE elementid ={elementid}'.
		                '    AND pageid    ={pageid}'.
		                '    AND languageid={languageid}'.
		                '  ORDER BY lastchange_date' );
		$sql->setInt( 'elementid' ,$this->element->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);

		return $db->getCol( $sql->query );
	}


	/**
	 * Inhalt speichern
	 */
	function save()
	{
		global $SESS;
		$db = db_connection();

//		$sql = new Sql( 'UPDATE {t_value}'.
//		                ' SET '.
//		                '     linkobjectid    = {linkobjectid},'.
//		                '     text            = {defaultText},'.
//		                '     number          = {folderObjectId},'.
//		                '     date            = {defaultObjectId},'.
//		                '     active          = 1'.
//		                '  WHERE elementid ={elementid}'.
//		                '    AND pageid    ={pageid}'.
//		                '    AND languageid={languageid}' );
		$sql = new Sql( 'UPDATE {t_value}'.
		                '  SET active=0'.
		                '  WHERE elementid ={elementid}'.
		                '    AND pageid    ={pageid}'.
		                '    AND languageid={languageid}' );
		$sql->setInt( 'elementid' ,$this->element->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);

		$db->query( $sql->query );

		$sql = new Sql('SELECT MAX(id) FROM {t_value}');
		$this->valueid = intval($db->getOne($sql->query))+1;

		$sql->setQuery( 'INSERT INTO {t_value}'.
		                '        (id,linkobjectid,text,number,date,elementid,pageid,languageid,active,lastchange_date,lastchange_userid)'.
		                ' VALUES ({valueid},{linkobjectid},{text},{number},{date},{elementid},{pageid},{languageid},1,{lastchange_date},{lastchange_userid})' );

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

		$sql->setInt   ( 'lastchange_date'  ,time()  );
		$sql->setInt   ( 'lastchange_userid',$SESS['user']['userid'] );

		$db->query( $sql->query );
	}


	/**
	 * Diesen Inhalt löschen
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
	 * Inhalt ermitteln
	 */
	function generate()
	{
		if	( intval($this->valueid)==0 )
			$this->load();
		global $db,
		       $conf,
		       $conf_php,
		       $conf_tmpdir,
		       $SESS;
	
		$inhalt = '';

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
									case 'page':
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
									case 'link':
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

				if   ( $this->simple )
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
	
				if   ( $this->simple )
				{
					$p = new Page( $objectid );
					$p->load();
					$inhalt = $p->name;
				}
				else
				{
					$inhalt = $this->page->path_to_object( $objectid );
				}
				
				break;


			case 'longtext':
			case 'text':

				$inhalt = $this->text;
	
				if   ( $inhalt == '' )
					$inhalt = $this->element->defaultText;

				// Wenn HTML nicht erlaubt ist, dann die HTML-Tags ersetzen
				if   ( !$this->element->html )
				{
					$inhalt = str_replace('<','&lt;',$inhalt);
					$inhalt = str_replace('>','&gt;',$inhalt);
				}
	
				// Schnellformatierung ('Wiki') durchführen
				if   ( $this->element->wiki )
				{
					$inhalt = $this->decode_wiki( $inhalt );
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
					$date = time();

				$inhalt = date( $this->element->dateformat,$date );
				
				break;


			// Programmcode (PHP)
			case 'code':

				$this->page->load();
				
				Api::delOutput('');
				$code = "<?php\n".$this->element->code."\n?>";
				$tmp  = $conf_tmpdir.'/'.md5($this->element->elementid).'.tmp';
				$f = fopen( $tmp,'w' );
				fwrite( $f,$code );
				fclose( $f );
				
				require( $tmp );

				$inhalt = Api::getOutput();
				
				break;


			// Info-Feld als Datum
			case 'infodate':
				
				switch( $this->element->subtype )
				{
					case 'date_published':
						$inhalt = date( $this->element->dateformat );
						break;
						
					case 'date_saved':
						$inhalt = date( $this->element->dateformat );
						break;

					case 'date_created':
						$inhalt = date( $this->element->dateformat );
						break;

					default:  
						$inhalt = date( $this->element->dateformat );
				}
				
				break;


			// Info-Feld
			case 'info':

				switch( $this->element->subtype )
				{
					case 'db_id':
						$inhalt = $SESS['dbid'];
						break;
					case 'db_name':
						$inhalt = '';
						break;
					case 'project_id':
						$inhalt = '';
						break;
					case 'project_name':
						$inhalt = '';
						break;
					case 'language_id':
						$inhalt = '';
						break;
					case 'language_iso':
						$inhalt = '';
						break;
					case 'language_name':
						$inhalt = '';
						break;
					case 'page_id':
						$inhalt = '';
						break;
					case 'page_name':
						$inhalt = '';
						break;
					case 'page_desc':
						$inhalt = '';
						break;
					case 'page_fullfilename':
						$inhalt = '';
						break;
					case 'page_filename':
						$inhalt = '';
						break;
					case 'page_extension':
						$inhalt = '';
						break;
					case 'lastchange_user_username':
						$inhalt = '';
						break;
					case 'lastchange_user_fullname':
						$inhalt = '';
						break;
					case 'lastchange_user_mail':
						$inhalt = '';
						break;
					case 'lastchange_user_desc':
						$inhalt = '';
						break;
					case 'lastchange_user_tel':
						$inhalt = '';
						break;
					case 'create_user_username':
						$inhalt = '';
						break;
					case 'create_user_fullname':
						$inhalt = '';
						break;
					case 'create_user_mail':
						$inhalt = '';
						break;
					case 'create_user_desc':
						$inhalt = '';
						break;
					case 'create_user_tel':
						$inhalt = '';
						break;
					case 'act_user_username':
						$inhalt = '';
						break;
					case 'act_user_fullname':
						$inhalt = '';
						break;
					case 'act_user_mail':
						$inhalt = '';
						break;
					case 'act_user_desc':
						$inhalt = '';
						break;
					case 'act_user_tel':
						$inhalt = '';
						break;
					default:
						$inhalt = '';
				}
				break;
		}
		
		if   ( $this->page->icons && $this->element->withIcon )
			$inhalt = '<a href="do.'.$conf_php.'?action=pageelement&elementid='.$this->element->elementid.'&pageelementaction=edit'.'" title="'.$this->element->desc.'" target="cms_main_main"><img src="'.$conf['directories']['themedir'].'/images/icon_el_'.$this->element->type.'.png" border="0" align="left"></a>'.$inhalt;
		
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
	  * @param Integer Benutzer-Id der letzten Änderung
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