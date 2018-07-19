<?php
namespace cms\model;
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
 * Darstellen einer Seite
 *
 * @author Jan Dankert
 * @package openrat.objects
 */

class Page extends BaseObject
{
	var $enclosingObjectId = -1;    //Id der Seite in die diese Seite im Rahmen der Generierung eingefügt wird
						     //Wichtig für include-Values
	var $pageid;
	var $templateid;
	var $template;

	var $simple = false;
	var $public = false;

	var $el = array();

	/**
	 * Stellt fest, ob die Editier-Icons angezeigt werden sollen. Dies ist
	 * nur der Fall, wenn die Seite auch zum Bearbeiten generiert wird.
	 * Wird die Seite zum Veröffentlichen generiert, muss diese Eigenschaft
	 * natürlich "false" sein.
	 * @var boolean
	 */
	var $icons = false;
	var $src   = '';
	var $edit  = false;

	var $content_negotiation = false;
	var $cut_index           = false;
	var $default_language    = false;
//	var $withLanguage        = false;
	var $withLanguage        = true;
	var $withModel           = true;
//	var $withModel           = false;
	var $link                = false;
	var $fullFilename = '';

	var $log_filenames       = array();
	var $modelid = 0;
	
	var $publish = null;
	var $up_path = '';

    public $values;

    /**
     * Inhalt der Seite.
     */
    public $value;


    function __construct( $objectid='' )
	{
		parent::__construct( $objectid );
		$this->isPage = true;
	}


	/**
	 * Ermitteln der Objekt-ID (Tabelle object) anhand der Seiten-ID (Tablle page)
	 *
	 * @deprecated pageid sollte nicht mehr benutzt werden
	 * @return Integer objectid
	 */
	function getObjectIdFromPageId( $pageid )
	{
		$db = db_connection();

		$sql  = $db->sql( 'SELECT objectid FROM {{page}} '.
		                 '  WHERE id={pageid}' );
		$sql->setInt('pageid',$pageid);

		return $sql->getOne();
	}


	/**
	 * Ermitteln der Seiten-ID anhand der Objekt-ID
	 *
	 * @deprecated pageid sollte nicht mehr benutzt werden
	 * @return Integer pageid
	 */
	function getPageIdFromObjectId( $objectid )
	{
		$db = db_connection();

		$sql  = $db->sql( 'SELECT id FROM {{page}} '.
		                 '  WHERE objectid={objectid}' );
		$sql->setInt('objectid',$objectid);

		return $sql->getOne();
	}


	/**
	  * Ermitteln aller Eigenschaften
	  *
	  * @return Array
	  */
	function getProperties()
	{
		return array_merge( parent::getProperties(),
		                    array('full_filename'=>$this->realFilename(),
		                          'pageid'       =>$this->pageid,
		                          'templateid'   =>$this->templateid,
		                          'mime_type'    =>$this->mimeType() ) );
	}


	/**
	 * Ermitteln der Ordner, in dem sich die Seite befindet
	 * @return array
	 */
	function parentfolder()
	{
		$folder = new Folder();
		$folder->folderid = $this->folderid;
		
		return $folder->parentfolder( false,false );
	}




