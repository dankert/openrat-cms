<?php

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
		$sql = new Sql( <<<SQL
SELECT * FROM {t_user}
 WHERE name={name}
SQL
		);
		$sql->setString('name',$username);
	
		$row_user = $db->getRow( $sql );

		// Pruefen ob Kennwort mit Datenbank uebereinstimmt
		if   ( $row_user['password'] == $password )
		{
			// Kennwort stimmt mit Datenbank �berein, aber nur im Klartext.
			// Das Kennwort muss ge�ndert werden
			$this->mustChangePassword = true;
			
			// Login nicht erfolgreich
			return false;
		}
		elseif   ( $row_user['password'] == md5( User::saltPassword($password) ) )
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