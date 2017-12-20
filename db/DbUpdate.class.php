<?php

use database\Database;

define('OR_DB_SUPPORTED_VERSION',11);

define('OR_DB_STATUS_UPDATE_PROGRESS', 0);
define('OR_DB_STATUS_UPDATE_SUCCESS' , 1);

class DbUpdate 
{
    /**
     * @param Database $db
     */
    function update(Database $db )
	{
		$version = $this->getDbVersion($db);
		
		if	( $version == OR_DB_SUPPORTED_VERSION )
			// Cool, der aktuelle DB-Stand passt zu dieser Version. Das ist auch der Normalfall. Weiter so.
			return;
		
		if	( $version > OR_DB_SUPPORTED_VERSION )
			// Oh oh, in der Datenbank ist eine neue Version, als wir unterstüzten.
			Http::serverError('Actual DB version is not supported.',"DB-Version is $version, but this is OpenRat ".OR_VERSION." which only supports version ".OR_DB_SUPPORTED_VERSION );

		if	( ! $db->conf['auto_update'])
			Http::serverError('DB Update necessary.',"DB-Version is $version. Auto-Update is disabled, but this is OpenRat ".OR_VERSION." needs the version ".OR_DB_SUPPORTED_VERSION );
		
		for( $installVersion = $version + 1; $installVersion <= OR_DB_SUPPORTED_VERSION; $installVersion++ )
		{
			if	( $installVersion > 2 ) // Up to version 2 there was no table 'version'.
			{
			    $db->start();
				$sql = $db->sql('INSERT INTO {{version}} (id,version,status,installed) VALUES( {id},{version},{status},{time} )',$db->id);
				$sql->setInt('id'     , $installVersion);
				$sql->setInt('version', $installVersion);
				$sql->setInt('status' , OR_DB_STATUS_UPDATE_PROGRESS);
				$sql->setInt('time'   , time()         );
				$sql->query();
				$db->commit();
			}
			
			$updaterClassName = 'DBVersion'.str_pad($installVersion, 6, '0', STR_PAD_LEFT);
			require(OR_DBCLASSES_DIR.'update/'.$updaterClassName.'.class.php');

            $db->start();
            /** @var \database\DbVersion $updater */
            $updater = new $updaterClassName( $db );
			
			$updater->update();
			$db->commit();

			if	( $installVersion > 2 )
			{
                $db->start();
				$sql = $db->sql('UPDATE {{version}} SET status={status},installed={time} WHERE version={version}',$db->id);
				$sql->setInt('status' , OR_DB_STATUS_UPDATE_SUCCESS);
				$sql->setInt('version', $installVersion);
				$sql->setInt('time'   , time()         );
				$sql->query();
				$db->commit();
			}
		}
	}



	
	private function getDbVersion( Database $db )
	{
		$sql = $db->sql('SELECT 1 FROM {{version}}',$db->id);
		$versionTableExists = $sql->testQuery();
		
		if	( $versionTableExists )
		{
			// Prüfen, ob die vorherigen Updates fehlerfrei sind. 
			$sql = $db->sql(<<<SQL
	SELECT COUNT(*) FROM {{version}} WHERE STATUS=0
SQL
					,$db->id);
			$countErrors = $sql->getOne();
			if	( $countErrors > 0 )
				Http::serverError('Database error','there are dirty versions (means: versions with status 0), see table VERSION for details.');
			
			// Aktuelle Version ermitteln.
			$sql = $db->sql(<<<SQL
	SELECT MAX(version) FROM {{version}}
SQL
					,$db->id);
			$version = $sql->getOne();

			if	( is_numeric($version) )
				return $version; // Aktuelle Version.s
			else
				// Tabelle 'version' ist noch leer.
			    // Tabelle 'version' wurde in Version 2 angelegt.
				return 2;
		}
		else
		{
			$sql = $db->sql('SELECT 1 FROM {{project}}',$db->id);
			$projectTableExists = $sql->testQuery();
				
			if	( $projectTableExists )
				// Entspricht dem Stand vor Einführung der automatischen Migration.
				return 1; 
			else
				// Es gibt gar keine Tabellen, es muss also alles neu angelegt werden.
				return 0;
		}
	}
}

?>