	/**
	  * Ermittelt den Pfad zu einem beliebigen Objekt
	  *
	  * @param Integer Objekt-ID des Zielobjektes
	  * @return String Relative Link-angabe, Beispiel: '../../pfad/datei.jpeg'
	  */
	public function path_to_object( $objectid )
	{
		global $conf_php,
		       $SESS;
		$inhalt = '';
		
		if	( ! BaseObject::available( $objectid) )
			return '';
			
		$param = array(
			'oid'                 => '__OID__'.$objectid.'__',
			REQ_PARAM_MODEL_ID    => $this->modelid          ,
			REQ_PARAM_LANGUAGE_ID => $this->languageid       ,
            REQ_PARAM_EMBED       => '1'                       );
		
		if	( $this->icons )
			$param['withIcons'] = '1';
			
		$object = new BaseObject( $objectid );
		$object->objectLoad();
		
		$cut_index           = ( is_object($this->publish) && $this->publish->cut_index           );
		$content_negotiation = ( is_object($this->publish) && $this->publish->content_negotiation );

		if   ( $this->public )
		{ 
			switch( $object->typeid )
			{
				case OR_TYPEID_FILE:
				case OR_TYPEID_IMAGE:
				case OR_TYPEID_TEXT:

					$inhalt  = $this->up_path();
					
					$f = new File( $objectid );
					$f->content_negotiation = $content_negotiation;
					$f->load();
					$inhalt .= $f->full_filename();
					break;

				case OR_TYPEID_PAGE:

					$inhalt  = $this->up_path();
					
					$p = new Page( $objectid );
					$p->languageid          = $this->languageid;
					$p->modelid             = $this->modelid;
					$p->cut_index           = $cut_index;
					$p->content_negotiation = $content_negotiation;
					$p->withLanguage        = $this->withLanguage;
					$p->withModel           = $this->withModel;
					$p->load();
					$inhalt .= $p->full_filename();
					break;

				case OR_TYPEID_LINK:
					$link = new Link( $objectid );
					$link->load();

					$linkedObject = new BaseObject( $link->linkedObjectId );
					$linkedObject->objectLoad();

					switch( $linkedObject->getType() )
					{
						case OR_TYPEID_FILE:
							$f = new File( $link->linkedObjectId );
							$f->load();
							$f->content_negotiation = $content_negotiation;
							$inhalt  = $this->up_path();
							$inhalt .= $f->full_filename();
						break;

						case OR_TYPEID_PAGE:
							$p = new Page( $link->linkedObjectId );
							$p->languageid          = $this->languageid;
							$p->modelid             = $this->modelid;
							$p->cut_index           = $cut_index;
							$p->content_negotiation = $content_negotiation;
				$p->withLanguage        = $this->withLanguage;
				$p->withModel           = $this->withModel;
							$p->load();
							$inhalt  = $this->up_path();
							$inhalt .= $p->full_filename();
						break;
					}
					break;

				case OR_TYPEID_URL:
					$url = new Url( $objectid );
                    $url->load();
					$inhalt = $url->url;
					break;
			}
		}
		else
		{
			// Interne Verlinkungen in der Seitenvorschau
			switch( $object->typeid )
			{
				case OR_TYPEID_FILE:
                case OR_TYPEID_IMAGE:
                case OR_TYPEID_TEXT:
                    $inhalt = \Html::url('file','show',$objectid,$param);
                    break;
                case OR_TYPEID_PAGE:
					$inhalt = \Html::url('page','show',$objectid,$param);
					break;

				case OR_TYPEID_LINK:
					$link = new Link( $objectid );
					$link->load();

					$linkedObject = new BaseObject( $link->linkedObjectId );
					$linkedObject->objectLoad();

					switch( $linkedObject->typeid )
					{
						case OR_TYPEID_FILE:
							$inhalt = \Html::url('file','show',$link->linkedObjectId,$param);
						break;

						case OR_TYPEID_PAGE:
							$inhalt = \Html::url('page','show',$link->linkedObjectId,$param);
						break;
					}
					break;

				case OR_TYPEID_URL:
                    $url = new Url( $objectid );
                    $url->load();
                    $inhalt = $url->url;

					break;
			}
		}
		
		return $inhalt;
	}



	/**
	  * Erzeugt Pr?fix f?r eine relative Pfadangabe
	  * Beispiel: Seite liegt in Ordner /pfad/pfad dann '../../'
	  *
	  * @return String Pfadangabe
	  * @access private 
	  */ 
	function up_path()
	{
		global $conf;

		if	( $conf['filename']['url'] == 'absolute' )
		{
			$this->up_path = '/';
			return $this->up_path;
		}
			
		if	( $this->up_path != '' )
			return $this->up_path;

		$folder = new Folder( $this->parentid );
		$folder->load();
		$f = count( $folder->parentObjectFileNames(false,true) );
		
		if   ( $f == 0 )
		{
			$this->up_path = './';
		}
		else
		{
			$this->up_path = str_repeat( '../',$f );
		}

		return $this->up_path;
	}


