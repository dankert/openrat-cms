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
		$sql = new Sql( <<<SQL
SELECT node.name as name, user.password as password FROM {t_node} AS node
 LEFT JOIN {t_user} AS user
        ON user.node=node.id
 WHERE node.name={name} AND node.typ={type}
SQL
		);
		$sql->setString('name',$username);
		$sql->setInt   ('type',NODE_TYPE_USER);
		
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