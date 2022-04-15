<?php

namespace cms\auth;

use cms\base\Configuration;
use cms\base\DB as Db;
use cms\base\Startup;
use cms\model\User;
use language\Messages;
use logger\Logger;
use LogicException;
use security\OTP;
use security\Password;
use util\mail\Mail;

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
			if ( DEVELOPMENT )
				Logger::debug('user not found');
			return Auth::STATUS_FAILED ;
		}

		$lockedUntil = $row_user['password_locked_until'];
		if ( $lockedUntil && $lockedUntil > Startup::getStartTime() ) {
			if ( DEVELOPMENT )
				Logger::debug('user account ist locked until '.date('r',$lockedUntil));
			return Auth::STATUS_FAILED + Auth::STATUS_ACCOUNT_LOCKED; // Password is locked
		}

		// Pruefen ob Kennwort mit Datenbank uebereinstimmt.
		if (!Password::check(User::pepperPassword($password), $row_user['password_hash'], $row_user['password_algo'])) {
			// Password does NOT match.

			// Increase password fail counter
			$sql = Db::sql(<<<SQL
UPDATE {{user}}
 SET password_fail_count=password_fail_count+1
 WHERE name={name}
SQL
			);
			$sql->setString('name', $username);
			$sql->execute();

			$row_user['password_fail_count']++;

			$lockAfter = Configuration::subset(['security','password'])->get('lock_after_fail_count',10);
			if   ( $lockAfter && $row_user['password_fail_count'] % $lockAfter == 0 ) {
				// exponentially increase the lock duration.
				$factor         = pow(2, intval($row_user['password_fail_count']/$lockAfter) - 1 ) ;
				$lockedDuration = Configuration::subset(['security','password'])->get('lock_duration',120) * $factor * 60;

				$lockedUntil = Startup::getStartTime() + $lockedDuration;

				$sql = Db::sql(<<<SQL
UPDATE {{user}}
 SET password_locked_until={locked_until}
 WHERE name={name}
SQL
				);
				$sql->setString('name'        , $username  );
				$sql->setInt   ('locked_until',$lockedUntil);
				$sql->execute();

				// Inform the user about the lock.
				if   ( $row_user['mail'] ) {
					$mail = new Mail( $row_user['mail'],Messages::MAIL_PASSWORD_LOCKED_SUBJECT,Messages::MAIL_PASSWORD_LOCKED);
					$mail->setVar('username',$row_user['name'    ]                                                         );
					$mail->setVar('name'    ,$row_user['fullname']                                                         );
					$mail->setVar('until'   ,date( \cms\base\Language::lang(Messages::DATE_FORMAT_FULL ), $lockedUntil ) );
					$mail->send();
				}
			}
			Db::get()->commit();

			return Auth::STATUS_FAILED;
		}

		// Password match :)

		// Clear password fail counter
		$sql = Db::sql(<<<SQL
UPDATE {{user}}
 SET password_fail_count=0
 WHERE name={name}
SQL
		);
		$sql->setString('name', $username);
		$sql->execute();

		// Behandeln von Klartext-Kennwoertern (Igittigitt).
		if ($row_user['password_algo'] == Password::ALGO_PLAIN) {
			if (Configuration::subset(['security', 'password'] )->is('force_change_if_cleartext',true))
				// Kennwort steht in der Datenbank im Klartext.
				// Das Kennwort muss geaendert werden
				return Auth::STATUS_FAILED + Auth::STATUS_PW_EXPIRED;

			// Anderenfalls ist das Login zwar moeglich, aber das Kennwort wird automatisch neu gehasht, weil der beste Algo erzwungen wird.
			// Das Klartextkennwort waere danach ueberschrieben.
		}

		if ($row_user['password_expires'] != null && $row_user['password_expires'] < time()) {
			// Kennwort ist abgelaufen.

			// Wenn das kennwort abgelaufen ist, kann es eine bestimmte Dauer noch benutzt und geändert werden.
			// Nach Ablauf dieser Dauer wird das Login abgelehnt.
			if ($row_user['password_expires'] + (Configuration::subset('security')->getSeconds('deny_after_expiration_duration',3*24*60*60)) < time())
				return Auth::STATUS_FAILED + Auth::STATUS_PW_EXPIRED; // Abgelaufenes Kennwort wird nicht mehr akzeptiert.
			else
				return Auth::STATUS_SUCCESS + Auth::STATUS_PW_EXPIRED; // Kennwort ist abgelaufen, kann aber noch geändert werden.
		}

		if ($row_user['totp'] == 1) {
			$user = new User($row_user['id']);
			$user->load();
			if ( DEVELOPMENT )
				Logger::info("valid TOTP tokens are \n".print_r(OTP::getValidTOTPCodes($user->otpSecret),true));
			if ( in_array( $token, OTP::getValidTOTPCodes($user->otpSecret) ) )
				return Auth::STATUS_SUCCESS;
			else
				return Auth::STATUS_FAILED + Auth::STATUS_TOKEN_NEEDED;
		}
		elseif ($row_user['hotp'] == 1) {
			$user = new User($row_user['id']);
			$user->load();
			$validHOTPCodes = OTP::getValidHOTPCodes($user->otpSecret,$user->hotpCount);
			if ( DEVELOPMENT )
				Logger::info("valid HOTP tokens are \n".print_r($validHOTPCodes,true));
			if ( in_array( $token, $validHOTPCodes ) ) {
				// Synchronize the internal counter
				$newCount = array_flip($validHOTPCodes)[$token]+1;
				$sql = Db::sql(<<<SQL
UPDATE {{user}}
 SET hotp_counter={count}
 WHERE name={name}
SQL
				);
				$sql->setString('name' ,$username );
				$sql->setInt   ('count',$newCount );
				$sql->execute();
				return Auth::STATUS_SUCCESS;
			}
			else
				return Auth::STATUS_FAILED + Auth::STATUS_TOKEN_NEEDED;
		}

		// Benutzer wurde erfolgreich authentifiziert.
		return Auth::STATUS_SUCCESS;
	}

	public function username()
	{
		return null;
	}
}
