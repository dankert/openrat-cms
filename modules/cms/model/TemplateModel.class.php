<?php
namespace cms\model;


use cms\base\DB;

/**
 * Templatemodell. Enthält den Template-Sourcecode und die Extension.
 *
 * @author: Jan Dankert
 */
class TemplateModel extends ModelBase
{
    /**
     * Primary Key.
     * @var
     */
    public $templatemodelid;


    /**
	 * Dateierweiterung dieses Templates (abh?ngig von der Projektvariante)
	 * @type String
	 */
	public $extension='';

	/**
	 * Inhalt des Templates (abh?ngig von der Projektvariante)
	 * @type String
	 */
	public $src      ='';

    public $modelid;
    public $templateid;

	/**
	 * @var int
	 */
    private $contentid;

    /**
     * TemplateModel constructor.
     * @param $templateid
     * @param $modelid
     */
	function __construct( $templateid,$modelid )
	{
	    $this->templateid = $templateid;
	    $this->modelid    = $modelid;
	}


	/**
 	 * Laden des Templatemodells aus der Datenbank und füllen der Objekteigenschaften.
 	 */
	function load()
	{
		$db = \cms\base\DB::get();

		$stmt = $db->sql( <<<SQL
			SELECT {{templatemodel}}.*,{{value}}.text FROM {{templatemodel}}
                LEFT JOIN {{value}}
                       ON {{value}}.contentid = {{templatemodel}}.contentid AND {{value}}.active = 1 
		            WHERE templateid     = {templateid}
		              AND projectmodelid = {modelid}
SQL
);
		$stmt->setInt( 'templateid',$this->templateid );
		$stmt->setInt( 'modelid'   ,$this->modelid    );
		$row = $stmt->getRow();

		if	( $row )
		{
			$this->templatemodelid = $row['id'       ];
			$this->extension       = $row['extension'];
			$this->src             = $row['text'     ];
			$this->contentid       = $row['contentid'];
		}
		else
		{
			$this->extension = null;
			$this->src       = null;
		}
	}



	public function isPersistent()
    {
	    return intval( $this->templatemodelid ) > 0;
    }



    /**
 	 * Abspeichern des Templates in der Datenbank
 	 */
	public function save()
	{
        // Vorlagen-Quelltext existiert für diese Varianten schon.
        $stmt = Db::sql( <<<SQL
			UPDATE {{templatemodel}}
               SET extension={extension}
			 WHERE id={id}
SQL
		);

        $stmt->setInt   ( 'id'    ,$this->templatemodelid        );
        $stmt->setString( 'extension'     ,$this->extension      );

		$stmt->execute();

		$value = new Value();
		$value->contentid = $this->contentid;
		$value->text = $this->src;
		$value->publish = true;
		$value->persist();
	}


	/**
 	 * Abspeichern des Templates in der Datenbank
 	 */
	protected function add()
	{
        // Vorlagen-Quelltext wird neu angelegt.
        $stmt = Db::sql('SELECT MAX(id) FROM {{templatemodel}}');
        $nextid = intval($stmt->getOne())+1;

        $content = new Content();
        $content->persist();
        $this->contentid = $content->getId();

        $stmt = Db::sql( 'INSERT INTO {{templatemodel}}'.
                        '        (id,contentid,templateid,projectmodelid,extension) '.
                        ' VALUES ({id},{contentid},{templateid},{modelid},{extension}) ');
        $stmt->setInt   ( 'id',$nextid         );

		$stmt->setString( 'extension'     ,$this->extension      );
		$stmt->setInt   ( 'contentid'     ,$this->contentid      );
		$stmt->setInt   ( 'templateid'    ,$this->templateid     );
		$stmt->setInt   ( 'modelid'       ,$this->modelid        );

		$stmt->execute();

        $this->templatemodelid = $nextid;
    }


	/**
 	 * Loeschen des Templates
 	 *
 	 * Entfernen alle Templateinhalte und des Templates selber
 	 */
	public function delete()
	{
		$db = \cms\base\DB::get();
		
		$stmt = $db->sql( 'DELETE FROM {{templatemodel}}'.
		                ' WHERE id={id}' );
		$stmt->setInt( 'id',$this->templatemodelid );
		$stmt->execute();
	}
	
	
	/**
	 * Ermittelt den Mime-Type zu diesem Templatemodell.
	 * 
	 * Es wird die Extension des Templates betrachtet und dann mit Hilfe der
	 * Konfigurationsdatei 'mime-types.ini' der Mime-Type bestimmt. 
	 *
	 * @return String Mime-Type  
	 */
	public function mimeType()
	{
		// Nur den letzten Teil der Extension auswerten:
		// Aus 'mobile.html' wird nur 'html' verwendet.
		$parts = explode('.',$this->extension);
		$extension = strtolower(array_pop($parts));

		$this->mime_type = File::getMimeType($extension);

		return( $this->mime_type );
	}


    public function getName()
    {
        return '';
    }


	public function getId()
	{
		return $this->templatemodelid;
	}


}

