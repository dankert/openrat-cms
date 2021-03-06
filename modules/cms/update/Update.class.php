<?php

namespace cms\update;

use cms\base\Startup;
use cms\base\Version;
use database\Database;
use Exception;
use logger\Logger;


class Update
{
	// This is the required DB version:
	const SUPPORTED_VERSION = 27;
	// -----------------------^^-----------------------------

	const STATUS_UPDATE_PROGRESS = 0;
	const STATUS_UPDATE_SUCCESS  = 1;

	/**
	 * Detects if the database must be upgraded.
	 *
	 * @param Database $db
	 * @return bool true if database must be updated
	 */
	public function isUpdateRequired(Database $db)
	{
		$version = $this->getDbVersion($db);

		Logger::debug("Need DB-Version: " . self::SUPPORTED_VERSION . "; Actual DB-Version: " . $version);

		if ($version == self::SUPPORTED_VERSION)
			// Cool, der aktuelle DB-Stand passt zu dieser Version. Das ist auch der Normalfall. Weiter so.
			return false;

		elseif ($version > self::SUPPORTED_VERSION)
			// Oh oh, in der Datenbank ist eine neuere Version, als wir unterstützen.
			throw new \LogicException('Actual DB version is not supported. ' . "DB-Version is $version, but " . Startup::TITLE . " " . Startup::VERSION . " only supports version " . self::SUPPORTED_VERSION);

		else
			return true; // Update required.
	}


	/**
	 * Update the database to a newer version.
	 *
	 * @param Database $db
	 */
	public function update(Database $db)
	{
		$version = $this->getDbVersion($db);


		for ($installVersion = $version + 1; $installVersion <= self::SUPPORTED_VERSION; $installVersion++) {
			if ($installVersion > 2) // Up to version 2 there was no table 'version'.
			{
				$db->start();
				$sql = $db->sql('INSERT INTO {{version}} (id,version,status,installed) VALUES( {id},{version},{status},{time} )', $db->id);
				$sql->setInt('id', $installVersion);
				$sql->setInt('version', $installVersion);
				$sql->setInt('status', self::STATUS_UPDATE_PROGRESS);
				$sql->setInt('time', time());
				$sql->query();
				$db->commit();
			}

			$updaterClassName = __NAMESPACE__.'\version\DBVersion' . str_pad($installVersion, 6, '0', STR_PAD_LEFT);

			$db->start();
			/** @var \database\DbVersion $updater */
			$updater = new $updaterClassName($db);

			$updater->update();
			$db->commit();

			if ($installVersion > 2) {
				$db->start();
				$sql = $db->sql('UPDATE {{version}} SET status={status},installed={time} WHERE version={version}', $db->id);
				$sql->setInt('status', self::STATUS_UPDATE_SUCCESS);
				$sql->setInt('version', $installVersion);
				$sql->setInt('time', time());
				$sql->query();
				$db->commit();
			}
		}
	}


	/**
	 * Detects the actual version of the database scheme.
	 *
	 * @param Database $db
	 * @return int
	 */
	private function getDbVersion(Database $db)
	{
		$versionTableExists = $this->testQuery($db, 'SELECT 1 FROM {{version}}');

		if ($versionTableExists) {
			// Prüfen, ob die vorherigen Updates fehlerfrei sind. 
			$sql = $db->sql(<<<SQL
	SELECT COUNT(*) FROM {{version}} WHERE STATUS=0
SQL
				, $db->id);
			$countErrors = $sql->getOne();
			if ($countErrors > 0)
				throw new \LogicException('Database error: There are dirty versions (means: versions with status 0), see table VERSION for details.');

			// Aktuelle Version ermitteln.
			$sql = $db->sql(<<<SQL
	SELECT MAX(version) FROM {{version}}
SQL
				, $db->id);
			$version = $sql->getOne();

			if (is_numeric($version))
				return $version; // Aktuelle Version.s
			else
				// Tabelle 'version' ist noch leer.
				// Tabelle 'version' wurde in Version 2 angelegt.
				return 2;
		} else {
			// no version table exists.

			// find out if there is the project table...
			$projectTableExists = $this->testQuery($db, 'SELECT 1 FROM {{project}}');

			if ($projectTableExists)
				// seems to be the old baseline version without a version table.
				return 1;
			else
				// there are no tables, everything must be created.
				return 0;
		}
	}


	/**
	 * Stellt fest, ob eine DB-Anfrage funktioniert.
	 *
	 * @param $db Database
	 * @param $sql
	 * @return <code>true</code> falls SQL funktioniert.
	 */
	private function testQuery($db, $sql)
	{
		try {
			$sql = $db->sql($sql, $db->id);
			$sql->execute();
			return true; // Bisher alles ok? Dann funktioniert die Query.
		} catch (Exception $e) {
			// Query funktioniert nicht.
			return false;
		}
	}
}

?>