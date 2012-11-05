<?php
 
interface Auth
{
	/**
	 * Prüft den eingegebenen Benutzernamen und das Kennwort
	 * auf Richtigkeit.
	 * 
	 * @param Benutzername
	 * @param Kennwort
	 */
	function login( $username, $password );
	
	
	
	/**
	 * Ermittelt den Benutzernamen.
	 */
	function username();
}

?>