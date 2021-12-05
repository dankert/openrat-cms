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
use cms\base\DB as Db;
use cms\generator\PageContext;


/**
 * Darstellen einer Seite
 *
 * @author Jan Dankert
 * @package openrat.objects
 */

class Page extends BaseObject
{
	public $pageid;
	public $templateid;

	/**
	 * @var Template
	 */
	public $template;

	public $el = array();

	/**
	 * Stellt fest, ob die Editier-Icons angezeigt werden sollen. Dies ist
	 * nur der Fall, wenn die Seite auch zum Bearbeiten generiert wird.
	 * Wird die Seite zum Veröffentlichen generiert, muss diese Eigenschaft
	 * natürlich "false" sein.
	 * @var boolean
	 */
	var $src   = '';

	var $modelid = 0;

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
	 * Ermitteln der Objekt-ID (Tabelle object) anhand der Seiten-ID (Tablle page)
	 *
	 * @deprecated pageid sollte nicht mehr benutzt werden
	 * @return Integer objectid
	 */
	function getObjectIdFromPageId( $pageid )
	{
		$db = \cms\base\DB::get();

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
		$sql  = Db::sql( 'SELECT id FROM {{page}} '.
		                 '  WHERE objectid={objectid}' );
		$sql->setInt('objectid',$objectid);

		return $sql->getOne();
	}


	/**
	  * Ermitteln aller Eigenschaften
	  *
	  * @return array
	  */
	function getProperties()
	{
		return array_merge( parent::getProperties(),
		                    array('full_filename'=>'',
		                          'pageid'       =>$this->pageid,
		                          'templateid'   =>$this->templateid) );
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
	 * Eine Seite hinzufuegen
	 */
	function add()
	{
		parent::add(); // Hinzuf?gen von Objekt (dabei wird Objekt-ID ermittelt)

		$sql = Db::sql('SELECT MAX(id) FROM {{page}}');
		$this->pageid = intval($sql->getOne())+1;

		$sql = Db::sql(<<<SQL
	INSERT INTO {{page}}
	            (id,objectid,templateid)
	       VALUES( {pageid},{objectid},{templateid} )
SQL
		);
		$sql->setInt   ('pageid'    ,$this->pageid     );
		$sql->setInt   ('objectid'  ,$this->objectid   );
		$sql->setInt   ('templateid',$this->templateid );

		$sql->execute();
	}


	/**
	  * Seite laden
	  */
	function load()
	{
		$sql  = Db::sql( 'SELECT * FROM {{page}} '.
		                 '  WHERE objectid={objectid}' );
		$sql->setInt('objectid',$this->objectid);
		$row = $sql->getRow();

		if   ( count($row)==0 )
			throw new \util\exception\ObjectNotFoundException("Page with Id $this->objectid not found.");

		$this->pageid      = $row['id'        ];
		$this->templateid  = $row['templateid'];

		$this->objectLoad();
	}


	public function delete()
	{
		$this->deleteContent();
		// Delete the page
		$sql = DB::sql( <<<SQL
			DELETE FROM {{page}}
			 WHERE objectid={objectid}
SQL
		);
		$sql->setInt('objectid',$this->objectid);
		$sql->execute();

		parent::delete();
	}


	/**
	 * Copy another page.
	 *
	 * Copies the contents of another page and merge it into this one.
	 *
	 * @param $otherpageid integer ID of the page which should be copied
	 */
	function copyValuesFromPage( $otherpageid )
	{
		$this->load();

		foreach( $this->getElementIds() as $elementid )
		{
			$project = $this->getProject();
			foreach( $project->getLanguages() as $lid=>$lname )
			{
				$pageContent = new PageContent();
				$pageContent->pageId     = $this->pageid;
				$pageContent->languageid = $lid;
				$pageContent->elementId  = $elementid;
				$pageContent->load();

				$value = new Value();
				$value->contentid = $pageContent->contentId;
				$value->load();

				$otherPageContent = new PageContent();
				$otherPageContent->pageId     = $this->pageid;
				$otherPageContent->languageid = $lid;
				$otherPageContent->elementId  = $elementid;
				$otherPageContent->load();

				if   ( $otherPageContent->isPersistent() ) {

					$value = new Value();
					$value->contentid = $otherPageContent->contentId;
					$value->load();

					if ( $value->isPersistent() ) {
						if   ( !$pageContent->isPersistent() )
							$pageContent->persist();

						$value->contentid = $pageContent->contentId;
						$value->persist();
					}
				}
			}

		}
	}


	function save()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql('UPDATE {{page}}'.
		               '  SET templateid ={templateid}'.
		               '  WHERE objectid={objectid}' );
		$sql->setInt('templateid' ,$this->templateid);
		$sql->setInt('objectid'   ,$this->objectid  );
		$sql->execute();

		parent::save();
	}


	
	function replaceTemplate( $newTemplateId,$replaceElementMap )
	{
		$oldTemplateId = $this->templateid;

		$db = \cms\base\DB::get();

		// Template-id dieser Seite aendern
		$this->templateid = $newTemplateId;

		$sql = $db->sql('UPDATE {{page}}'.
		               '  SET templateid ={templateid}'.
		               '  WHERE objectid={objectid}' );
		$sql->setInt('templateid' ,$this->templateid);
		$sql->setInt('objectid'   ,$this->objectid  );
		$sql->execute();


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
				
				$sql->execute();
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
				$sql->execute();
			}
		}
	}




	/**
	  * Get all elements from this page.
	 * @return array
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
	 * Ermittelt den Mime-Type zu dieser Seite
	 *
	 * @return String Mime-Type
	 * @deprecated this is model-dependant! Use the same method in PageGenerator.
	 */
	function mimeType()
	{
		$templateModel = new TemplateModel( $this->templateid,$this->getProject()->getDefaultModelId() );
		$templateModel->load();

		$this->mime_type = $templateModel->mimeType();
			
		return( $this->mime_type );
	}

	
	
	public function setTimestamp()
	{
		parent::setTimestamp();
	}


	/**
	 * Returns a page with default values.
	 *
	 * If a value is empty, then the value should be loaded from this referenced object.
	 *
	 * @return Page|null
	 */
	public function getPageAsDefault() {

		$defaultObjectId = $this->getPageIdForDefault();

		if   ( $defaultObjectId ) {
			$page = new Page( $defaultObjectId );
			return $page;
		}

		return null;
	}

	/**
	 * Returns a pageid with default values.
	 *
	 * If a value is empty, then the value should be loaded from this referenced object.
	 *
	 * @return int|null
	 */
	public function getPageIdForDefault() {

		$settings = $this->getTotalSettings();
		return @$settings['copy-default-values-from'];
	}



    public function __toString()
    {
    	return 'Id '.$this->pageid.' (filename='.$this->filename.', templateid='.$this->templateid.')';
    }


	/**
	 * Deletes all content of the page
	 */
	private function deleteContent()
	{
		// Delete all page contents.
		$project = $this->getProject();
		$languageIds = $project->getLanguageIds();
		$elementIds  = $this->getElementIds();

		foreach( $languageIds as $languageId )
			foreach ( $elementIds as $elementId ) {
				$pageContent = new PageContent();
				$pageContent->pageId     = $this->pageid;
				$pageContent->elementId  = $elementId;
				$pageContent->languageid = $languageId;
				$pageContent->load();
				$pageContent->delete();
			}
	}
}
