<?php

define('OR_DB_SUPPORTED_VERSION',3);

define('OR_DB_STATUS_UPDATE_PROGRESS', 0);
define('OR_DB_STATUS_UPDATE_SUCCESS' , 1);

class DbUpdate 
{
	function update( $db )
	{
		$version = $this->getDbVersion($db);
		
		if	( $version == OR_DB_SUPPORTED_VERSION )
			// Cool, der aktuelle DB-Stand passt zu dieser Version. Das ist auch der Normalfall. Weiter so.
			return;
		
		if	( $version > OR_DB_SUPPORTED_VERSION )
			// Oh oh, in der Datenbank ist eine neue Version, also wir unterstüzten.
			Http::serverError('Actual DB version is not supported.',"DB-Version is $version, but this is OpenRat ".OR_VERSION." which only supports version ".OR_DB_SUPPORTED_VERSION );

		if	( ! $db->conf['auto_update'])
			Http::serverError('DB Update necessary.',"DB-Version is $version, but this is OpenRat ".OR_VERSION." which needs the version ".OR_DB_SUPPORTED_VERSION );
		
		require(OR_DBCLASSES_DIR.'DbVersion.class.php');
		
		for( $installVersion = $version + 1; $installVersion <= OR_DB_SUPPORTED_VERSION; $installVersion++ )
		{
			if	( $installVersion > 2 )
			{
				$sql = $db->sql('INSERT INTO {{version}} (id,version,status,installed) VALUES( {id},{version},{status},{time} )',$db->id);
				$sql->setInt('id'     , $installVersion);
				$sql->setInt('version', $installVersion);
				$sql->setInt('status' , OR_DB_STATUS_UPDATE_PROGRESS);
				$sql->setInt('time'   , time()         );
				$sql->query( $sql );
				$db->commit();
			}
			
			$updaterClassName = 'DBVersion'.str_pad($installVersion, 6, '0', STR_PAD_LEFT);
			require(OR_DBCLASSES_DIR.'update/'.$updaterClassName.'.class.php');
			
			$updater = new $updaterClassName( $db );
			
			$updater->update();

			if	( $installVersion > 2 )
			{
				$sql = $db->sql('UPDATE {{version}} SET status={status},installed={time} WHERE version={version}',$db->id);
				$sql->setInt('status' , OR_DB_STATUS_UPDATE_SUCCESS);
				$sql->setInt('version', $installVersion);
				$sql->setInt('time'   , time()         );
				$sql->query( $sql );
				$db->commit();
			}
		}
		
		$this->afterUpdate( $db );
	}


	/**
	 * Initialisieren der frisch aktualisierten Datenbank.
	 * 
	 * @param DB $db
	 */
	private function afterUpdate( $db )
	{
		// Benutzer zählen.
		$sql = $db->sql('SELECT COUNT(*) From {{user}}',$db->id);
		$countUsers = $sql->getOne( $sql );
		
		// Wenn noch kein Benutzer vorhanden, dann einen anlegen.
		if	( $countUsers == 0 )
		{
			$sql = $db->sql("INSERT INTO {{user}} (id,name,password,ldap_dn,fullname,tel,mail,descr,style,is_admin) VALUES(1,'admin','admin','','Administrator','','','Account for administration tasks.','default',1)",$db->id);
			$sql->query( $sql );
			$db->commit();
		}
	}
	
	
	
	private function getDbVersion( $db )
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
			$countErrors = $sql->getOne($sql);
			if	( $countErrors > 0 )
				Http::serverError('Database error','there are dirty versions (means: versions with status 0), see table VERSION for details.');
			
			// Aktuelle Version ermitteln.
			$sql = $db->sql(<<<SQL
	SELECT MAX(version) FROM {{version}}
SQL
					,$db->id);
			$version = $sql->getOne($sql);

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