<?php

/**
 * Authentifizierungsmodul für die interne Benutzerdatenbank.
 * 
 * @author Jan Dankert
 *
 */
class InternalAuth implements Auth
{
	var $mustChangePassword = false;
	
	/**
	 * Ueberpruefen des Kennwortes
	 * ueber die Benutzertabelle in der Datenbank.
	 */
	function login( $username, $password )
	{
		global $conf;

		$db = db_connection();
		
		// Lesen des Benutzers aus der DB-Tabelle
		$sql = $db->sql( <<<SQL
SELECT * FROM {{user}}
 WHERE name={name}
SQL
		);
		$sql->setString('name',$username);
	
		$row_user = $sql->getRow( $sql );

		if	( empty($row_user) )
			// Benutzer ist nicht vorhanden
			return false;
		// Pruefen ob Kennwort mit Datenbank uebereinstimmt
		elseif   ( $row_user['password'] == $password )
		{
			// Kennwort stimmt mit Datenbank �berein, aber nur im Klartext.
			// Das Kennwort muss ge�ndert werden
			$this->mustChangePassword = true;
			
			// Login nicht erfolgreich
			return false;
		}
		elseif   ( Password::check(User::pepperPassword($password),$row_user['password']) )
		{
			// Die Kennwort-Pruefsumme stimmt mit dem aus der Datenbank �berein.
			// Juchuu, Login ist erfolgreich.
			return true;
		}
		else
		{
			// Kennwort stimmt garnicht ueberein.
			return false;
		}
	}
	
	public function username()
	{
		return null;
	}
}

?>