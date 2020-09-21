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
use cms\generator\PageContext;
use Exception;
use util\exception\GeneratorException;
use util\Mustache;
use cms\generator\PublishPreview;use cms\generator\PublishPublic;
use http\Exception\RuntimeException;
use logger\Logger;
use util\cache\FileCache;


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

	/**
	 * Page context.
	 *
	 * @var PageContext
	 */
	public $context;

	function __construct( $objectid='' )
	{
		parent::__construct( $objectid );
		$this->isPage = true;
		$this->typeid = BaseObject::TYPEID_PAGE;

		//$this->publisher = new PublishPreview();

    }


    /**
     * @return FileCache
     */
    public function getCache() {
        $cacheKey =  array('db'=>db()->id,
            'page' =>$this->objectid,
            'language' =>$this->languageid,
            'model' =>$this->modelid,
            'publish' => \util\ClassUtils::getSimpleClassName($this->publisher) );

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

		$from = new Page($this->context->sourceObjectId);
		$from->load();

		$to = new BaseObject($objectid);
        $toAlias = $to->getAlias();
        if   ( $toAlias )
        	$to = $toAlias; // Alias exists.
		$to->load();

		$inhalt = $this->publisher->linkToObject( $from, $to );

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
				\logger\Logger::debug( 'deleting value of elementid '.$oldElementId );
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

				\logger\Logger::debug( 'updating elementid '.$oldElementId.' -> '.$newElementId );
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
	 * @deprecated use pagecontext
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




	/**
	  * Get all elements from this page.
	 * @return Array
	 */
	public function getElementIds()
	{
		$t = new Template( $this->templateid );
		
		return $t->getElementIds();
	}



	/**
	  * Erzeugen der Inhalte zu allen Elementen dieser Seite
	  * wird von generate() aufgerufen
	  */
	public function getElements()
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
	 * Generieren dieser Seite in Dateisystem und/oder auf FTP-Server
	 * @deprecated
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

	
	
	public function setTimestamp()
	{
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
