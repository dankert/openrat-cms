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
// Revision 1.1  2004-03-13 23:09:48  dankert
// *** empty log message ***
//
// ---------------------------------------------------------------------------


class Element
{
	var $elementid;
	var $templateid;
	var $pageid;
	var $languageid;
	var $type;
	var $name;
	var $value;
	var $page;
	var $folderid;

	function Element( $elementid )
	{
		$this->elementid = $elementid;
	}


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
		
		$text = str_replace( "\n===",'===',$text );
		$text = str_replace( "\n---",'---',$text );
		$text = str_replace( "\n...",'...',$text );

		// Zeichenkette in die einzelnen Zeilen zerlegen
		$zeilen = explode("\n",$text);
		
		foreach( $zeilen as $zeile )
		{
			# Leerzeichen und sonstige Sonderzeichen am Zeilenende entfernen
			$zeile = chop( $zeile );
		
			// Pr‰formatierter Text Anfang
			if   ( $zeile == '='  &&  !$pre )
			{
				$zeile = '<pre>';
				$pre = true;
			}
	
			// Pr‰formatierter Text Ende
			if   ( $zeile == '='  &&  $pre )
			{
				$zeile = '</pre>';
				$pre = false;
			}
		
	
			if   ( !$pre )  // nicht bei pr‰formatiertem Text
			{
				// ‹berschrift 1. Ordnung	
				if   ( substr($zeile,0,3) == '!!!' )
				{
					$zeile = '<h1>'.substr($zeile,3).'</h1>';
				}
				
				if   ( ereg( '\=\=\=$',$zeile ) )
				{
					$zeile = eregi_replace( '\=+$','',$zeile );
					$zeile = chop( $zeile );
					$zeile = '<h1>'.$zeile.'</h1>';
				}
				

				// ‹berschrift 2. Ordnung	
				if   ( substr($zeile,0,2) == '!!' )
				{
					$zeile = '<h2>'.substr($zeile,2).'</h2>';
				}

				if   ( ereg( '\-\-\-$',$zeile ) )
				{
					$zeile = eregi_replace( '\-+$','',$zeile );
					$zeile = chop( $zeile );
					$zeile = '<h2>'.$zeile.'</h2>';
				}
		

				// ‹berschrift 3. Ordnung	
				if   ( substr($zeile,0,1) == '!' )
				{
					$zeile = '<h3>'.substr($zeile,1).'</h3>';
				}

				if   ( ereg( '\.\.\.$',$zeile ) )
				{
					$zeile = eregi_replace( '\.+$','',$zeile );
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
	
			
			// Abs‰tze einrichten
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
			if   ( !$pre )  // nicht bei pr‰formatiertem Text
			{
				// *Fett*	
				$zeile = ereg_replace( '\*\*([^*]+)\*\*' , '<strong>\\1</strong>' , $zeile );
	
				// kursiv
				$zeile = ereg_replace( '__([^_]+)__'    , ' <em>\\1</em> ' , $zeile );
				$zeile = ereg_replace( '\/\/([^\/:]+)\/\/', ' <em>\\1</em> ' , $zeile );
	
				// feste Breite
				$zeile = ereg_replace( '==([^=]+)==' , ' <tt>\\1</tt> ' , $zeile );
	
				// Links
						
				# abc->http://...-Links
				
				
				if   ( $this->html )
					$pf = '>';
				else $pf = '&gt;';

				# Links "mit->..."
				$zeile = ereg_replace( '\"([^\"]+)\"-'.$pf.'((https?|ftps?|page|file):\/\/([A-Za-z0-9._\/\,\?\=\&-]*))'             , '<a href="\\2">\\1</a>', $zeile );
				$zeile = ereg_replace( '([A-Za-z0-9._?‰ˆ¸ƒ÷‹ﬂ-]+)-'.$pf.'((https?|ftps?|page|file):\/\/([A-Za-z0-9._\/\,\?\=\&-]*))', '<a href="\\2">\\1</a>', $zeile );
		
				# alleinstehende HTTP oder FTP-Links
				$zeile = ereg_replace( '([^"])((https?|ftps?|page|file):\/\/([A-Za-z0-9._\/\,-]*))', '\\1<a href="\\2">\\4</a>', $zeile );
				$zeile = ereg_replace( '^((https?|ftps?|page|file):\/\/([A-Za-z0-9._\/\,-]*))', '<a href="\\1">\\3</a>', $zeile );
				$zeile = ereg_replace( '((ima?ge?):\/\/([0-9]+))(\{.*\})?', '<img src="\\1" />', $zeile );
				//$zeile = ereg_replace( '((https?|ftps?|page|file):\/\/([A-Za-z0-9._\/-]*))', '<a href="\\1">\\3</a>', $zeile );
		
				# mailto:...-Links
				$zeile = ereg_replace( '([A-Za-z0-9._-]+@[A-Za-z0-9._-]+)', '<a href="mailto:\\1">\\1</a>', $zeile );
		
				// Links image://... ersetzen
				preg_match_all( '|ima?ge?:\/\/([0-9]+)(\{.*\})?| ',$zeile,$images,PREG_SET_ORDER );
				//print_r($images);
				foreach( $images as $image )
				{
					//echo "id".$image[1].'<br>';
					$var = $this->page->path_to_file( $image[1] );
					//echo "ergibt".$var.'<br>';
					$zeile = str_replace( $image[0],$var,$zeile );
				}
		
				// Links page://... ersetzen
				preg_match_all( '|page:\/\/([0-9]+)(\{.*\})?|',$zeile,$pages,PREG_SET_ORDER );
				foreach( $pages as $page )
				{
					$var = $this->page->path_to_object( $page[1] );
					$zeile = str_replace( $page[0],$var,$zeile );
				}
	
				// Links file://... ersetzen
				preg_match_all( '|file:\/\/([0-9]+)(\{.*\})?|',$zeile,$files,PREG_SET_ORDER );
				foreach( $files as $file )
				{
					$var = $this->page->path_to_file( $file[1] );
					$zeile = str_replace( $file[0],$var,$zeile );
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


	function add( $name )
	{
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
		
		$sql = new Sql( 'SELECT * FROM {t_element}'.
		                ' WHERE id={elementid}'      );
		$sql->setInt( 'elementid',$this->elementid );
		$prop = $db->getRow( $sql->query );
		
		$this->templateid     = $prop['templateid'];
		$this->name           = $prop['name'];
		$this->desc           = $prop['desc'];
		$this->type           = $prop['type'];
		$this->subtype        = $prop['subtype'];

		if   ( $prop['with_icon'] == '1' )
			$this->with_icon = true;
		else	$this->with_icon = false;
  
		$this->folderid       = $prop['folderid'];
		$this->extension      = $prop['extension'];
		$this->dateformat     = $prop['dateformat'];
		$this->width          = $prop['width'];
		$this->height         = $prop['height'];

		if   ( $prop['wiki'] == '1' )
			$this->wiki = true;
		else	$this->wiki = false;
  
		if   ( $prop['html'] == '1' )
			$this->html = true;
		else	$this->html = false;
  
		$this->decimals         = $prop['decimals'];
		$this->dec_point        = $prop['dec_point'];
		$this->thousand_sep     = $prop['thousand_sep'];
		$this->code             = $prop['code'];
		$this->default_text     = $prop['default_text'];
		$this->default_objectid = intval($prop['default_objectid']);
	}



	// Element speichern
	function save()
	{
		$db = db_connection();
		
		$sql = new Sql( 'UPDATE {t_element}'.
		                ' SET templateid      = {templateid},'.
		                '     name            = {name},'.
		                '     `desc`          = {desc},'.
		                '     type            = {type},'.
		                '     subtype         = {subtype},'.
		                '     with_icon       = {with_icon},'.
		                '     folderid        = {folderid},'.
		                '     extension       = {extension},'.
		                '     dateformat      = {dateformat},'.
		                '     width           = {width},'.
		                '     height          = {height},'.
		                '     wiki            = {wiki},'.
		                '     html            = {html},'.
		                '     decimals        = {decimals},'.
		                '     dec_point       = {dec_point},'.
		                '     thousand_sep    = {thousand_sep},'.
		                '     code            = {code},'.
		                '     default_text    = {default_text},'.
		                '     default_objectid= {default_objectid}'.
		                ' WHERE id={elementid}'      );

		$sql->setInt    ( 'elementid'       ,$this->elementid        );
		$sql->setInt    ( 'templateid'      ,$this->templateid       );
		$sql->setString ( 'name'            ,$this->name             );
		$sql->setString ( 'desc'            ,$this->desc             );
		$sql->setString ( 'type'            ,$this->type             );
		$sql->setString ( 'subtype'         ,$this->subtype          );
		$sql->setBoolean( 'with_icon'       ,$this->with_icon        );
		$sql->setInt    ( 'folderid'        ,$this->folderid         );
		$sql->setString ( 'extension'       ,$this->extension        );
		$sql->setString ( 'dateformat'      ,$this->dateformat       );
		$sql->setInt    ( 'width'           ,$this->width            );
		$sql->setInt    ( 'height'          ,$this->height           );
		$sql->setBoolean( 'wiki'            ,$this->wiki             );
		$sql->setBoolean( 'html'            ,$this->html             );
		$sql->setInt    ( 'decimals'        ,$this->decimals         );
		$sql->setString ( 'dec_point'       ,$this->dec_point        );
		$sql->setString ( 'thousand_sep'    ,$this->thousand_sep     );
		$sql->setString ( 'code'            ,$this->code             );
		$sql->setString ( 'default_text'    ,$this->default_text     );
		$sql->setInt    ( 'default_objectid',$this->default_objectid );
		
//		echo $sql->query;

		$db->query( $sql->query );
		
		
	}



	// Element speichern
	function setType( $type )
	{
		$db = db_connection();
		
		$sql = new Sql( 'UPDATE {t_element}'.
		                ' SET type            = {type}'.
		                ' WHERE id={elementid}'         );

		$sql->setInt    ( 'elementid',$this->elementid );
		$sql->setString ( 'type'     ,$type            );

		$db->query( $sql->query );
	}


	function delete()
	{
		// Alle Inhalte mit diesem Element lˆschen
		$sql = new Sql('DELETE FROM {t_value} '.
		               '  WHERE elementid={elementid}'   );
		$sql->setInt( 'elementid',$this->elementid );
		$db->query( $sql->query );

		// Element lˆschen
		$sql = new Sql('DELETE FROM {t_element} '.
		               '  WHERE id={elementid}'   );
		$sql->setInt( 'elementid',$this->elementid );

		$db->query( $sql->query );
	}


	function generate()
	{
		$this->load();
		global $db,
		       $conf,
		       $conf_php,
		       $conf_tmpdir,
		       $SESS;
	
		// Inhalt aus Datenbank lesen
		$sql = new Sql('SELECT * FROM {t_value} '.
		               ' WHERE elementid={elementid}'.
		               '   AND pageid={pageid}'.
		               '   AND languageid={languageid}' );
		               
		$sql->setInt('elementid' ,$this->elementid  );
		$sql->setInt('pageid'    ,$this->pageid     );
		$sql->setInt('languageid',$this->languageid );
		
		$val = $db->getRow( $sql->query );
		
		$this->lastchange_date   = $val['lastchange_date'  ];
		$this->lastchange_userid = $val['lastchange_userid'];
		$inhalt = '';

		switch( $this->type )
		{
			case 'include':

				// Ermitteln des Inhalte
				// (hier kann es mehrere Ergebnisse geben)
				$res_incl = $db->query( $sql->query );
	
				while( $row_incl = $res_incl->fetchRow() )
				{
					// Rekursion vermeiden
					if	( $row_incl['linkpageid'] != $this->pageid )
					{
						$p = new Page( Page::getObjectIdFromPageId($row_incl['linkpageid']) );
						$p->public = $this->page->public;
						$p->projectmodelid = $this->page->projectmodelid;
						$p->languageid = $this->languageid;
						$p->load();
						$p->generate();
						$inhalt .= $p->value;
						unset( $p );
					}
				}
				
				if   ( $this->simple )
				{
					$inhalt = strip_tags( $inhalt );
					$inhalt = str_replace( "\n",'',$inhalt );
					$inhalt = str_replace( "\r",'',$inhalt );
				}
				
				break;



			case 'resize':

				$fileid = $val['fileid'];
				
				if   ( $fileid == '' )
					$fileid = $this->default_fileid;
	
				if   ( $this->public )
				{ 
					$inhalt = $this->up_path();
					
					$file = new File();
					$file->fileid = $fileid;
		
					$inhalt .= $file->full_filename();
				}
				else
				{
					$inhalt = "file.$conf_php?fileaction=showresize&fileid=".$fileid."&width=".$el['width']."&height=".$el['height'];
					$inhalt = sid($inhalt);
				}
				
				break;


			case 'file':
			case 'link':

				$objectid = $val['linkobjectid'];
				
				if   ( !is_numeric($objectid) || $objectid==0 )
					$objectid = $this->default_objectid;
	
				if   ( $this->simple )
				{
					$p = new Page( $objectid );
					$p->load();
					$inhalt = $p->name;
				}
				else
				{
//					echo "p2o $objectid";
					$inhalt = $this->page->path_to_object( $objectid );
//					echo "Inhalt: $inhalt <br>";
				}
				
				break;


			case 'longtext':

				$inhalt = $val['text'];
	
				if   ( $inhalt == '' )
					$inhalt = $this->default_text;

				// Wenn HTML nicht erlaubt ist, dann die HTML-Tags ersetzen
				if   ( !$this->html )
				{
					$inhalt = str_replace('<','&lt;',$inhalt);
					$inhalt = str_replace('>','&gt;',$inhalt);
				}
	
				// Schnellformatierung ('Wiki') durchf¸hren
				if   ( $this->wiki )
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


			case 'text':

				$inhalt = $val['text'];
				
				if   ( $inhalt == '' )
					$inhalt = $this->default_text;
				
				// Wenn HTML nicht erlaubt ist, dann die HTML-Tags ersetzen
				if   ( $this->html )
				{
					$inhalt = str_replace('<','&lt;',$inhalt);
					$inhalt = str_replace('>','&gt;',$inhalt);
				}
	
				// Schnellformatierung ('Wiki') durchf¸hren
				if   ( $this->wiki )
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
	
				$number = $val['number'] / pow(10,$this->decimals);
				$inhalt = number_format( $number,$this->decimals,$this->dec_point,$this->thousand_sep );
	
				break;
	
	
			// Datum
			case 'date':

				if   ( !is_numeric($val['date']) )
					$val['date'] = time();
					
				$inhalt = date( $this->dateformat,$val['date'] );
				
				break;


			// Programmcode (PHP)
			case 'code':

				$this->page->load();
				
				Api::delOutput('');
				$code = "<?php\n".$this->code."\n?>";
				$tmp  = $conf_tmpdir.'/'.md5($this->pageid.'_'.$this->projectmodelid.'_'.$this->elementid).'.tmp';
				$f = fopen( $tmp,'w' );
				fwrite( $f,$code );
				fclose( $f );
				
				//error_reporting( E_NOTICE );
				require( $tmp );
				//error_reporting( E_PARSE );

				$inhalt = Api::getOutput();
				
				break;


			// Info-Feld als Datum
			case 'infodate':
				
				$inhalt = date( $this->dateformat );
				
				break;


			// Info-Feld
			case 'info':

				//echo "aha:".$el['subtype'].'<br>';		
				if   ( $this->subtype == 'id_db' )
					$inhalt = $SESS['dbid'];
	
				if   ( $this->subtype == 'id_project' )
					$inhalt = $SESS['projectid'];
	
				if   ( $this->subtype == 'id_projectmodel' )
					$inhalt = $this->projectmodelid;
	
				if   ( $this->subtype == 'id_language' )
					$inhalt = $this->languageid;
	
				if   ( $this->subtype == 'id_page' )
					$inhalt = $SESS['pageid'];
	
				if   ( $this->subtype == 'id_user' )
					$inhalt = $SESS['user']['id'];
	
				if   ( $this->subtype == 'id_pageuser' )
					$inhalt = '0';
	
				if   ( $this->subtype == 'name_db' )
					$inhalt = $conf['database_'.$SESS['dbid']]['name'];
	
				if   ( $this->subtype == 'name_project' )
				{
					$sql = "SELECT name FROM $t_project WHERE id=".$SESS['projectid'];
					$inhalt = $db->getOne($sql);
				}
	
				if   ( $this->subtype == 'name_page' )
				{
					$inhalt = $this->page->name;
				}
	
				if   ( $this->subtype == 'name_user' )
					$inhalt = $SESS['user']['name'];
	
				if   ( $this->subtype == 'fullname_user' )
					$inhalt = $SESS['user']['fullname'];
	
				if   ( $this->subtype == 'mail_user' )
					$inhalt = $SESS['user']['mail'];
	
				if   ( $this->subtype == 'name_pageuser' )
				{
					$sql = "SELECT name FROM $t_user WHERE id=1";
					$inhalt = $db->getOne($sql);
				}
				
				break;
		}
		
		if   ( $this->icons && $this->with_icon )
			$inhalt = '<a href="'.sid('pageelement.'.$conf_php.'?elementid='.$this->id.'&pageelementaction=edit').'" title="'.$this->desc.'" target="cms_main_main"><img src="'.$conf['directories']['themedir'].'/images/icon_el_'.$this->type.'.gif" border="0" align="left"></a>'.$inhalt;
		
		$this->value = $inhalt;
	}
}