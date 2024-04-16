<?php
namespace util;

class Coordinates
{
	private $lat;
	private $long;

	const FORMAT_WGS84_DEGREES = 1;
	const FORMAT_WGS84_DEGRESS_MINUTES = 2;
	const FORMAT_WGS84_DEGRESS_MINUTES_SECONDS = 3;
	const FORMAT_UTM = 4;
	const FORMAT_PLUSCODE = 5;

	/**
	 * @param $long
	 * @param $lat
	 */
	public function __construct($long, $lat)
	{
		$this->lat = $lat;
		$this->long = $long;
	}

	public function __toString()
	{
		return "".$this->lat."° ".$this->long."°";
	}

	public function format( $type )
	{
		switch( $type ) {
			case self::FORMAT_WGS84_DEGREES:
			default:
				return "".abs($this->lat)."°".($this->lat<0?"S":"N").", ".abs($this->long)."°".($this->long<0?"W":"E");
		}
	}


	/**
	 * @param $otherCoordinates Coordinates
	 * @return float|int
	 */
	function distanceTo($otherCoordinates) {
		if (($this->lat == $otherCoordinates->lat) && ($this->long == $otherCoordinates->long)) {
			return 0;
		}
		else {
			$theta = $this->long - $otherCoordinates->long;
			$dist = sin(deg2rad($this->lat)) * sin(deg2rad($otherCoordinates->lat)) +  cos(deg2rad($this->lat)) * cos(deg2rad($otherCoordinates->lat)) * cos(deg2rad($theta));
			$dist = acos($dist);
			$dist = rad2deg($dist);
			$miles = $dist * 60 * 1.1515;

			//return ($miles * 1.609344); // KM
			return $miles; // miles
		}
	}
}