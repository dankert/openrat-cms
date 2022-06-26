<?php
namespace dsl\standard;

use dsl\context\BaseScriptableObject;

class StandardDate extends BaseScriptableObject
{
	/**
	 * Date.now()
	 *
	 * milliseconds since 1970.
	 *
	 * @return int
	 */
	public function now() {

		return time();
	}



	/**
	 * Gets the current date object.
	 * @return Date
	 */
	public function getDate( $date = null ) {

		return new Date( $date );
	}



	/**
	 * Gets the current date object for a given date.
	 * @return Date
	 */
	public function getDateFor( $year = 0,$month = 0,$day = 0,$hour = 0,$minute = 0,$second = 0 ) {

		$month++; // month in JS is 0-based, but in PHP not.

		return new Date( mktime( $hour, $minute, $second, $month, $day, $year ) );
	}


	public function __toString()
	{
		return "Arrays:Object";
	}

	public function help()
	{
		return Helper::getHelp($this);
	}


	public function parse( $dateAsString ) {

		return strtotime( $dateAsString );
	}
}