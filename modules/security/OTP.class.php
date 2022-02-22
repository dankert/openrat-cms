<?php
namespace security;



use cms\base\Startup;

/**
 * One time passwords (OTP).
 * Both TOTP (time based OTP) and HOTP are supported.
 * 
 * @author Jan Dankert
 *
 */
class OTP
{
	/**
	 * Supporting only SHA1.
	 * This is the default as specified for the google authenticator.
	 */
	const SUPPORTED_ALGO = 'SHA1';

	/**
	 * Default is 6 digits for the OTP.
	 */
	const OTP_LENGTH = 6;

	/**
	 * Duration of a TOTP timeslot in seconds.
	 */
	const TOTP_DURATION = 30;

	/**
	 * Allow the last n timeslots for TOTP.
	 */
	const TOTP_ALLOW_LAST = 1;

	/**
	 * Allow the next n counts for HOTP.
	 */
	const HOTP_ALLOW_NEXT = 10;


	/**
	 * Calculate valids TOTPs for a secret.
	 *
	 * @param string $secret
	 * @return string valid OTP
	 */
	public static function getTOTPCode($secret)
	{
		// return the OTP for the actual timeslice and for the last one.
		return self::getOTP( $secret, self::getTimeSlice() );
	}


	/**
	 * Calculate valids TOTPs for a secret.
	 *
	 * @param string $secret
	 * @return array valid OTPs
	 */
	public static function getValidTOTPCodes($secret)
	{
		$actualTimeSlice = self::getTimeSlice();

		// return the OTP for the actual timeslice and for the last one.
		return self::getOTPs( $secret, range(
			$actualTimeSlice - self::TOTP_ALLOW_LAST,
			$actualTimeSlice
		) );
	}


	/**
	 * Calculate the HOTP code, with given secret and counter.
	 *
	 * @param string $secret
	 * @param int $count
	 * @return array
	 */
	public static function getValidHOTPCodes($secret, $count)
	{
		return self::getOTPs($secret, range($count,$count+ self::HOTP_ALLOW_NEXT));
	}


	/**
	 * Calculate OTP, with given secret and slot range.
	 * This calculates HOTP and TOTP values.
	 *
	 * @param string $secret
	 * @param array $slots
	 *
	 * @return array
	 */
	protected static function getOTPs($secret, $slotRange )
	{
		// return the OTPs for the given range
		return array_map(function ($slot) use ($secret) {
			return OTP::getOTP($secret, $slot);
		}, array_combine( $slotRange,$slotRange ) );
	}

	/**
	 * Calculate the code, with given secret and slot.
	 * This is valid for HOTP and TOTP.
	 *
	 * @param string   $secret
	 * @param int|null $slot
	 *
	 * @return string
	 */
	protected static function getOTP( $secret, $slot )
	{
		$secretKey = @hex2bin($secret);
		// Pack time into binary string
		$time = chr(0).chr(0).chr(0).chr(0).pack('N*', $slot);
		// Hash it with users secret key
		$hm = hash_hmac(self::SUPPORTED_ALGO, $time, $secretKey, true);
		// Use last nipple of result as index/offset
		$offset = ord(substr($hm, -1)) & 0x0F;
		// grab 4 bytes of the result
		$hashPart = substr($hm, $offset, 4);
		// Unpak binary value
		$value = unpack('N', $hashPart);
		$value = $value[1];
		// Only 32 bits
		$value = $value & 0x7FFFFFFF;
		$modulo = pow(10, self::OTP_LENGTH);
		return str_pad($value % $modulo, self::OTP_LENGTH, '0', STR_PAD_LEFT);
	}


	/**
	 * Actual timeslot.
	 * The number of timeslots since the beginning of unixtime.
	 *
	 * @return int timeslot
	 */
	public static function getTimeSlice()
	{
		return intval(Startup::getStartTime() / self::TOTP_DURATION );
	}


}
