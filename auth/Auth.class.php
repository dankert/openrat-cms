<?php
 

DEFINE('OR_AUTH_STATUS_SUCCESS',1);
DEFINE('OR_AUTH_STATUS_FAILED',2);
DEFINE('OR_AUTH_STATUS_PW_EXPIRED',3);
DEFINE('OR_AUTH_STATUS_TOKEN_NEEDED',4);

interface Auth
{
	/**
	 * Prüft den eingegebenen Benutzernamen und das Kennwort
	 * auf Richtigkeit.
	 * 
	 * @param Benutzername
	 * @param Kennwort
	 */
	function login( $username, $password, $token );
	
	
	/**
	 * Ermittelt den Benutzernamen.
	 * Der Benutzername wird verwendet, um die Loginmaske vorauszufüllen.
	 */
	function username();
}

?>