	/**
	 * Eine Seite hinzufuegen
	 */
	function add()
	{
		$db = db_connection();

		$this->objectAdd(); // Hinzuf?gen von Objekt (dabei wird Objekt-ID ermittelt)

		$sql = $db->sql('SELECT MAX(id) FROM {{page}}');
		$this->pageid = intval($sql->getOne())+1;

		$sql = $db->sql('INSERT INTO {{page}}'.
		               ' (id,objectid,templateid)'.
		               ' VALUES( {pageid},{objectid},{templateid} )' );
		$sql->setInt   ('pageid'    ,$this->pageid     );
		$sql->setInt   ('objectid'  ,$this->objectid   );
		$sql->setInt   ('templateid',$this->templateid );

		$sql->query();
	}


	/**
	  * Seite laden
	  */
	function load()
	{
		$db = db_connection();

		$sql  = $db->sql( 'SELECT * FROM {{page}} '.
		                 '  WHERE objectid={objectid}' );
		$sql->setInt('objectid',$this->objectid);
		$row = $sql->getRow();

		$this->pageid      = $row['id'        ];
		$this->templateid  = $row['templateid'];

		$this->objectLoad();
	}


	function delete()
	{
		global $db;

		$sql = $db->sql( 'DELETE FROM {{value}} '.
		                '  WHERE pageid={pageid}' );
		$sql->setInt('pageid',$this->pageid);
		$sql->query();

		$sql = $db->sql( 'DELETE FROM {{page}} '.
		                '  WHERE objectid={objectid}' );
		$sql->setInt('objectid',$this->objectid);
		$sql->query();
		
		$this->objectDelete();
	}


	/**
	 * Kopieren der Inhalts von einer anderen Seite
	 * @param ID der Seite, von der der Inhalt kopiert werden soll
	 */
	function copyValuesFromPage( $otherpageid )
	{
		$this->load();

		foreach( $this->getElementIds() as $elementid )
		{
			foreach( Language::getAll() as $lid=>$lname )
			{
				$val = new Value();
				$val->publish = false;
				$val->element = new Element( $elementid );
	
				$val->objectid   = $otherpageid;
				$val->pageid     = Page::getPageIdFromObjectId( $otherpageid );
				$val->languageid = $lid;
				$val->load();

				// Inhalt nur speichern, wenn vorher vorhanden	
				if	( $val->valueid != 0 )
				{
					$val->objectid   = $this->objectid;
					$val->pageid     = Page::getPageIdFromObjectId( $this->objectid );
					$val->save();
				}
			}
		}
	}




