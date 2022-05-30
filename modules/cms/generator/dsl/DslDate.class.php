<?php

namespace cms\generator\dsl;

use cms\model\Page;
use cms\model\Project;
use dsl\context\DslObject;

class DslDate implements DslObject
{
	private $time;

	/**
	 * DslPage constructor.
	 */
	public function __construct($time=null)
	{
		if   ( $time = null )
			$time = time();

		$this->time = $time;
	}


	public function getDate() { return date('d',$this->time); }
	public function getDay() { return date('w',$this->time); }
	public function getFullYear() { return date('Y',$this->time); }
	public function getHours() { return date('H',$this->time); }
	public function getMilliseconds() { return 0; }
	public function getMinutes() { return date('i',$this->time); }
	public function getMonth() { return date('m',$this->time); }
	public function getSeconds() { return date('s',$this->time); }
	public function getTime() { return $this->time * 1000; }
	public function getTimezoneOffset() {return date('y',$this->time)/60;}
	public function getUTCDate() {return date('d',$this->time);}
	public function getUTCDay() {return date('w',$this->time);}
	public function getUTCFullYear() {return date('Y',$this->time);}
	public function getUTCHours() {return date('H',$this->time);}
	public function getUTCMilliseconds() {return 0;}
	public function getUTCMinutes() {return date('i',$this->time);}
	public function getUTCMonth() {return date('m',$this->time);}
	public function getUTCSeconds() {return date('s',$this->time);}
	public function getYear() { return date('y',$this->time); }
}