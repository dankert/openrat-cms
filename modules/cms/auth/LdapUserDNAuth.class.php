<?php

namespace cms\auth;

use cms\auth\Auth;
use logger\Logger;
use util\Ldap;

/**
 * Authentifizierung gegen einen LDAP-Server.
 *
 * @author Jan Dankert
 */
class LdapUserDNAuth implements Auth
{
	/**
	 * @see Auth::login()
	 */
	public function login($username, $password, $token)
	{
		$db = \cms\base\DB::get();
		$this->mustChangePassword = false;

		// Lesen des Benutzers aus der DB-Tabelle
		$sql = $db->sql(<<<SQL
SELECT * FROM {{user}}
 WHERE name={name}
SQL
		);
		$sql->setString('name', $username);

		$row_user = $sql->getRow();

		if (empty($row_user))
			return false;

		// Benutzername ist bereits in der Datenbank.
		$userid = $row_user['id'];
		$ldap_dn = $row_user['ldap_dn'];

		if (empty($ldap_dn))
			return false;

		// Falls Modul LDAP nicht vorhanden ist können wir gleich beenden.
		if (!extension_loaded('ldap')) {

			Logger::warn("LDAP Login is not possible: LDAP-Extension ist not loaded.");
			return false;
		}


		Logger::debug('checking login via ldap');
		$ldap = new Ldap();
		$ldap->connect();

		// Benutzer ist bereits in Datenbank
		// LDAP-Login mit dem bereits vorhandenen DN versuchen
		$ok = $ldap->bind($ldap_dn, $password);

		// Verbindung zum LDAP-Server brav beenden
		$ldap->close();

		return $ok;
	}

	public function username()
	{
		return null;
	}

}

?>