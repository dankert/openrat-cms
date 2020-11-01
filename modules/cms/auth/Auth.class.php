<?php


namespace cms\auth;
use Benutzername;
use Kennwort;

interface Auth
{

	const STATUS_SUCCESS      = 1;
	const STATUS_FAILED       = 2;
	const STATUS_PW_EXPIRED   = 3;
	const STATUS_TOKEN_NEEDED = 4;

	const NS = __NAMESPACE__;

	/**
	 * Prüft den eingegebenen Benutzernamen und das Kennwort
	 * auf Richtigkeit.
	 *
	 * @param string Benutzername
	 * @param string Kennwort
	 */
	function login($username, $password, $token);


	/**
	 * Ermittelt den Benutzernamen.
	 * Der Benutzername wird verwendet, um die Loginmaske vorauszufüllen.
	 */
	function username();
}

