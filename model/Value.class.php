<?php
// OpenRat Content Management System
// Copyright (C) 2002-2012 Jan Dankert, cms@jandankert.de
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
	 * Seiten-Id der uebergeordneten Seite
	 * @type Integer
	 */
	var $pageid;
	
	/**
	 * Kennzeichen, ob der Inhalt mit dem Inhalt einer anderern Seite verkn�pft wird.
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
		if	( is_object($language) )
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
			$sql = $db->sql( 'SELECT * FROM {{value}}'.
			                '  WHERE elementid ={elementid}'.
			                '    AND pageid    ={pageid}'.
			                '    AND languageid={languageid}'.
			                '    AND publish=1' );
		else
			$sql = $db->sql( 'SELECT * FROM {{value}}'.
			                '  WHERE elementid ={elementid}'.
			                '    AND pageid    ={pageid}'.
			                '    AND languageid={languageid}'.
			                '    AND active=1' );
		$sql->setInt( 'elementid' ,$this->element->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);
		$row = $sql->getRow( $sql );
		
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

		$sql = $db->sql( 'SELECT {{value}}.*,{{user}}.name as lastchange_username'.
		                ' FROM {{value}}'.
		                ' LEFT JOIN {{user}} ON {{user}}.id={{value}}.lastchange_userid'.
		                '  WHERE {{value}}.id={valueid}' );
		$sql->setInt( 'valueid',$this->valueid);
		$row = $sql->getRow( $sql );
		
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

		$sql = $db->sql( 'SELECT {{value}}.*,{{user}}.name as lastchange_username'.
		                '  FROM {{value}}'.
		                '  LEFT JOIN {{user}} ON {{user}}.id={{value}}.lastchange_userid'.
		                '  WHERE elementid ={elementid}'.
		                '    AND pageid    ={pageid}'.
		                '    AND languageid={languageid}'.
		                '  ORDER BY lastchange_date' );
		$sql->setInt( 'elementid' ,$this->element->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);

		$list = array();
		foreach( $sql->getAll( $sql ) as $row )
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

		$sql = $db->sql( 'SELECT COUNT(*) FROM {{value}}'.
		                '  WHERE elementid ={elementid}'.
		                '    AND pageid    ={pageid}'.
		                '    AND languageid={languageid}' );
		$sql->setInt( 'elementid' ,$this->element->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);

		return $sql->getOne( $sql );
	}


	function getLastChangeTime()
	{
		$db = db_connection();

		$sql = $db->sql( 
<<<SQL
	SELECT lastchange_date FROM {{value}}
		WHERE elementid ={elementid}
		  AND pageid    ={pageid}
		  AND languageid={languageid}
		  ORDER BY id DESC
SQL
		);
		$sql->setInt( 'elementid' ,$this->element->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);

		return $sql->getOne( $sql );
	}
	
	
	
	/**
	 * Inhalt freigeben
	 */
	function release()
	{
		$db = db_connection();

		$sql = $db->sql( 'UPDATE {{value}}'.
		                '  SET publish=0'.
		                '  WHERE elementid ={elementid}'.
		                '    AND pageid    ={pageid}'.
		                '    AND languageid={languageid}' );
		$sql->setInt( 'elementid' ,$this->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);

		$sql->query( $sql );

		$sql = $db->sql( 'UPDATE {{value}}'.
		                '  SET publish=1'.
		                '  WHERE active    = 1'.
		                '    AND elementid ={elementid}'.
		                '    AND pageid    ={pageid}'.
		                '    AND languageid={languageid}' );
		$sql->setInt( 'elementid' ,$this->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);

		$sql->query( $sql );
	}

	/**
	 * Inhalt speichern
	 */
	function save()
	{
		global $SESS;
		$db = db_connection();

		$sql = $db->sql( 'UPDATE {{value}}'.
		                '  SET active=0'.
		                '  WHERE elementid ={elementid}'.
		                '    AND pageid    ={pageid}'.
		                '    AND languageid={languageid}' );
		$sql->setInt( 'elementid' ,$this->element->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);

		$sql->query( $sql );

		if	( $this->publish )
		{
			// Wenn Inhalt sofort veroeffentlicht werden kann, dann
			// alle anderen Inhalte auf nicht-veroeffentlichen stellen 
			$sql = $db->sql( 'UPDATE {{value}}'.
			                '  SET publish=0'.
			                '  WHERE elementid ={elementid}'.
			                '    AND pageid    ={pageid}'.
			                '    AND languageid={languageid}' );
			$sql->setInt( 'elementid' ,$this->element->elementid );
			$sql->setInt( 'pageid'    ,$this->pageid    );
			$sql->setInt( 'languageid',$this->languageid);

			$sql->query( $sql );
		}

		// Naechste ID aus Datenbank besorgen
		$sql = $db->sql('SELECT MAX(id) FROM {{value}}');
		$this->valueid = intval($sql->getOne($sql))+1;

		$sql = $db->sql( <<<SQL
INSERT INTO {{value}}
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
		$sql->setInt    ( 'lastchange_date'  ,now()         );
		$user = Session::getUser();
		$sql->setInt    ( 'lastchange_userid',$user->userid  );

		$sql->query( $sql );
		
		// Nur ausfuehren, wenn in Konfiguration aktiviert.
		$limit = config('content','revision-limit');
		if	( isset($limit['enabled']) && $limit['enabled'] )
			$this->checkLimit();
	}

	
	/**
	 * Pruefen, ob maximale Anzahl von Versionen erreicht.
	 * In diesem Fall die zu alten Versionen l�schen.
	 */
	function checkLimit()
	{
		$limit = config('content','revision-limit');

		$db = db_connection();

		$sql = $db->sql( <<<SQL
		SELECT id FROM {{value}}
			                  WHERE elementid  = {elementid}
			                    AND pageid     = {pageid}
			                    AND languageid = {languageid}
			                    AND active     = 0
			                    AND publish    = 0
			                   ORDER BY id
SQL
		);
		$sql->setInt( 'elementid' ,$this->element->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid             );
		$sql->setInt( 'languageid',$this->languageid         );
		$values = $sql->getCol( $sql );
		
		if	( count($values) > $limit['min-revisions'] )
		{
			$sql = $db->sql( <<<SQL
			DELETE FROM {{value}}
				                  WHERE elementid  = {elementid}
				                    AND pageid     = {pageid}
				                    AND languageid = {languageid}
				                    AND active     = 0
				                    AND publish    = 0
				                    AND lastchange_date < {min_date}
				                    AND id              < {min_id}
SQL
			);
			$sql->setInt( 'elementid' ,$this->element->elementid );
			$sql->setInt( 'pageid'    ,$this->pageid             );
			$sql->setInt( 'languageid',$this->languageid         );
			$sql->setInt( 'min_date'  ,$limit['max-age']*24*60*60);
			$sql->setInt( 'min_id'    ,$values[count($values)-$limit['min-revisions']]);
			$sql->query($sql);
		}
		
		if	( count($values) > $limit['max-revisions'] )
		{
			$sql = $db->sql( <<<SQL
			DELETE FROM {{value}}
				                  WHERE elementid  = {elementid}
				                    AND pageid     = {pageid}
				                    AND languageid = {languageid}
				                    AND active     = 0
				                    AND publish    = 0
				                    AND lastchange_date < {min_date}
				                    AND id              < {min_id}
SQL
			);
			$sql->setInt( 'elementid' ,$this->element->elementid );
			$sql->setInt( 'pageid'    ,$this->pageid             );
			$sql->setInt( 'languageid',$this->languageid         );
			$sql->setInt( 'min_date'  ,$limit['min-age']*24*60*60);
			$sql->setInt( 'min_id'    ,$values[count($values)-$limit['max-revisions']]);
			$sql->query($sql);
		}
	}

	
	
	/**
	 * Diesen Inhalt loeschen
	 */
	function delete()
	{
		$db = db_connection();
		$sql = $db->sql( 'DELETE * FROM {{value}}'.
		                '  WHERE elementid ={elementid}'.
		                '    AND pageid    ={pageid}'.
		                '    AND languageid={languageid}' );
		$sql->setInt( 'elementid' ,$this->element->elementid );
		$sql->setInt( 'pageid'    ,$this->pageid    );
		$sql->setInt( 'languageid',$this->languageid);
		$row = $sql->getRow( $sql );
	}


	/**
	 * Hier findet die eigentliche Bereitstellung des Inhaltes statt, zu
	 * jedem Elementtyp wird ein Inhalt ermittelt.
	 * 
	 * @return void (aber Eigenschaft 'value' wird gesetzt).
	 */
	function generate()
	{
		global $conf;

		if	( intval($this->valueid)==0 )
			$this->load();
	
		$inhalt = '';
		$raw    = false;
		
		global $conf;

		if	( $conf['cache']['enable_cache'] && is_file( $this->tmpfile() ))
		{
			$this->value = implode('',file($this->tmpfile() )); // from cache.
			return;
		}

		// Inhalt ist mit anderer Seite verkn�pft.
		if	( in_array($this->element->type,array('text','longtext','date','number')) && intval($this->linkToObjectId) != 0 && !$this->isLink )
		{
			$p = new Page( $this->linkToObjectId );
			$p->load();
			
			$v = new Value();
			$v->isLink     = true;
			$v->pageid     = $p->pageid;
			$v->page       = $p;
			$v->simple     = $this->simple;
			$v->element    = $this->element;
			$v->languageid = $this->languageid;
			$v->modelid    = $this->modelid;
			$v->load();
			$v->generate();
			$this->value = $v->value;
			return;
		}
		
		switch( $this->element->type )
		{
			case 'list'  : // nur wg. R�ckw�rtskompabilit�t.
			case 'insert':

				$objectid = $this->linkToObjectId;

				if   ( intval($objectid) == 0 )
					$objectid = $this->element->defaultObjectId;
				
				if	( ! Object::available( $objectid) )
					return;
					
				$object = new Object( $objectid );
				$object->objectLoadRaw();
				
				if	( $object->isFolder )
				{
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
									switch( $this->element->subtype )
									{
										case '':
										case 'inline':
											$o = new Object( $oid );
											$o->load();
											switch( $o->getType() )
											{
												case OR_TYPE_PAGE:
													$p = new Page( $oid );
													$p->enclosingObjectId = $this->page->id;
													$p->public         = $this->page->public;
													$p->up_path        = $this->page->up_path();
													$p->modelid        = $this->page->modelid;
													$p->languageid     = $this->languageid;
													$p->mime_type      = $this->page->mimeType();
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
															$p->enclosingObjectId = $this->page->id;
															$p->public         = $this->page->public;
															$p->up_path        = $this->page->up_path();
															$p->modelid        = $this->page->modelid;
															$p->languageid     = $this->languageid;
															$p->load();
															$p->generate();
															$inhalt .= $p->value;
															unset( $p );
														}
													}
													break;
											}
											break;

										case 'ssi':
											$inhalt .= '<!--#include virtual="'.$this->page->path_to_object($oid).'" -->'; 
											break;

										default:
											$inhalt = '?'.$this->element->subtype.'?';
									}
								}
								else die('FATAL: recursion detected');
							}
						}
						else die('FATAL: recursion detected');
					}
				}
				elseif	( $object->isPage )
				{
					if   ( $this->simple )
					{
						$p = new Page( $objectid );
						$p->load();
						$inhalt = $p->name;
						unset( $p );
					}
					else
					{
						if	( $objectid != $this->page->objectid ) // Rekursion vermeiden
						{
							switch( $this->element->subtype )
							{
								case '':
								case 'inline':
									$p = new Page( $objectid );
									$p->enclosingObjectId = $this->page->id;
									$p->public         = $this->page->public;
									$p->up_path        = $this->page->up_path();
									$p->modelid        = $this->page->modelid;
									$p->languageid     = $this->languageid;
									$p->mime_type      = $this->page->mimeType();
									$p->load();
									$p->generate();
									$inhalt = $p->value;
									unset( $p );
									break;
									
								case 'ssi':
									$inhalt = '<!--#include virtual="'.$this->page->path_to_object($objectid).'" -->'; 
									break;
									
								default:
									$inhalt = '?'.$this->element->subtype.'?';
									break;
							}
						}
						else die('FATAL: recursion detected');
					}
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
				elseif	($this->element->subtype == 'image_data_uri' )
				{
					$file = new File($objectid);
					$file->load();
					$inhalt = 'data:'.$file->mimeType().';base64,'.base64_encode($file->loadValue());
				}
				else
				{
					$inhalt = $this->page->path_to_object( $objectid );
				}
				
				break;


			case 'copy':

				list($linkElementName,$targetElementName) = explode('%',$this->element->name.'%');

				if	( empty($targetElementName) )
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
				$linkValue->page   = $this->page;
				$linkValue->simple = $this->simple;
				$linkValue->languageid = $this->languageid;
				$linkValue->load();
				
				if	( !Object::available( $linkValue->linkToObjectId ) )
					break;

				$linkedPage = new Page( $linkValue->linkToObjectId );
				$linkedPage->load();

				$linkedPageTemplate = new Template( $linkedPage->templateid );
				$targetElementId = array_search( $targetElementName, $linkedPageTemplate->getElementNames() );
				
				if	( intval($targetElementId)==0 )
					break;

				$targetValue = new Value();
				$targetValue->elementid = $targetElementId;
				$targetValue->element = new Element($targetElementId);
				$targetValue->element->load();
				$targetValue->pageid = $linkedPage->pageid;
				$targetValue->page   = $linkedPage;
				$targetValue->simple = $this->simple;
				$targetValue->generate();
				
				$inhalt = $targetValue->value; 
				
				break;


			case 'linkinfo':

				@list( $linkElementName, $name ) = explode('%',$this->element->name);
				if	( is_null($name) )
					break;

				$template = new Template( $this->page->templateid );
				$elementId = array_search( $linkElementName, $template->getElementNames() );
				
					
				$element = new Element($elementId);
				$element->load();
				
				$linkValue = new Value();
				$linkValue->elementid = $element->elementid;
				$linkValue->element   = $element;
				$linkValue->pageid = $this->pageid;
				$linkValue->languageid = $this->languageid;
				$linkValue->load();
				
				$objectid = $linkValue->linkToObjectId;
				
				if   ( intval($objectid) == 0 )
					$objectid = $linkValue->element->defaultObjectId;
					
				if	( !Object::available( $objectid ) )
					break;
					
				$linkedObject = new Object( $objectid );
				$linkedObject->languageid = $this->languageid;
				$linkedObject->load();
				
				switch( $this->element->subtype )
				{
					case 'width':
						$f = new File( $objectid );
						$f->load();
						if	( $f->isImage() )
						{
							$f->getImageSize();
							$inhalt = $f->width;
						}
						unset($f);
						break;
					
					case 'height':
						$f = new File( $objectid );
						$f->load();
						if	( $f->isImage() )
						{
							$f->getImageSize();
							$inhalt = $f->height;
						}
						unset($f);
						break;
					
					case 'id':
						$inhalt = $objectid;
						break;
					
					case 'name':
						$inhalt = $linkedObject->name;
						break;
					
					case 'description':
						$inhalt = $linkedObject->description;
						break;
					
					case 'create_user_desc':
						$user = $linkedObject->createUser;
						try
						{
							$user->load();
							$inhalt = $user->desc;
						}
						catch( ObjectNotFoundException $e )
						{
						}
						break;
					
					case 'create_user_fullname':
						$user = $linkedObject->createUser;
						try
						{
							$user->load();
							$inhalt = $user->fullname;
						}
						catch( ObjectNotFoundException $e )
						{
						}
						break;
					
					case 'create_user_mail':
						$user = $linkedObject->createUser;
						try
						{
							$user->load();
							$inhalt = $user->mail;
						}
						catch( ObjectNotFoundException $e )
						{
						}
						break;
					
					case 'create_user_tel':
						$user = $linkedObject->createUser;
						try
						{
							$user->load();
							$inhalt = $user->tel;
						}
						catch( ObjectNotFoundException $e )
						{
						}
						break;
					
					case 'create_user_username':
						$user = $linkedObject->createUser;
						try
						{
							$user->load();
							$inhalt = $user->name;
						}
						catch( ObjectNotFoundException $e )
						{
						}
						break;
					
					case 'lastch_user_desc':
						$user = $linkedObject->lastchangeUser;
						try
						{
							$user->load();
							$inhalt = $user->desc;
						}
						catch( ObjectNotFoundException $e )
						{
						}
						break;
					
					case 'lastch_user_fullname':
						$user = $linkedObject->lastchangeUser;
						try
						{
							$user->load();
							$inhalt = $user->fullname;
						}
						catch( ObjectNotFoundException $e )
						{
						}
						break;
					
					case 'lastch_user_mail':
						$user = $linkedObject->lastchangeUser;
						try
						{
							$user->load();
							$inhalt = $user->mail;
						}
						catch( ObjectNotFoundException $e )
						{
						}
						break;
					
					case 'lastch_user_tel':
						$user = $linkedObject->lastchangeUser;
						try
						{
							$user->load();
							$inhalt = $user->tel;
						}
						catch( ObjectNotFoundException $e )
						{
						}
						
						break;
					
					case 'lastch_user_username':
						$user = $linkedObject->lastchangeUser;
						try
						{
							$user->load();
							$inhalt = $user->name;
						}
						catch( ObjectNotFoundException $e )
						{
						}
						break;
						
					case 'mime-type':
						if	( $linkedObject->isFile )
						{
							$f = new File( $objectid );
							$f->load();
								$inhalt = $f->mimeType();
							unset($f);
						}
						break;
					
					case 'filename':
						$inhalt = $linkedObject->filename();
						break;
					
					case 'full_filename':
						$inhalt = $linkedObject->full_filename();
						break;
					
					default:
						$inhalt = ''; 
						Logger::error('subtype for linkinfo not implemented:'.$this->element->subtype);
				}			
				
				break;

			case 'linkdate':

				@list( $linkElementName, $name ) = explode('%',$this->element->name);
				if	( is_null($name) )
					break;

				$template = new Template( $this->page->templateid );
				$elementId = array_search( $linkElementName, $template->getElementNames() );
					
				$element = new Element($elementId);
				$element->load();
				
				$linkValue = new Value();
				$linkValue->elementid = $element->elementid;
				$linkValue->element   = $element;
				$linkValue->pageid = $this->pageid;
				$linkValue->languageid = $this->languageid;
				$linkValue->load();
				
				$objectid = $linkValue->linkToObjectId;
				
				if   ( intval($objectid) == 0 )
					$objectid = $linkValue->element->defaultObjectId;
					
				if	( !Object::available( $objectid ) )
					break;
					
				$linkedObject = new Object( $objectid );
				$linkedObject->load();
				
				
				switch( $this->element->subtype )
				{
					case 'date_published':
						// START_TIME wird zu Beginn im Controller gesetzt.
						// So erh�lt jede Datei das gleiche Ver�ffentlichungsdatum.
						$date = START_TIME;
						break;
						
					case 'date_saved':
						$date = $linkedObject->lastchangeDate;
						break;

					case 'date_created':
						$date = $linkedObject->createDate;
						break;

					default:  
						Logger::warn('element:'.$this->element->name.', '.
						             'type:'.$this->element->type.', '.
						             'unknown subtype:'.$this->element->subtype);
						$date = START_TIME;
				}
				
				if	( strpos($this->element->dateformat,'%')!==FALSE )
					$inhalt = strftime( $this->element->dateformat,$date );
				else
					$inhalt = date    ( $this->element->dateformat,$date );				
				break;
				
			case 'longtext':
			case 'text':
			case 'select':

				$inhalt = $this->text;

				// Wenn Inhalt leer, dann versuchen, den Inhalt der Default-Sprache zu laden.
				if   ( $inhalt == '' && $conf['content']['language']['use_default_language'] )
				{
					$project = Session::getProject();
					$this->languageid = $project->getDefaultLanguageId();
					$this->load();
					$inhalt = $this->text;
				}
				
				// Wenn Inhalt leer, dann Vorbelegung verwenden
				if   ( $inhalt == '' )
					$inhalt = $this->element->defaultText;

				// Wenn HTML nicht erlaubt und Wiki-Formatierung aktiv, dann einfache HTML-Tags in Wiki umwandeln
				if   ( !$this->element->html && $this->element->wiki && $conf['editor']['wiki']['convert_html'] && $this->page->mimeType()=='text/html' )
					$inhalt = Text::html2Wiki( $inhalt );

				// Wenn Wiki-Formatierung aktiv, dann BB-Code umwandeln
				if   ( $this->element->wiki && $conf['editor']['wiki']['convert_bbcode'] )
					$inhalt = Text::bbCode2Wiki( $inhalt );

				// Wenn HTML nicht erlaubt ist, dann die HTML-Tags ersetzen
				if   ( !$this->element->html && !$this->element->wiki && $this->page->mimeType()=='text/html')
					$inhalt = Text::encodeHtml( $inhalt );

				// Wenn HTML nicht erlaubt ist, dann Sonderzeichen in HTML �bersetzen
				if   ( !$this->element->wiki && !$this->element->wiki && $this->page->mimeType()=='text/html' )
					$inhalt = Text::encodeHtmlSpecialChars( $inhalt );

				// Schnellformatierung ('Wiki') durchfuehren
				if   ( $this->element->wiki )
				{
					$transformer = new Transformer();
					$transformer->text    = $inhalt;
					$transformer->page    = $this->page;
					$transformer->element = $this->element;

					$transformer->transform();
					$inhalt = $transformer->text;
				}
	
				if   ( $this->page->simple )
				{
					$inhalt = strip_tags( $inhalt );
					$inhalt = str_replace( "\n",'',$inhalt );
					$inhalt = str_replace( "\r",'',$inhalt );
				}

				// "__OID__nnn__" ersetzen durch einen richtigen Link
				foreach( Text::parseOID($inhalt) as $oid=>$t )
				{
					$url    = $this->page->path_to_object($oid);
					$inhalt = str_replace($t,'"'.$url.'"',$inhalt);
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
				if	( strpos($this->element->dateformat,'%')!==FALSE )
					$inhalt = strftime( $this->element->dateformat,$date );
				else
					$inhalt = date    ( $this->element->dateformat,$date );
				break;


			// Programmcode (PHP)
			case 'code':

				if   ( $this->page->simple )
					break;

				// Die Ausführung von benutzer-erzeugtem PHP-Code kann in der
				// Konfiguration aus Sicherheitsgründen deaktiviert sein.
				if	( $conf['security']['disable_dynamic_code'] )
					break;
				
				$this->page->load();

				// Das Ausführen geschieht über die Klasse "Code".
				// In dieser wird der Code in eine Datei geschrieben und
				// von dort eingebunden.
				$code = new Code();
				$code->page = &$this->page;
				$code->setObjectId( $this->page->objectid );
				$code->delOutput();
				$code->code = $this->element->code;

				// Jetzt ausfuehren des temporaeren PHP-Codes				
				$code->execute();

				// Ausgabe ermitteln.
				$inhalt = $code->getOutput();

				break;


			// Makros (dynamische Klassen)
			case 'dynamic':

				if   ( $this->page->simple )
					break;

				$this->page->load();
				$className = $this->element->subtype;
				$fileName  = OR_DYNAMICCLASSES_DIR.$className.'.class.php';
				if	( is_file( $fileName ) )
				{
					// Fuer den Fall, dass ein Makro mehrmals pro Vorlage auftritt
					if	( !class_exists($className) )
						require( $fileName );

					if	( class_exists($className) )
					{
						$macro = new $className;
						$macro->page = &$this->page;

						if	( method_exists( $macro,'execute' ) )
						{
							//$$macro->delOutput();
							$macro->objectid = $this->page->objectid;
							$macro->page    = &$this->page;

							foreach( $this->element->getDynamicParameters() as $param_name=>$param_value )
							{
								if	( $param_value[0]=='{')
								{
									$elName   = substr($param_value,1,strpos($param_value,'}')-1);
									$template = new Template($this->page->templateid);
									$elements = $template->getElementNames();
									$elementid = array_search($elName,$elements);
									
									$value = new Value();
									$value->elementid  = $elementid;
									$value->element    = new Element( $elementid );
									$value->element->load();
									$value->pageid     = $this->page->pageid;
									$value->languageid = $this->page->languageid;
									$value->load();
									
									$param_value = $value->getRawValue();
								}
								if	( isset( $macro->$param_name ) )
								{
									Logger::debug("Setting parameter for Macro-class $className, ".$param_name.':'.$param_value );
									
									// Die Parameter der Makro-Klasse typisiert setzen.
									if	( is_int($macro->$param_name) )
										$macro->$param_name = intval($param_value);
									elseif	( is_array($macro->$param_name) )
										$macro->$param_name = explode(',',$param_value);
									else
										$macro->$param_name = $param_value;
										
								}
								else
								{
									if	( !$this->publish )
										$inhalt .= "WARNING: Unknown parameter $param_name in macro $className\n";
								}
							}

							$macro->execute();
							$inhalt .= $macro->getOutput();
						}
						else
						{
							Logger::warn('element:'.$this->element->name.', '.
							             'class:'.$className.', no method: execute()');
							if	( !$this->publish )
								$inhalt = lang('ERROR_IN_ELEMENT').' (missing method: execute())';
						}
					}
					else
					{
						Logger::warn('element:'.$this->element->name.', '.
						             'class not found:'.$className);
						if	( !$this->publish )
							$inhalt = lang('ERROR_IN_ELEMENT').' (class not found:'.$className.')';
					}
				}
				else
				{
					Logger::warn('element:'.$this->element->name.', '.
					             'file not found:'.$fileName);
					if	( !$this->publish )
						$inhalt = lang('ERROR_IN_ELEMENT').' (file not found:'.$fileName.')';
						
				}

				// Wenn HTML-Ausgabe, dann Sonderzeichen in HTML �bersetzen
				if   ( $this->page->isHtml() )
					$inhalt = Text::encodeHtmlSpecialChars( $inhalt );
				
				break;


			// Info-Feld als Datum
			case 'infodate':

				if   ( $this->page->simple )
					break;
				
				switch( $this->element->subtype )
				{
					case 'date_published':
						// START_TIME wird zu Beginn im Controller gesetzt.
						// So erh�lt jede Datei das gleiche Ver�ffentlichungsdatum.
						$date = START_TIME;
						break;
						
					case 'date_saved':
						$date = $this->page->lastchangeDate;
						break;

					case 'date_created':
						$date = $this->page->createDate;
						break;

					default:  
						Logger::warn('element:'.$this->element->name.', '.
						             'type:'.$this->element->type.', '.
						             'unknown subtype:'.$this->element->subtype);
						if	( !$this->publish )
							$inhalt = lang('ERROR_IN_ELEMENT');
				}
				
				if	( strpos($this->element->dateformat,'%')!==FALSE )
					$inhalt = strftime( $this->element->dateformat,$date );
				else
					$inhalt = date    ( $this->element->dateformat,$date );				

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
						$inhalt = $this->page->filename();
						break;
					case 'page_extension':
						$inhalt = '';
						break;
					case 'edit_url':
						$raw = true;
						$db = Session::getDatabase();
						$inhalt = Html::url('index','object',$this->page->objectid,array('dbid'=>$db->id));
						break;
					case 'edit_fullurl':
						$raw = true;
						$inhalt = Http::getServer();
						$db = Session::getDatabase();
						$params = array('dbid'      =>$db->id,
						                'objectid'  =>$this->page->objectid,
						                'modelid'   =>$this->page->modelid,
						                'languageid'=>$this->page->languageid,
						                'elementid' =>$this->element->elementid );
						$inhalt .= '/'.basename(Html::url('index','object',$this->page->objectid,$params));
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
						Logger::warn('element:'.$this->element->name.', '.
						             'type:'.$this->element->type.', '.
						             'unknown subtype:'.$this->element->subtype);
						// Keine Fehlermeldung in erzeugte Seite schreiben. 
				}

				break;
				
			default:
				// Unbekannte Elementtypen darf es nicht geben, daher ERROR loggen.
				Logger::error('element:'.$this->element->name.', '.
				              'unknown type:'.$this->element->type);
				
				if	( !$this->publish )
					$inhalt = lang('ERROR_IN_ELEMENT').' ('.$this->element->name.':'.
				              'unknown type:'.$this->element->type.')';
				
		}

		
		switch( $this->element->type )
		{
			case 'longtext':
			case 'text':
			case 'select':
				
				if	( $conf['publish']['encode_utf8_in_html'] )
					// Wenn HTML-Ausgabe, dann UTF-8-Zeichen als HTML-Code uebersetzen
					if   ( $this->page->isHtml() )
						$inhalt = translateutf8tohtml($inhalt);
				break;
				
			default:
		}

					
		
		if   ( $this->page->icons && $this->element->withIcon && $this->page->isHtml() )
		{
			// Anklickbaren Link voranstellen.
			$iconLink = '<a href="javascript:parent.openNewAction(\''.$this->element->name.'\',\'pageelement\',\''.$this->page->objectid.'_'.$this->element->elementid.'\');" title="'.$this->element->desc.'"><img src="'.OR_THEMES_EXT_DIR.$conf['interface']['theme'].'/images/icon_el_'.$this->element->type.IMG_ICON_EXT.'" border="0" align="left"></a>';
			$inhalt   = $iconLink.$inhalt;
		}
		
		$this->value = $inhalt;

		
		// Store in cache.
		$f = fopen( $this->tmpfile(),'w' );
		fwrite( $f,$this->value );
		fclose( $f );
	}


	/**
	  * Es werden Objekte mit einem Inhalt gesucht.
	  * @param String Suchbegriff
	  * @return Array Liste der gefundenen Objekt-IDs
	  */
	function getObjectIdsByValue( $text )
	{
		$db = db_connection();
		
		$sql = $db->sql( 'SELECT {{object}}.id FROM {{value}} '.
		                ' LEFT JOIN {{page}} '.
		                '   ON {{page}}.id={{value}}.pageid '.
		                ' LEFT JOIN {{object}} '.
		                '   ON {{object}}.id={{page}}.objectid '.
		                ' WHERE {{value}}.text LIKE {text}'.
		                '   AND {{value}}.languageid={languageid}'.
		                '  ORDER BY {{object}}.lastchange_date DESC' );
		                
		$sql->setInt   ( 'languageid',$this->languageid );
		$sql->setString( 'text'      ,'%'.$text.'%'     );
		return $sql->getCol( $sql );
	}


	/**
	  * Es werden Objekte mit einer UserId ermittelt
	  * @param Integer Benutzer-Id der letzten ?nderung
	  * @return Array Liste der gefundenen Objekt-IDs
	  */
	function getObjectIdsByLastChangeUserId( $userid )
	{

		$db = db_connection();
		
		$sql = $db->sql( 'SELECT {{object}}.id FROM {{value}} '.
		                ' LEFT JOIN {{page}} '.
		                '   ON {{page}}.id={{value}}.pageid '.
		                ' LEFT JOIN {{object}} '.
		                '   ON {{object}}.id={{page}}.objectid '.
		                ' WHERE {{value}}.lastchange_userid={userid}'.
		                '   AND {{value}}.languageid={languageid}'.
		                '  ORDER BY {{object}}.lastchange_date DESC' );
		$sql->setInt   ( 'languageid',$this->languageid );
		$sql->setInt   ( 'userid'    ,$userid           );

		return $sql->getCol( $sql );
	}

	

	/**
	  * Es wird das Objekt ermittelt, welches der Benutzer zuletzt ge�ndert hat.
	  * 
	  * @return Integer Objekt-Id
	  */
	public static function getLastChangedObjectByUserId( $userid )
	{
		$db = db_connection();
		
		$sql = $db->sql( <<<SQL
SELECT {{object}}.id
  FROM {{value}} 
  LEFT JOIN {{page}} 
    ON {{page}}.id={{value}}.pageid 
  LEFT JOIN {{object}} 
    ON {{object}}.id={{page}}.objectid 
 WHERE {{value}}.lastchange_userid={userid}
 ORDER BY {{value}}.lastchange_date DESC
SQL
);
		$sql->setInt   ( 'userid'    ,$userid           );
		return $sql->getOne( $sql );
	}
	
	
	/**
	  * Es wird das Objekt ermittelt, welches der Benutzer zuletzt ge�ndert hat.
	  * 
	  * @return Integer Objekt-Id
	  */
	public static function getLastChangedObjectInProjectByUserId( $projectid, $userid )
	{
		$db = db_connection();
		
		$sql = $db->sql( <<<SQL
SELECT {{object}}.id
  FROM {{value}} 
  LEFT JOIN {{page}} 
    ON {{page}}.id={{value}}.pageid 
  LEFT JOIN {{object}} 
    ON {{object}}.id={{page}}.objectid 
 WHERE {{value}}.lastchange_userid={userid}
   AND {{object}}.projectid = {projectid}
 ORDER BY {{value}}.lastchange_date DESC
SQL
);
		$sql->setInt   ( 'userid'    ,$userid     );
		$sql->setInt   ( 'projectid' ,$projectid  );
		return $sql->getOne( $sql );
	}
	
	
	/**
	 * Ermittelt einen tempor�ren Dateinamen f�r diesen Inhalt. 
	 */
	function tmpfile()
	{
		$db = db_connection();
		$filename = Object::getTempFileName( array('db'=>$db->id,
		                                           'va'=>$this->valueid,
		                                           'el'=>$this->element->elementid,
		                                           'la'=>$this->languageid,
		                                           'm' =>$this->page->modelid,
		                                           'pu'=>intval($this->publish),
		                                           'si'=>intval($this->page->simple)    ) );
		return $filename;
	}
	
	
	
	/**
	 * Ermittelt den unbearbeiteten, "rohen" Inhalt.
	 * 
	 * @return Inhalt
	 */
	public function getRawValue()
	{
		switch( $this->element->type )
		{
			case 'link':
				return $this->linkToObjectId;
				
			case 'date';
				return $this->date;
				
			default:
				return $this->text;
		}
	}
}