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
use util\Text;
use util\Html;
use util\Http;
use util\Transformer;
use util\Code;
use util\cache\FileCache;



/**
 * PageContent.
 *
 * @author Jan Dankert
 */

class PageContent extends ModelBase
{
	/**
	 * ID.
	 * @var integer
	 */
	private $id;

	/**
	 * Content-ID.
	 *
	 * @type Integer
	 */
	public $contentId = 0;

	/**
	 * Element-Objekt
	 * @type integer
	 */
	public $elementId;
	
    /**
     * Sprach-Id.
     * @var int
     */
    public $languageid;

	/**
	 * Page-Id
	 * @var integer
	 */
    public $pageId;

    /**
	 * Konstruktor
	 */
	function __construct()
	{
	}

	

	/**
	 * Laden des aktuellen Inhaltes aus der Datenbank
	 */
	function load()
	{
		$stmt = Db::sql( <<<SQL
           SELECT * FROM {{pagecontent}}
			 WHERE elementid ={elementid}
			   AND pageid    ={pageid}
			   AND languageid={languageid}
SQL
		);
		$stmt->setInt( 'elementid' ,$this->elementId );
		$stmt->setInt( 'pageid'    ,$this->pageId    );
		$stmt->setInt( 'languageid',$this->languageid);
		$row = $stmt->getRow();

		if	( count($row) > 0 ) // Wenn Inhalt gefunden
		{
			$this->contentId = intval($row['contentid']);
			$this->id        = intval($row['id'       ]);
		}
	}



	/**
	 * No function, values are NOT updated, values are only added.
	 * @return name|void
	 */
	protected function save()
	{
		// not implemented, values are only added ("copy on write")
	}

	/**
	 * Add new object.
	 */
	public function add()
	{
		// Get next ID from database.
		$stmt = DB::sql('SELECT MAX(id) FROM {{pagecontent}}');
		$this->id = intval($stmt->getOne())+1;

		$content = new Content();
		$content->persist();
		$this->contentId = $content->getId();

		$stmt = DB::sql( <<<SQL
INSERT INTO {{pagecontent}}
            (id       ,contentid  ,elementid  ,pageid  ,languageid   )
     VALUES ({valueid},{contentid},{elementid},{pageid},{languageid} )
SQL
		);
		$stmt->setInt( 'valueid'   ,$this->valueid            );
		$stmt->setInt( 'contentid' ,$this->contentId          );
		$stmt->setInt( 'elementid' ,$this->elementId          );
		$stmt->setInt( 'pageid'    ,$this->pageid             );
		$stmt->setInt( 'languageid',$this->languageid         );

		$stmt->execute();
	}


	
	/**
	 * Diesen Inhalt loeschen
	 */
	function delete()
	{

		$content = new Content( $this->contentId );
		$content->delete();

		$stmt = DB::sql( <<<SQL
			DELETE * FROM {{pagecontent}}
			 WHERE id ={id}
SQL
		);
		$stmt->setInt( 'id' ,$this->id );

		$stmt->execute();
	}


    public function getName()
    {
        return "PageContent ".$this->id;
    }


    public function __toString()
	{
		return "PageContent: ".print_r($this,true);
	}



	public function getId()
	{
		return $this->id;
	}


}