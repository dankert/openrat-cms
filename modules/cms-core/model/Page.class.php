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
use cms\mustache\Mustache;
use cms\publish\PublishPreview;use cms\publish\PublishPublic;
use http\Exception\RuntimeException;
use Logger;
use util\FileCache;


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

	/**
	 * @var Template
	 */
	var $template;

    /**
     * @deprecated
     */
	var $simple = false;

    /**
	 * @deprecated replaced by publish->isPublic()
     */
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

    /**
     * @var Value[]
     */
    public $values;

    /**
     * Inhalt der Seite.
     */
    public $value;

    function __construct( $objectid='' )
	{
		parent::__construct( $objectid );
		$this->isPage = true;
		$this->typeid = BaseObject::TYPEID_PAGE;

		$this->publisher = new PublishPreview();

    }


    /**
     * @return FileCache
     */
    public function getCache() {
        $cacheKey =  array('db'=>db()->id,
            'page' =>$this->objectid,
            'language' =>$this->languageid,
            'model' =>$this->modelid,
            'publish' =>\ClassUtils::getSimpleClassName($this->publisher) );

        return new FileCache( $cacheKey,function() {
            return $this->generateValue();
        }, $this->lastchangeDate );

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
	public static function getPageIdFromObjectId( $objectid )
	{
		$sql  = db()->sql( 'SELECT id FROM {{page}} '.
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
		$folder->folderid = $this->parentid;
		
		return $folder->parentObjectFileNames( false,true );
	}




	/**
	  * Ermittelt den Pfad zu einem beliebigen Objekt
	  *
	  * @param Integer Objekt-ID des Zielobjektes
	  * @return String Relative Link-angabe, Beispiel: '../../pfad/datei.jpeg'
	  */
	public function path_to_object( $objectid )
	{
		if	( ! BaseObject::available( $objectid) )
			return 'about:blank';
			
        $to = new BaseObject($objectid);
        $to->load();
        $inhalt = $this->publisher->linkToObject( $this, $to );

		return $inhalt;
	}




	/**
	 * Eine Seite hinzufuegen
	 */
	function add()
	{
		parent::add(); // Hinzuf?gen von Objekt (dabei wird Objekt-ID ermittelt)

		$sql = db()->sql('SELECT MAX(id) FROM {{page}}');
		$this->pageid = intval($sql->getOne())+1;

		$sql = db()->sql(<<<SQL
	INSERT INTO {{page}}
	            (id,objectid,templateid)
	       VALUES( {pageid},{objectid},{templateid} )
SQL
		);
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
		$sql  = db()->sql( 'SELECT * FROM {{page}} '.
		                 '  WHERE objectid={objectid}' );
		$sql->setInt('objectid',$this->objectid);
		$row = $sql->getRow();

		if   ( count($row)==0 )
			throw new \ObjectNotFoundException("Page with Id $this->objectid not found.");

		$this->pageid      = $row['id'        ];
		$this->templateid  = $row['templateid'];

		$this->objectLoad();
	}


	function delete()
	{
		$db = db_connection();

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
	 * @param $otherpageid integer ID der Seite, von der der Inhalt kopiert werden soll
	 */
	function copyValuesFromPage( $otherpageid )
	{
		$this->load();

		foreach( $this->getElementIds() as $elementid )
		{
			$project = new Project( $this->projectid );
			foreach( $project->getLanguages() as $lid=>$lname )
			{
				$val = new Value();
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
		$filename = $this->path().'/'.$this->getFilename();

		$this->fullFilename = $filename;
		return $filename;
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
	function getFilename()
	{
		return self::filename();
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
    function filename()
    {
        if	( $this->cut_index && $this->filename == config('publish','default') )
        {
            return ''; // Link auf Index-Datei, der Dateiname bleibt leer.
        }
        else
        {
            $format = config('publish','format');
            $format = str_replace('{filename}',parent::filename(),$format );

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
            return $format;
        }
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
		
		if	( $this->publisher->isSimplePreview() )
			$elements = $this->getWritableElements();
		else
			$elements = $this->getElements();
			
		foreach( $elements as $elementid=>$element )
		{
			// neues Inhaltobjekt erzeugen
			$val = new Value();
			$val->element = $element;

			$val->publisher  = $this->publisher;
			$val->objectid   = $this->objectid;
			$val->pageid     = $this->pageid;
			$val->languageid = $this->languageid;
			$val->modelid    = $this->modelid;
			$val->page       = $this;
			try {
				$val->generate();
			} catch( \Exception $e ) {
				// Unrecoverable Error while generating the content.

				Logger::warn('Could not generate Value '.$val->__toString() . ': '.$e->getMessage() );

				if   ( $this->publisher->isPublic() )
					$val->value = '';
				else
					$val->value = '[Warning: '.$e->getMessage().']';
			}

			$this->values[$elementid] = $val;
		}
	}



	public function generate() {

		return $this->getCache()->get();
	}

	/**
	  * Erzeugen des Inhaltes der gesamten Seite.
	  * 
	  * @return String Inhalt
	  */
	private function generateValue()
	{
		global $conf;
		
		// Setzen der 'locale', damit sprachabhängige Systemausgaben (wie z.B. die
		// Ausgabe von strftime()) in der korrekten Sprache dargestellt werden.
		$language = new Language($this->languageid);
		$language->load();

		$language->setCurrentLocale();
		

		$this->template = new Template( $this->templateid );
		$this->template->modelid = $this->modelid;
		$this->template->load();
		$this->ext = $this->template->extension;

		$this->generate_elements();

		// Get a List with ElementId->ElementName
		$elements = array_map(function($element) {
			return $element->name;
		},$this->getElements() );
		 
		$templatemodel = new TemplateModel( $this->template->templateid, $this->modelid );
		$templatemodel->load();
		$src = $templatemodel->src;

		$data = array();

		// Template should have access to the page properties.
		// Template should have access to the settings of this node object.
		$data['_page'         ] = $this->getProperties()   ;
		$data['_localsettings'] = $this->getSettings()     ;
		$data['_settings'     ] = $this->getTotalSettings();

		// No we are collecting the data and are fixing some old stuff.

		foreach( $elements as $elementId=>$elementName )
		{
			$data[ $elementName ] = $this->values[$elementId]->generate();

			// The following code is for old template values:

			// convert {{<id>}} to {{<name>}}
			$src = str_replace( '{{'.$elementId.'}}','{{'.$elementName.'}}',$src );

            $src = str_replace( '{{IFNOTEMPTY:'.$elementId.':BEGIN}}','{{#'.$elementName.'}}',$src );
            $src = str_replace( '{{IFNOTEMPTY:'.$elementId.':END}}'  ,'{{/'.$elementName.'}}',$src );
            $src = str_replace( '{{IFEMPTY:'   .$elementId.':BEGIN}}','{{^'.$elementName.'}}',$src );
            $src = str_replace( '{{IFEMPTY:'   .$elementId.':END}}'  ,'{{/'.$elementName.'}}',$src );

			if   ( $this->icons )
				$src = str_replace( '{{->'.$elementId.'}}','<a href="javascript:parent.openNewAction(\''.$elementName.'\',\'pageelement\',\''.$this->objectid.'_'.$value->element->elementid.'\');" title="'.$value->element->desc.'"><img src="'.OR_THEMES_DIR.$conf['interface']['theme'].'/images/icon_el_'.$value->element->type.IMG_ICON_EXT.'" border="0" align="left"></a>',$src );
			else
				$src = str_replace( '{{->'.$elementId.'}}','',$src );
		}

		Logger::trace( 'pagedata: '.print_r($data,true) );

		// Now we have collected all data, lets call the template engine:

        $template = new Mustache();
		$template->escape = null; // No HTML escaping, this is the job of this CMS ;)
		$template->partialLoader = function( $name ) {

		 	if   ( substr($name,0,5) == 'file:') {
		 	 	$fileid = intval( substr($name,5) );
		 	 	$file = new File( $fileid );
		 	 	return $file->loadValue();
			}


		 	$project       = new Project($this->projectid);
		 	$templateid    = array_search($name,$project->getTemplates() );

			if   ( ! $templateid )
			 	return $this->publisher->isPublic()?'':"template '$name' not found";

			if   ( $templateid == $this->template->templateid )
				return $this->publisher->isPublic()?'':'Template recursion is not supported';


			$templatemodel = new TemplateModel( $templateid, $this->modelid );
			$templatemodel->load();

			return $templatemodel->src;
		};

        try {
        	$template->parse($src);
        } catch (\Exception $e) {
			// Should we throw it to the caller?
			// No, because it is not a technical error. So let's only log it.
			Logger::warn("Template rendering failed: ".$e->getMessage() );
			return $e->getMessage();
        }
        $src = $template->render( $data );

        // now we have the fully generated source.

		// should we do a UTF-8-escaping here?
		// Default should be off, because if you are fully using utf-8 (you should do), this is unnecessary.
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
		
		return $src;
	}


	/**
	  * Schreiben des Seiteninhaltes in die temporaere Datei
	  */
	public function write()
	{
			$this->getCache()->load();
	}


	/**
	 * Generieren dieser Seite in Dateisystem und/oder auf FTP-Server
	 */
	public function publish()
	{
		$project = Project::create( $this->projectid );

		$allLanguages = $project->getLanguageIds();
		$allModels    = $project->getModelIds();
		
		// Schleife ueber alle Sprachvarianten
		foreach( $allLanguages as $languageid )
		{
			$this->languageid   = $languageid;
			$this->withLanguage = count($allLanguages) > 1 || config('publish','filename_language') == 'always';
			$this->withModel    = count($allModels   ) > 1 || config('publish','filename_type'    ) == 'always';
			
			// Schleife ueber alle Projektvarianten
			foreach( $allModels as $projectmodelid )
			{
				$this->modelid = $projectmodelid;
			
				$this->load();
				$this->getCache()->load();

				// Vorlage ermitteln.
				$t = new Template( $this->templateid );
				$t->modelid = $this->modelid;
				$t->load();
				
				// Nur wenn eine Datei-Endung vorliegt wird die Seite veroeffentlicht
				if	( !empty($t->extension) )
				{ 	
					$this->publisher->copy( $this->getCache()->getFilename(),$this->full_filename() );
					$this->publisher->publishedObjects[] = $this->getProperties();
				}
			}
		}

		parent::setPublishedTimestamp();

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

	
	
	function setTimestamp()
	{
		$this->getCache()->invalidate();

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
