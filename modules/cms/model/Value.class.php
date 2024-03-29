<?php
namespace cms\model;
use cms\base\Configuration;
use cms\base\DB;
use cms\base\Startup;
use util\ArrayUtils;
use cms\generator\Publish;
use cms\macros\MacroRunner;
use \util\exception\ObjectNotFoundException;
use logger\Logger;
use util\exception\GeneratorException;
use util\Request;
use util\Text;
use util\Html;
use util\Http;
use util\Transformer;
use util\Code;
use util\cache\FileCache;

/**
 * Darstellen einer Inhaltes
 *
 * @author Jan Dankert
 */

class Value extends ModelBase
{
	/**
	 * ID of this value.
	 * @type Integer
	 */
	public $valueid=0;

	/**
	 * Content ID.
	 * @var int
	 */
	public $contentid;


	/**
	 * Linked object-id.
	 * @type Integer
	 */
	public $linkToObjectId=0;

	/**
	 * textual value
	 * @type String
	 */
	public $text='';
	
	/**
	 * Number.
	 * @type Integer
	 */
	public $number=0;

	
	/**
	 * Date.
	 *
	 * Saved as unix-timestamp
	 *
	 * @type Integer
	 */
	public $date=0;

	/**
	 * file blob.
	 *
	 * @var string
	 */
	public $file = null;

	/**
	 * TimeStamp of last change.
	 * @type Integer
	 */
	public $lastchangeTimeStamp;
	
	/**
	 * user-Id of the user who created this value.
	 *
	 * @type Integer
	 */
	public $lastchangeUserId;

	/**
	 * Name of user who created this value.
	 *
	 * This attribute is readonly.
	 *
	 * @type Integer
	 */
	public $lastchangeUserName;
	
	/**
	 * Is this content active?
	 *
	 * Only 1 value (mostly the latest) in a content is active.
	 *
	 * @type Boolean
	 */
	public $active;
	
	/**
	 * Is this content public available?
	 * @type boolean
	 */
	public $publish = false;

    /**
     * Format
     *
     * @var int
     */
    public $format = null;

    /**
	 * Constructor.
	 */
	function __construct()
	{
	}




	/**
	 * Laden des aktuellen Inhaltes aus der Datenbank
	 */
	public function loadPublished()
	{
		$stmt = Db::sql( <<<SQL
             SELECT *,{{user}}.fullname as lastchange_username
               FROM {{value}}
		  LEFT JOIN {{user}}
		         ON {{user}}.id = {{value}}.lastchange_userid
        	WHERE contentid = {contentid}
        	  AND publish = 1
SQL
		);
		$stmt->setInt( 'contentid' ,$this->contentid);

		$this->bindRow( $stmt->getRow() );
	}


	private function bindRow( $row ) {

		if	( $row ) // If found
		{
			$this->contentid      = $row['contentid' ];
			$this->text           = $row['text'      ];
			$this->file           = $row['file'      ];
			$this->format         = $row['format'    ];
			$this->valueid        = intval($row['id']          );
			$this->linkToObjectId = intval($row['linkobjectid']);
			$this->number         = intval($row['number'      ]);
			$this->date           = intval($row['date'        ]);

			// If the value is stored in BASE64 we must decode it now.
			$valueIsStoredAsBase64 = DB::get()->conf['base64'];

			if	( $valueIsStoredAsBase64 )
				$this->file = base64_decode( $this->file );

			$this->active         = ( $row['active' ]=='1' );
			$this->publish        = ( $row['publish']=='1' );

			$this->lastchangeTimeStamp = intval($row['lastchange_date'    ]);
			$this->lastchangeUserId    = intval($row['lastchange_userid'  ]);
			$this->lastchangeUserName  =        $row['lastchange_username'];
		}
	}


	/**
	 * Loading the last value from the database.
	 */
	public function load()
	{
		$stmt = Db::sql( <<<SQL
             SELECT *,{{user}}.fullname as lastchange_username
               FROM {{value}}
		  LEFT JOIN {{user}}
		         ON {{user}}.id = {{value}}.lastchange_userid
        	  WHERE contentid = {contentid}
        	    AND {{value}}.active = 1
SQL
		);
		$stmt->setInt( 'contentid' ,$this->contentid);

		$this->bindRow( $stmt->getRow() );
	}


	/**
	 * Laden eines bestimmten Inhaltes aus der Datenbank
	 */
	function loadWithId( $valueid = null )
	{
		$stmt = Db::sql( <<<SQL
             SELECT {{value}}.*,{{user}}.fullname as lastchange_username
               FROM {{value}}
		  LEFT JOIN {{user}}
		         ON {{user}}.id = {{value}}.lastchange_userid
        	WHERE {{value}}.id = {valueid}
SQL
		);
		$stmt->setInt( 'valueid'   ,$valueid  );

		$this->bindRow( $stmt->getRow() );
	}


	/**
	 * @see #save()
	 */
	protected function add()
	{
		// this is implemented in the save() method.
	}