	function save()
	{
		$db = db_connection();

		$sql = $db->sql('UPDATE {{page}}'.
		               '  SET templateid ={templateid}'.
		               '  WHERE objectid={objectid}' );
		$sql->setInt('templateid' ,$this->templateid);
		$sql->setInt('objectid'   ,$this->objectid  );
		$sql->query();

		$this->objectSave();
	}


	
	function replaceTemplate( $newTemplateId,$replaceElementMap )
	{
		$oldTemplateId = $this->templateid;

		$db = db_connection();

		// Template-id dieser Seite aendern
		$this->templateid = $newTemplateId;

		$sql = $db->sql('UPDATE {{page}}'.
		               '  SET templateid ={templateid}'.
		               '  WHERE objectid={objectid}' );
		$sql->setInt('templateid' ,$this->templateid);
		$sql->setInt('objectid'   ,$this->objectid  );
		$sql->query();


		// Inhalte umschluesseln, d.h. die Element-Ids aendern
		$template = new Template( $oldTemplateId );
		foreach( $template->getElementIds() as $oldElementId )
		{
			if	( !isset($replaceElementMap[$oldElementId])  ||
			      intval($replaceElementMap[$oldElementId]) < 1 )
			{
				\Logger::debug( 'deleting value of elementid '.$oldElementId );
				$sql = $db->sql('DELETE FROM {{value}}'.
				               '  WHERE pageid={pageid}'.
				               '    AND elementid={elementid}' );
				$sql->setInt('pageid'   ,$this->pageid);
				$sql->setInt('elementid',$oldElementId      );
				
				$sql->query();
			}
			else
			{
				$newElementId = intval($replaceElementMap[$oldElementId]);

				\Logger::debug( 'updating elementid '.$oldElementId.' -> '.$newElementId );
				$sql = $db->sql('UPDATE {{value}}'.
				               '  SET elementid ={newelementid}'.
				               '  WHERE pageid   ={pageid}'.
				               '    AND elementid={oldelementid}' );
				$sql->setInt('pageid'      ,$this->pageid);
				$sql->setInt('oldelementid',$oldElementId      );
				$sql->setInt('newelementid',$newElementId      );
				$sql->query();
			}
		}
	}


	
	/**
	  * Ermitteln des Dateinamens dieser Seite.
	  * 
	  * Wenn '$this->content_negotiation' auf 'true' steht, wird der Dateiname ggf. gekürzt,
	  * so wie er für HTML-Links verwendet wird. Sonst wird immer der echte Dateiname
	  * ermittelt.
	  *
	  * @return String Kompletter Dateiname, z.B. '/pfad/seite.en.html'
	  */
	function full_filename()
	{
		$filename = $this->path();

		if	( !empty($filename) )
			$filename .= '/';

		if	( $this->cut_index && $this->filename == config('publish','default') )
		{
			// Link auf Index-Datei, der Dateiname bleibt leer.
		}
		else
		{
			$format = config('publish','format');
			$format = str_replace('{filename}',$this->filename(),$format );
			
			if	( !$this->withLanguage || $this->content_negotiation && config('publish','negotiation','page_negotiate_language' ) )
			{
				$format = str_replace('{language}'    ,'',$format );
				$format = str_replace('{language_sep}','',$format );
			}
			else
			{
				$l = new Language( $this->languageid );
				$l->load();
				$format = str_replace('{language}'    ,$l->isoCode                     ,$format );
				$format = str_replace('{language_sep}',config('publish','language_sep'),$format );
			}

			if	( !$this->withModel || $this->content_negotiation && config('publish','negotiation','page_negotiate_type' ) )
			{
				$format = str_replace('{type}'    ,'',$format );
				$format = str_replace('{type_sep}','',$format );
			}
			else
			{
				$t = new Template( $this->templateid );
				$t->modelid = $this->modelid;
				$t->load();
				$format = str_replace('{type}'    ,$t->extension               ,$format );
				$format = str_replace('{type_sep}',config('publish','type_sep'),$format );
			}
			$filename .= $format;
		}

		$this->fullFilename = $filename;
		return $filename;
	}


//	function language_filename()
//	{
//		global $SESS;
//		
//		$db = db_connection();
//
//		$sql  = $db->sql( 'SELECT COUNT(*) FROM {{language}}'.
//		                 ' WHERE projectid={projectid}' );
//		$sql->setInt('projectid',$SESS['projectid']);
//
//		if   ( $sql->getOne( $sql ) == 1 )
//		{
//			// Wenn es nur eine Sprache gibt, keine Sprachangabe im Dateinamen
//			return '';
//		}
//		else
//		{
//			$sql = $db->sql( 'SELECT isocode FROM {{language}}'.
//			                ' WHERE id={languageid}' );
//			$sql->setInt('languageid',$this->languageid);
//			$isocode = $sql->getOne( $sql );
//
//			return strtolower( $isocode );
//		}		
//	}


	/**
	  * Erzeugen der Inhalte zu allen Elementen dieser Seite
	  * wird von generate() aufgerufen
	  *
	  * @access private 
	  */
	function getElementIds()
	{
		$t = new Template( $this->templateid );
		
		return $t->getElementIds();
	}



	/**
	  * Erzeugen der Inhalte zu allen Elementen dieser Seite
	  * wird von generate() aufgerufen
	  *
	  * @access private 
	  */
	function getElements()
	{
		if	( !isset($this->template) )
			$this->template = new Template( $this->templateid );
		
		return $this->template->getElements();
	}



	/**
	  * Erzeugen der Inhalte zu allen Elementen dieser Seite
	  * wird von generate() aufgerufen
	  *
	  * @access private 
	  */
	function getWritableElements()
	{
		if	( !isset($this->template) )
			$this->template = new Template( $this->templateid );
		
		return $this->template->getWritableElements();
	}



