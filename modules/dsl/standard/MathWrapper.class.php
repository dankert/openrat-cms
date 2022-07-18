<?php
namespace dsl\standard;

use dsl\context\BaseScriptableObject;

class MathWrapper extends BaseScriptableObject
{
	public $E = M_EULER;
	public $PI = M_PI;
	public $LN2 = M_LN2;
	public $LN10 = M_LN10;
	public $SQRT1_2 = M_SQRT1_2;
	public $SQRT2 = M_SQRT2;

	public function sqrt($x) { return sqrt(  $x ); }

	public function abs($x) { return abs($x);}
	public function neg($x) { return abs($x) * -1; }

	public function acos($x) { return ($x); }
	public function acosh($x) { return ($x); }
	public function asin($x) { return ($x); }
	public function asinh($x) { return ($x); }
	public function atan($x) { return atan($x); }
	public function atanh($x)  { return atanh($x); }
	public function atan2($y, $x) { return atan2($y,$x); }
	public function cbrt($x) { return ($x); }
	public function cos($x) { return cos($x); }
	public function cosh($x) { return cosh($x); }
	public function sin($x) { return sin($x); }
	public function sinh($x) { return sinh($x); }
	public function tan($x) { return tan($x); }
	public function tanh($x) { return tanh($x); }

	public function ceil($x) { return ceil($x); }
	public function floor($x) { return floor($x); }

	public function exp($x) { return exp($x); }
	public function expm1($x) { return expm1($x); }
	public function log($x) { return log($x); }
	public function log1p($x) { return log($x); }
	public function log10($x) { return log10($x); }
	public function max($x,$y) { return max($x,$y); }
	public function min($x,$y) { return min($x,$y); }
	public function pow($x,$y) { return pow($x,$y); }
	public function random() { return rand(); }
	public function round($x) { return round($x); }
}