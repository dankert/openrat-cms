<?php

namespace util;

use cms\model\User;
use database\Database;
use security\Password;


/**
 * Request
 *
 */
class Request
{
	private static $user;
	private static $config;
	private static $databaseId;

	/**
	 * Database object.
	 * Request scope.
	 * @var
	 */
	private static $database;

	public static function setConfig($config ) {
		self::$config = $config;
		Session::set( Session::KEY_CONFIG,$config );
	}
	public static function getConfig() {
		return self::$config ?: Session::get( Session::KEY_CONFIG );
	}

	public static function setUser( $user ) {
		self::$user = $user;
		Session::set( Session::KEY_USER, $user );
	}
	public static function getUser() {
		return self::$user ?: Session::get( Session::KEY_USER );
	}

	public static function getDatabaseId() {
		return self::$databaseId ?: Session::get( Session::KEY_DBID );
	}

	/**
	 * @return Database
	 */
	public static function getDatabase()
	{
		return self::$database;
	}

	/**
	 * @param $db Database
	 * @return void
	 */
	public static function setDatabase($db )
	{
		self::$databaseId = $db->id;
		Session::set( Session::KEY_DBID,self::$databaseId );

		self::$database = $db;
	}
}

