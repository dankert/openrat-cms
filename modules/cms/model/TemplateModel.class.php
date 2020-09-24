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
		$db = db_connection();

		$stmt = $db->sql( 'SELECT * FROM {{templatemodel}}'.
		                ' WHERE templateid={templateid}'.
		                '   AND projectmodelid={modelid}' );
		$stmt->setInt( 'templateid',$this->templateid );
		$stmt->setInt( 'modelid'   ,$this->modelid    );
		$row = $stmt->getRow();

		if	( isset($row['id']) )
		{
			$this->templatemodelid = $row['id'];
			$this->extension       = $row['extension'];
			$this->src             = $row['text'];
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
		if   ( ! $this->isPersistent() )
			$this->add();

        // Vorlagen-Quelltext existiert für diese Varianten schon.
        $stmt = Db::sql( 'UPDATE {{templatemodel}}'.
                        '  SET extension={extension},'.
                        '      text={src} '.
                        ' WHERE id={id}' );

        $stmt->setInt   ( 'id'    ,$this->templatemodelid        );

        $stmt->setString( 'extension'     ,$this->extension      );
        $stmt->setString( 'src'           ,$this->src            );

		$stmt->query();
	}


	/**
 	 * Abspeichern des Templates in der Datenbank
 	 */
	protected function add()
	{
        // Vorlagen-Quelltext wird neu angelegt.
        $stmt = Db::sql('SELECT MAX(id) FROM {{templatemodel}}');
        $nextid = intval($stmt->getOne())+1;

        $stmt = Db::sql( 'INSERT INTO {{templatemodel}}'.
                        '        (id,templateid,projectmodelid,extension,text) '.
                        ' VALUES ({id},{templateid},{modelid},{extension},{src}) ');
        $stmt->setInt   ( 'id',$nextid         );

		$stmt->setString( 'extension'     ,$this->extension      );
		$stmt->setInt   ( 'templateid'    ,$this->templateid     );
		$stmt->setInt   ( 'modelid'       ,$this->modelid        );
		$stmt->setString( 'src'           ,$this->src            );

		$stmt->query();

        $this->templatemodelid = $nextid;
    }


	/**
 	 * Loeschen des Templates
 	 *
 	 * Entfernen alle Templateinhalte und des Templates selber
 	 */
	public function delete()
	{
		$db = db_connection();
		
		$stmt = $db->sql( 'DELETE FROM {{templatemodel}}'.
		                ' WHERE id={id}' );
		$stmt->setInt( 'id',$this->templatemodelid );
		$stmt->query();
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
		global $conf;
		$mime_types = $conf['mime-types'];

		// Nur den letzten Teil der Extension auswerten:
		// Aus 'mobile.html' wird nur 'html' verwendet.
		$parts = explode('.',$this->extension);
		$extension = strtolower(array_pop($parts));

		if	( !empty($mime_types[$extension]) )
			$this->mime_type = $mime_types[$extension];
		else
			// Wenn kein Mime-Type gefunden, dann Standardwert setzen
			$this->mime_type = 'application/octet-stream';
			
		return( $this->mime_type );
	}


    public function getName()
    {
        return '';
    }

}