	/**
	 * Saving the value.
	 * A value is always added, never overwritten. So we are doing an INSERT here.
	 */
	protected function save()
	{
		$stmt = Db::sql( <<<SQL
			UPDATE {{value}}
		                  SET active=0
                          WHERE contentid = {contentid}
SQL
		);
		$stmt->setInt( 'contentid' ,$this->contentid );

		$stmt->execute();

		if	( $this->publish )
		{
			// Wenn Inhalt sofort veroeffentlicht werden kann, dann
			// alle anderen Inhalte auf nicht-veroeffentlichen stellen
			$stmt = DB::sql( <<<SQL
 					UPDATE {{value}}
			                  SET publish=0
                            WHERE contentid = {contentid}
SQL
			);
			$stmt->setInt( 'contentid' ,$this->contentid );

			$stmt->execute();
		}

		// Naechste ID aus Datenbank besorgen
		$stmt = DB::sql('SELECT MAX(id) FROM {{value}}');
		$this->valueid = intval($stmt->getOne())+1;

		$stmt = DB::sql( <<<SQL
INSERT INTO {{value}}
            (id       ,contentid  ,linkobjectid  ,text  ,file  ,number  ,date  ,format  ,active,publish  ,lastchange_date  ,lastchange_userid  )
     VALUES ({valueid},{contentid},{linkobjectid},{text},{file},{number},{date},{format},1     ,{publish},{lastchange_date},{lastchange_userid})
SQL
		);
		$stmt->setInt( 'valueid'   ,$this->valueid            );
		$stmt->setInt( 'contentid' ,$this->contentid          );
		$stmt->setInt( 'format'    ,$this->format             );

		if	( intval($this->linkToObjectId)==0)
			$stmt->setNull  ( 'linkobjectid' );
		else	$stmt->setInt   ( 'linkobjectid',$this->linkToObjectId   );

		if	( $this->text == '' )
			$stmt->setNull  ( 'text' );
		else	$stmt->setString( 'text',$this->text );

		if	( intval($this->number)==0)
			$stmt->setNull  ( 'number' );
		else	$stmt->setInt   ( 'number',$this->number );

		if	( intval($this->date)==0)
			$stmt->setNull  ( 'date' );
		else	$stmt->setInt   ( 'date',$this->date );


		if	( $this->file === null )
			$stmt->setNull  ( 'file' );
		else {
			$storeValueAsBase64 = DB::get()->conf['base64'];

			if( $storeValueAsBase64 ) {
				$stmt->setString( 'file'  ,base64_encode($this->file) );
			}
			else {
				$stmt->setString( 'file'  ,$this->file );
			}
		}

		$stmt->setBoolean( 'publish'          ,$this->publish );
		$stmt->setInt    ( 'lastchange_date'  ,Startup::now()         );
		$user = Request::getUser();
		$stmt->setIntOrNull( 'lastchange_userid',$user?$user->userid:null ); // user may be null, if a guest is saving.

		$stmt->execute();

		$this->pruneVersions();
	}


	// Some default values for pruning content
	const DEFAULT_PRUNE_AFTER_AGE = 10 * 365 * 24 * 60 * 60; // prune after 10 years
	const DEFAULT_PRUNE_AFTER_VERSIONS = 100; // prune after reaching 100 versions

	/**
	 * Automatic content pruning.
	 *
	 * Deletes old versions.
	 */
	private function pruneVersions()
	{
		$pruneConfig = Configuration::subset(['content','prune']);

		if	( ! $pruneConfig->is('enabled',true) )
			return; // no pruning.

		// First Step: Reading all value id.
		$sql = DB::sql( <<<SQL
		             SELECT id FROM {{value}}
                          WHERE contentid = {contentid}
			                    AND active     = 0
			                    AND publish    = 0
			                   ORDER BY id
SQL
		);
		$sql->setInt( 'contentid' ,$this->contentid );
		$values = $sql->getCol();

		// Now deleting all outdated content.
		$sql = DB::sql( <<<SQL
		DELETE FROM {{value}}
					  WHERE contentid = {contentid}
								AND active     = 0
								AND publish    = 0
								AND lastchange_date < {delete_before_date}
								AND id              < {delete_before_id}
SQL
		);
		$sql->setInt( 'contentid' ,$this->contentid );
		$sql->setInt( 'delete_before_date'  ,time() - $pruneConfig->getSeconds('age',self::DEFAULT_PRUNE_AFTER_AGE) );
		$sql->setInt( 'delete_before_id'    ,intval(@$values[count($values)-$pruneConfig->get('versions',self::DEFAULT_PRUNE_AFTER_VERSIONS)]) );
		$sql->execute();
	}



	/**
	 * Deleting (not possible).
	 */
	function delete()
	{
		// values cannot be deleted.
		// only the whole content is able to be deleted, see class Content.
	}



	/**
	 * Ermittelt den unbearbeiteten, "rohen" Inhalt.
	 *
	 * @param int $elementTypeId
	 * @return mixed Inhalt
	 */
	public function getRawValue($elementTypeId)
	{
		switch( $elementTypeId )
		{
			case Element::ELEMENT_TYPE_LINK:
				return $this->linkToObjectId;
				
			case Element::ELEMENT_TYPE_DATE;
				return $this->date;
				
			default:
				return $this->text;
		}
	}


    public function getName()
    {
        return "Value#".$this->valueid;
    }


    public function __toString()
	{
		return "Value: ".print_r($this,true);
	}



	public function getId()
	{
		return $this->valueid;
	}


}