<?php


namespace cms\model {

    /**
     * Darstellung von Name und Beschreibung eines Objektes.
     *
     * @author Jan Dankert
     * @package openrat.objects
     */
    class Name
    {
        /** eindeutige ID dieses Objektes
         * @type Integer
         */
        public $nameid;

        public $objectid;

        /** Sprach-ID
         * @see Language
         * @type Integer
         */
        public $languageid;


        /** Logischer (sprachabhaengiger) Name des Objektes
         * (wird in Tabelle <code>name</code> abgelegt)
         * @type String
         */
        public $name = '';

        /** Logische (sprachabhaengige) Beschreibung des Objektes
         * (wird in Tabelle <code>name</code> abgelegt)
         * @type String
         */
        public $description;
        /** <strong>Konstruktor</strong>
         *
         * @param Integer Objekt-ID
         */
        function __construct($nameid=0 )
        {
             $this->nameid   = $nameid;
        }


        /**
         * Lesen der Eigenschaften aus der Datenbank
         * Es werden
         * - die sprachabh?ngigen Daten wie Name und Beschreibung geladen
         * @throws \ObjectNotFoundException
         */
        public function load()
        {
            $db = db_connection();

            $stmt = $db->sql( <<<SQL
  SELECT id,objectid,name,descr,languageid
    FROM {{name}}
   WHERE languageid = {languageid}
     AND objectid   = {objectid}
SQL
            );

            $stmt->setInt('languageid', $this->languageid);
            $stmt->setInt('objectid'  , $this->objectid  );

            $row = $stmt->getRow();

            if (count($row) > 0)
                $this->setDatabaseRow( $row );
        }




        /**
         * Setzt die Eigenschaften des Objektes mit einer Datenbank-Ergebniszeile
         *
         * @param array Ergebniszeile aus Datenbanktabelle
         */
        private function setDatabaseRow( $row )
        {
            $this->nameid      = $row['id'        ];
            $this->objectid    = $row['objectid'  ];
            $this->languageid  = $row['languageid'];
            $this->name        = $row['name' ];
            $this->description = $row['descr'];
        }



        /**
         * Logischen Namen und Beschreibung des Objektes in Datenbank speichern
         *
         */
        public function save()
        {
            $db = db_connection();

            if ( intval($this->nameid)  > 0)
            {
                $sql = $db->sql( <<<SQL
			UPDATE {{name}} SET 
			                 name  = {name},
			                 descr = {desc}
			                WHERE objectid  ={objectid}
			                  AND languageid={languageid}
SQL
                );
                $sql->setString('name', $this->name);
                $sql->setString('desc', $this->description);
                $sql->setInt( 'objectid'  , $this->objectid   );
                $sql->setInt( 'languageid', $this->languageid );
                $sql->query();
            }
            else
            {
                $sql = $db->sql('SELECT MAX(id) FROM {{name}}');
                $this->nameid = intval($sql->getOne())+1;

                $sql = $db->sql('INSERT INTO {{name}}'.'  (id,objectid,languageid,name,descr)'.' VALUES( {nameid},{objectid},{languageid},{name},{desc} )');
                $sql->setInt   ('nameid'    , $this->nameid    );
                $sql->setInt   ('objectid'  , $this->objectid    );
                $sql->setInt   ('languageid', $this->languageid  );
                $sql->setString('name'      , $this->name);
                $sql->setString('desc'      , $this->description);
                $sql->query();
            }
        }

        /**
         */
        public function objectDelete()
        {
            // not necessary, because names are deleted by BaseObject::delete()
        }


        /**
         * Eigenschaften des Objektes.
         * @return array
         */
        public function getProperties()
        {
            return get_object_vars( $this );

        }


    }




}?>