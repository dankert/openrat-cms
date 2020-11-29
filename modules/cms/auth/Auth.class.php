<?php


namespace cms\auth;

/**
 * Interface for Authentication
 */
interface Auth
{
	const STATUS_SUCCESS        = 1;
	const STATUS_FAILED         = 2;
	const STATUS_PW_EXPIRED     = 4;
	const STATUS_TOKEN_NEEDED   = 8;
	const STATUS_ACCOUNT_LOCKED = 16;

	const NS = __NAMESPACE__;

	/**
	 * Checks the provided login data.
	 *
	 * @param string $username username
	 * @param string $password password
	 * @param string $token token
	 * @return int a bitmask with Auth::STATUS_*
	 */
	function login($username, $password, $token);


	/**
	 * Ermittelt den Benutzernamen.
	 * Der Benutzername wird verwendet, um die Loginmaske vorauszufüllen.
	 * @return string the username or null
	 */
	function username();
}