	/**
	  * Erzeugen der Inhalte zu allen Elementen dieser Seite
	  * wird von generate() aufgerufen
	  */
	public function generate_elements()
	{
		$this->values = array();
		
		if	( $this->simple )
			$elements = $this->getWritableElements();
		else
			$elements = $this->getElements();
			
		foreach( $elements as $elementid=>$element )
		{
			// neues Inhaltobjekt erzeugen
			$val = new Value();
			$val->publish = $this->public;
			$val->element = $element;

			$val->objectid   = $this->objectid;
			$val->pageid     = $this->pageid;
			$val->languageid = $this->languageid;
			$val->simple     = $this->simple;
			$val->modelid    = $this->modelid;
			$val->page       = $this;
			$val->generate();
			$val->page       = null;			
			$this->values[$elementid] = $val;
		}
	}


	/**
	  * Erzeugen des Inhaltes der gesamten Seite.
	  * 
	  * @return String Inhalt
	  */
	public function generate()
	{
		global $conf;
		
		// Setzen der 'locale', damit sprachabhängige Systemausgaben (wie z.B. die
		// Ausgabe von strftime()) in der korrekten Sprache dargestellt werden.
		$language = new Language($this->languageid);
		$language->load();
		
		$locale_conf = $conf['i18n']['locale']; 
		if	( isset($locale_conf[strtolower($language->isoCode)]) )
		{
			$locale = $locale_conf[strtolower($language->isoCode)];
			$locale_ok = setlocale(LC_ALL,$locale);
			if	( !$locale_ok )
				// Hat nicht geklappt. Entweder ist das Mapping falsch oder die locale ist
				// nicht korrekt installiert.
				\Logger::warn("Could not set locale '$locale', please check with 'locale -a' if it is installaled correctly");
		}
		else
		{
			setlocale(LC_ALL,'');
		}
		
		if	( $conf['cache']['enable_cache'] && is_file($this->tmpfile() ))
		{
			$this->value = implode('',file($this->tmpfile()));
			return $this->value;
		}
	
		$this->template = new Template( $this->templateid );
		$this->template->modelid = $this->modelid;
		$this->template->load();
		$this->ext = $this->template->extension;

		$this->generate_elements();
		 
		$src = $this->template->src;

		// Ersetzen der Platzhalter durch die Element-Inhalte
		
		foreach( $this->values as $id=>$value )
		{
			$inh = $value->value;
			$src = str_replace( '{{'.$id.'}}',$inh,$src );
			
			// Dynamische Bereiche ein- oder ausblenden
			if	( $inh == '' )
			{
				// Wenn Feld leer
				$src = str_replace( '{{IFEMPTY:'.$id.':BEGIN}}','',$src );
				$src = str_replace( '{{IFEMPTY:'.$id.':END}}'  ,'',$src );

				$src = \Text::entferneVonBis( $src,'{{IFNOTEMPTY:'.$id.':BEGIN}}','{{IFNOTEMPTY:'.$id.':END}}' );
			}
			else
			{
				// Wenn Feld gefuellt
				$src = str_replace( '{{IFNOTEMPTY:'.$id.':BEGIN}}','',$src );
				$src = str_replace( '{{IFNOTEMPTY:'.$id.':END}}'  ,'',$src );
				
				$src = \Text::entferneVonBis( $src,'{{IFEMPTY:'.$id.':BEGIN}}','{{IFEMPTY:'.$id.':END}}' );
			}
			
			if   ( $this->icons )
				$src = str_replace( '{{->'.$id.'}}','<a href="javascript:parent.openNewAction(\''.$value->element->name.'\',\'pageelement\',\''.$this->objectid.'_'.$value->element->elementid.'\');" title="'.$value->element->desc.'"><img src="'.OR_THEMES_DIR.$conf['interface']['theme'].'/images/icon_el_'.$value->element->type.IMG_ICON_EXT.'" border="0" align="left"></a>',$src );
			else
				$src = str_replace( '{{->'.$id.'}}','',$src );
		}
		
		if	( config('publish','escape_8bit_characters') )
			if	( substr($this->mimeType(),-4) == 'html' )
			{
				/*
				 * 
				$src = htmlentities($src,ENT_NOQUOTES,'UTF-8');
				$src = str_replace('&lt;' , '<', $src);
				$src = str_replace('&gt;' , '>', $src);
				$src = str_replace('&amp;', '&', $src);
				 */
				$src = translateutf8tohtml($src);
			}
		
		$this->value = &$src;

		// Store in cache.
		$f = fopen( $this->tmpfile(),'w' );
		fwrite( $f,$this->value );
		fclose( $f );
		
		return $this->value;
	}


