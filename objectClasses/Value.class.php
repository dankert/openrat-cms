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
	 * Kennzeichen, ob der Inhalt mit dem Inhalt einer anderern Seite verknüpft wird.
	 * @type Object
	 */
	var $isLink = false;
	
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
		else
			$sql = new Sql( 'SELECT * FROM {t_value}'.
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

		$sql = new Sql( <<<SQL
INSERT INTO {t_value}
            (id       ,linkobjectid  ,text  ,number  ,date  ,elementid  ,pageid  ,languageid  ,active,publish  ,lastchange_date  ,lastchange_userid  )
     VALUES ({valueid},{linkobjectid},{text},{number},{date},{elementid},{pageid},{languageid},1     ,{publish},{lastchange_date},{lastchange_userid})
SQL
		);
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

		$sql->setBoolean( 'publish'          ,$this->publish );
		$sql->setInt    ( 'lastchange_date'  ,time()         );
		$user = Session::getUser();
		$sql->setInt    ( 'lastchange_userid',$user->userid  );

		$db->query( $sql->query );
	}


	/**
	 * Diesen Inhalt loeschen
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
	 * Hier findet die eigentliche Bereitstellung des Inhaltes statt, zu
	 * jedem Elementtyp wird ein Inhalt ermittelt.
	 */
	function generate()
	{
		if	( intval($this->valueid)==0 )
			$this->load();
		$db = db_connection();
		global $conf;
	
		$inhalt = '';

//		Logger::debug('Generating Element '.$this->element->name.', type='.$this->element->type );

		// Inhalt ist mit anderer Seite verknüpft.
		if	( in_array($this->element->type,array('text','longtext','date','number')) && intval($this->linkToObjectId) != 0 && !$this->isLink )
		{
			$p = new Page( $this->linkToObjectId );
			$p->load();
			
			$v = new Value();
			$v->isLink     = true;
			$v->pageid     = $p->pageid;
			$v->element    = $this->element;
			$v->languageid = $this->languageid;
			$v->load();
			$v->generate();
			$this->value = $v->value;
			return;
		}
		
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
				elseif	 ( ! Object::available($objectid) )
				{
					$inhalt = $this->simple?'-':'';
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


			case 'copy':

				@list($linkElementName,$targetElementName) = explode('%',$this->element->name);

				if	( is_null($targetElementName) )
					break;

				$element = new Element();
				$element->name = $linkElementName;
				$element->load();
				
				if	( intval($element->elementid)==0 )
					break;
				
				$linkValue = new Value();
				$linkValue->elementid = $element->elementid;
				$linkValue->element   = $element;
				$linkValue->pageid = $this->pageid;
				$linkValue->languageid = $this->languageid;
				$linkValue->load();
				
				if	( !Object::available( $linkValue->linkToObjectId ) )
					break;

				$linkedPage = new Page( $linkValue->linkToObjectId );
				$linkedPage->load();

				$linkedPageTemplate = new Template( $linkedPage->templateid );
				$targetElementId = array_search( $targetElementName, $linkedPageTemplate->getElementNames() );
				
				$targetValue = new Value();
				$targetValue->elementid = $targetElementId;
				$targetValue->element = new Element($targetElementId);
				$targetValue->element->load();
				$targetValue->pageid = $linkedPage->pageid;
				$targetValue->generate();
				
				$inhalt = $targetValue->value; 
				
				break;


			case 'linkinfo':

				@list( $linkElementName, $name ) = explode('%',$this->element->name);
				if	( is_null($name) )
					break;
					
				$element = new Element();
				$element->name = $linkElementName;
				$element->load();
				
				$linkValue = new Value();
				$linkValue->elementid = $element->elementid;
				$linkValue->element   = $element;
				$linkValue->pageid = $this->pageid;
				$linkValue->languageid = $this->languageid;
				$linkValue->load();
				
				//Html::debug( $linkValue );
				
				if	( !Object::available( $linkValue->linkToObjectId ) )
					break;
					
				$linkedObject = new Object( $linkValue->linkToObjectId );
				$linkedObject->load();
				
				switch( $this->element->subtype )
				{
					case 'width':
						$f = new File( $linkValue->linkToObjectId );
						$f->load();
						if	( $f->isImage() )
						{
							$f->getImageSize();
							$inhalt = $f->width;
						}
						unset($f);
					break;
					
					case 'height':
						$f = new File( $linkValue->linkToObjectId );
						$f->load();
						if	( $f->isImage() )
						{
							$f->getImageSize();
							$inhalt = $f->height;
						}
						unset($f);
					break;
					
					default:
//						$inhalt = ''; 
						$inhalt = '?subtype for linkinfo not implemented: '.$this->element->subtype.'?'; 
				}			
				
				break;


			case 'longtext':
			case 'text':
			case 'select':

				$inhalt = $this->text;
	
				// Wenn Inhalt leer, dann Vorbelegung verwenden
				if   ( $inhalt == '' )
					$inhalt = $this->element->defaultText;

				// Wenn HTML nicht erlaubt und Wiki-Formatierung aktiv, dann einfache HTML-Tags in Wiki umwandeln
				if   ( !$this->element->html && $this->element->wiki && $conf['wiki']['convert_html'] )
					$inhalt = Text::html2Wiki( $inhalt );

				// Wenn Wiki-Formatierung aktiv, dann BB-Code umwandeln
				if   ( $this->element->wiki && $conf['wiki']['convert_bbcode'] )
					$inhalt = Text::bbCode2Wiki( $inhalt );

				// Wenn HTML nicht erlaubt ist, dann die HTML-Tags ersetzen
				if   ( !$this->element->html && !$this->element->wiki )
					$inhalt = Text::encodeHtml( $inhalt );

				// Schnellformatierung ('Wiki') durchfuehren
				if   ( $this->element->wiki )
				{
					$transformer = new Transformer();
					$transformer->text = $inhalt;
					$transformer->page = $this->page;
					$transformer->type = $this->page->template->extension;

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

				if   ( $this->number == 0 )
				{
					// Zahl ist gleich 0, dann Default-Text
					$inhalt = $this->element->defaultText;
					break;
				}
	
				$number = $this->number / pow(10,$this->element->decimals);
				$inhalt = number_format( $number,$this->element->decimals,$this->element->decPoint,$this->element->thousandSep );
	
				break;
	
	
			// Datum
			case 'date':

				$date = $this->date;

				if   ( intval($date) == 0 )
				{
					// Datum wurde noch nicht eingegeben
					$inhalt = $this->element->defaultText;
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
						$inhalt .= '/'.basename(Html::url('index','object',$this->page->objectid,array('dbid'=>$db->id)));
						break;
					case 'lastch_user_username':
						$user = $this->page->lastchangeUser;
						$user->load();
						$inhalt = $user->name;
						break;
					case 'lastch_user_fullname':
						$user = $this->page->lastchangeUser;
						$user->load();
						$inhalt = $user->fullname;
						break;
					case 'lastch_user_mail':
						$user = $this->page->lastchangeUser;
						$user->load();
						$inhalt = $user->mail;
						break;
					case 'lastch_user_desc':
						$user = $this->page->lastchangeUser;
						$user->load();
						$inhalt = $user->desc;
						break;
					case 'lastch_user_tel':
						$user = $this->page->lastchangeUser;
						$user->load();
						$inhalt = $user->tel;
						break;

					case 'create_user_username':
						$user = $this->page->createUser;
						$user->load();
						$inhalt = $user->name;
						break;
					case 'create_user_fullname':
						$user = $this->page->createUser;
						$user->load();
						$inhalt = $user->fullname;
						break;
					case 'create_user_mail':
						$user = $this->page->createUser;
						$user->load();
						$inhalt = $user->mail;
						break;
					case 'create_user_desc':
						$user = $this->page->createUser;
						$user->load();
						$inhalt = $user->desc;
						break;
					case 'create_user_tel':
						$user = $this->page->createUser;
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
				
				$inhalt = Text::encodeHtml( $inhalt );
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