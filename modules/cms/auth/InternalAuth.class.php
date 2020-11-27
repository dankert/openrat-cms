<?php

namespace cms\auth;

use cms\base\Configuration;
use cms\base\DB as Db;
use cms\base\Startup;
use cms\model\User;
use LogicException;
use security\Password;

/**
 * Authentifizierungsmodul für die interne Benutzerdatenbank.
 *
 * @author Jan Dankert
 *
 */
class InternalAuth implements Auth
{
	/**
	 * Ueberpruefen des Kennwortes
	 * ueber die Benutzertabelle in der Datenbank.
	 */
	function login($username, $password, $token)
	{
		// Lesen des Benutzers aus der DB-Tabelle
		$sql = Db::sql(<<<SQL
SELECT * FROM {{user}}
 WHERE name={name}
SQL
		);
		$sql->setString('name', $username);

		$row_user = $sql->getRow();

		if (empty($row_user)) {

			// Benutzer ist nicht vorhanden.
			// Trotzdem das Kennwort hashen, um Timingattacken zu verhindern.
			$unusedHash = Password::hash(User::pepperPassword($password), Password::bestAlgoAvailable());
			return null;
		}

		$lockedUntil = $row_user['password_locked_until'];
		if ( $lockedUntil && $lockedUntil > Startup::getStartTime() ) {
			return Auth::STATUS_FAILED; // Password is locked
		}

		// Pruefen ob Kennwort mit Datenbank uebereinstimmt.
		if (!Password::check(User::pepperPassword($password), $row_user['password_hash'], $row_user['password_algo'])) {
			return Auth::STATUS_FAILED;
		}

		// Behandeln von Klartext-Kennwoertern (Igittigitt).
		if ($row_user['password_algo'] == Password::ALGO_PLAIN) {
			if (Configuration::subset(['security', 'password'] )->is('force_change_if_cleartext',true))
				// Kennwort steht in der Datenbank im Klartext.
				// Das Kennwort muss geaendert werden
				return Auth::STATUS_PW_EXPIRED;

			// Anderenfalls ist das Login zwar moeglich, aber das Kennwort wird automatisch neu gehasht, weil der beste Algo erzwungen wird.
			// Das Klartextkennwort waere danach ueberschrieben.
		}

		if ($row_user['password_expires'] != null && $row_user['password_expires'] < time()) {
			// Kennwort ist abgelaufen.

			// Wenn das kennwort abgelaufen ist, kann es eine bestimmte Dauer noch benutzt und geändert werden.
			// Nach Ablauf dieser Dauer wird das Login abgelehnt.
			if ($row_user['password_expires'] + (Configuration::subset('security')->get('deny_after_expiration_duration',72) * 60 * 60) < time())
				return Auth::STATUS_FAILED; // Abgelaufenes Kennwort wird nicht mehr akzeptiert.
			else
				return Auth::STATUS_PW_EXPIRED; // Kennwort ist abgelaufen, kann aber noch geändert werden.
		}

		if ($row_user['totp'] == 1) {
			$user = new User($row_user['id']);
			$user->load();
			if (Password::getTOTPCode($user->otpSecret) == $token)
				return Auth::STATUS_SUCCESS;
			else
				return Auth::STATUS_TOKEN_NEEDED;
		}

		if ($row_user['hotp'] == 1) {
			throw new LogicException('HOTP not yet implemented.');
		}

		// Benutzer wurde erfolgreich authentifiziert.
		return Auth::STATUS_SUCCESS;
	}

	public function username()
	{
		return null;
	}
}