	/**
	  * Schreiben des Seiteninhaltes in die temporaere Datei
	  */
	public function write()
	{
		if	( !is_file($this->tmpfile()))
			$this->generate();
	}


	/**
	 * Generieren dieser Seite in Dateisystem und/oder auf FTP-Server
	 */
	public function publish()
	{
		global $SESS;
		$db = db_connection();
		
		if	( ! is_object($this->publish) )
			$this->publish = new \Publish();
		
		$this->public              = true;

		$allLanguages = Language::getAll();
		$allModels    = Model::getAll();
		
		// Schleife ueber alle Sprachvarianten
		foreach( $allLanguages as $languageid=>$x )
		{
			$this->languageid   = $languageid;
			$this->withLanguage = count($allLanguages) > 1 || config('publish','filename_language') == 'always';
			$this->withModel    = count($allModels   ) > 1 || config('publish','filename_type'    ) == 'always';
			
			// Schleife ueber alle Projektvarianten
			foreach( $allModels as $projectmodelid=>$x )
			{
				$this->modelid = $projectmodelid;
			
				$this->load();
				$this->generate();
				$this->write();

				// Vorlage ermitteln.
				$t = new Template( $this->templateid );
				$t->modelid = $this->modelid;
				$t->load();
				
				// Nur wenn eine Datei-Endung vorliegt wird die Seite veroeffentlicht
				if	( !empty($t->extension) )
				{ 	
					$this->publish->copy( $this->tmpfile(),$this->full_filename() );
					unlink( $this->tmpfile() );
					$this->publish->publishedObjects[] = $this->getProperties();
				}
			}
		}

	}
	

	/**
	 * Ermittelt den Mime-Type zu dieser Seite
	 *
	 * @return String Mime-Type  
	 */
	function mimeType()
	{
		if	( ! is_object($this->template) )
		{
			$this->template = new Template( $this->templateid );
			$this->template->modelid = $this->modelid;
			$this->template->load();
		}

		$this->mime_type = $this->template->mimeType();
			
		return( $this->mime_type );
	}

	
	
	/**
	 * Ermittelt einen tempor�ren Dateinamen f�r diese Seite. 
	 */
	function tmpfile()
	{
		$db = db_connection();
		$filename = $this->getTempFileName( array('db'=>$db->id,
		                                          'o' =>$this->objectid,
		                                          'l' =>$this->languageid,
		                                          'm' =>$this->modelid,
		                                          'p' =>intval($this->public),
		                                          's' =>intval($this->simple)   ) );
		return $filename;
	}
	
	
	
	function setTimestamp()
	{
		$tmpFilename = $this->tmpfile();
		
		if	( is_file($tmpFilename) )
			unlink( $tmpFilename);
		
		parent::setTimestamp();
	}
	
	
	/**
	 * Ermittelt den Dateinamen dieser Seite, so wie sie auch im Dateisystem steht.
	 */
	function realFilename()
	{
		$project = new Project( $this->projectid );
		$this->withLanguage = config('publish','filename_language') == 'always' || count($project->getLanguageIds()) > 1;
		$this->withModel    = config('publish','filename_type'    ) == 'always' || count($project->getModelIds()   ) > 1;
		
		return $this->full_filename();
	}

	
	/**
	 * Stellt fest, ob diese Seite im HTML-Format veröffentlicht wird.
	 * @return boolean
	 */
	public function isHtml()
	{
		return $this->mimeType()=='text/html';
	}

    public function __toString()
    {
    	return 'Id '.$this->pageid.' (filename='.$this->filename.',language='.$this->languageid.', modelid='.$this->modelid.', templateid='.$this->templateid.')';
    }
}


?>
