<?php

define('OR_DB_SUPPORTED_VERSION',3);

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
				$sql = new Sql('INSERT INTO {t_version} (id,version,status) VALUES( {version},{version},0 )',$db->id);
				$sql->setInt('version', $installVersion);
				$db->query( $sql );
				$db->commit();
			}
			
			$updaterClassName = 'DBVersion'.str_pad($installVersion, 6, '0', STR_PAD_LEFT);
			require(OR_DBCLASSES_DIR.'update/'.$updaterClassName.'.class.php');
			
			$updater = new $updaterClassName( $db );
			
			$updater->update();

			if	( $installVersion > 2 )
			{
				$sql = new Sql('UPDATE {t_version} SET status=1,installed={time} WHERE version={version}',$db->id);
				$sql->setInt('version', $installVersion);
				$sql->setInt('time'   , time()         );
				$db->query( $sql );
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
		$sql = new Sql('SELECT COUNT(*) From {t_user}',$db->id);
		$countUsers = $db->getOne( $sql );
		
		// Wenn noch kein Benutzer vorhanden, dann einen anlegen.
		if	( $countUsers == 0 )
		{
			$sql = new Sql("INSERT INTO {t_user} (id,name,password,ldap_dn,fullname,tel,mail,descr,style,is_admin) VALUES(1,'admin','admin','','Administrator','','','Account for administration tasks.','default',1)",$db->id);
			$db->query( $sql );
			$db->commit();
		}
	}
	
	
	
	private function getDbVersion( $db )
	{
		$sql = new Sql('SELECT 1 FROM {t_version}',$db->id);
		$versionTableExists = $db->testQuery( $sql );
		
		if	( $versionTableExists )
		{
			// Prüfen, ob die vorherigen Updates fehlerfrei sind. 
			$sql = new Sql(<<<SQL
	SELECT COUNT(*) FROM {t_version} WHERE STATUS=0
SQL
					,$db->id);
			$countErrors = $db->getOne($sql);
			if	( $countErrors > 0 )
				Http::serverError('Database error','there are dirty versions (means: versions with status 0), see table VERSION for details.');
			
			// Aktuelle Version ermitteln.
			$sql = new Sql(<<<SQL
	SELECT MAX(version) FROM {t_version}
SQL
					,$db->id);
			$version = $db->getOne($sql);

			if	( is_numeric($version) )
				return $version; // Aktuelle Version.s
			else
				// Tabelle 'version' ist noch leer.
			    // Tabelle 'version' wurde in Version 2 angelegt.
				return 2;
		}
		else
		{
			$sql = new Sql('SELECT 1 FROM {t_project}',$db->id);
			$projectTableExists = $db->testQuery( $sql );
				
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