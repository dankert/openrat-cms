<?php


namespace cms\ui\themes;


use cms\base\Configuration as C;
use util\text\Converter;

class ThemeStyle
{
	private $name;

	private $textColor       = [0,0,0];       // 'black', default text color
	private $backgroundColor = [217,217,217]; // '#d9d9d9', default background color

	private $inactiveBackgroundColor;

	private $mainTextColor      ;
	private $mainBackgroundColor;
	private $mainGroupBackgroundColor;
	private $mainTitleBackgroundColor;
	private $mainTitleTextColor;

	private $navBackgroundColor;
	private $navGroupBackgroundColor;
	private $navTextColor;
	private $navTitleBackgroundColor;
	private $navTitleTextColor;

	private $dialogTitleBackgroundColor;
	private $dialogTitleTextColor;
	private $dialogBackgroundColor;
	private $dialogGroupBackgroundColor;
	private $dialogTextColor;

	private $themeColor;
	private $arrowColor;
	private $imageColor;

	private $noticeOkColor      = '#00d95a';
	private $noticeInfoColor    = '#86caff';
	private $noticeWarningColor = '#FBDE2D';
	private $noticeErrorColor   = '#f54b07';

	private $transitionDuration = '0.2s';


	const COLORS =[
		'aliceblue'   =>'#f0f8ff',
		'antiquewhite'=>'#faebd7',
		'aqua'        =>'#00ffff',
		'aquamarine'  =>'#7fffd4',
		'azure'       =>'#f0ffff',
		'beige'       =>'#f5f5dc',
		'bisque'      =>'#ffe4c4',
		'black'       =>'#000000',
		'blanchedalmond'=>'#ffebcd',
		'blue'        =>'#0000ff',
		'blueviolet'  =>'#8a2be2',
		'brown'       =>'#a52a2a',
		'burlywood'   =>'#deb887',
		'cadetblue'   =>'#5f9ea0',
		'chartreuse'  =>'#7fff00',
		'chocolate'   =>'#d2691e',
		'coral'       =>'#ff7f50',
		'cornflowerblue'=>'#6495ed',
		'cornsilk'    =>'#fff8dc',
		'crimson'     =>'#dc143c',
		'cyan'        =>'#00ffff',
		'darkblue'    => '#00008b',
		'darkcyan'    => '#008b8b',
		'darkgoldenrod'=> '#b8860b',
		'darkgray'    => '#a9a9a9',
		'darkgrey'    => '#a9a9a9',
		'darkgreen'   => '#006400',
		'darkkhaki'   => '#bdb76b',
		'darkmagenta' => '#8b008b',
		'darkolivegreen' => '#556b2f',
		'darkorange'    => '#ff8c00',
		'darkorchid'    => '#9932cc',
		'darkred'       => '#8b0000',
		'darksalmon'    => '#e9967a',
		'darkseagreen'  => '#8fbc8f',
		'darkslateblue' => '#483d8b',
		'darkslategray' => '#2f4f4f',
		'darkslategrey' => '#2f4f4f',
		'darkturquoise' => '#00ced1',
		'darkviolet'    => '#9400d3',
		'deeppink'      => '#ff1493',
		'deepskyblue'   => '#00bfff',
		'dimgray'       => '#696969',
		'dimgrey'       => '#696969',
		'dodgerblue'    => '#1e90ff',
		'firebrick'     => '#b22222',
		'floralwhite'   => '#fffaf0',
		'forestgreen'   => '#228b22',
		'fuchsia'       => '#ff00ff',
		'gainsboro'     => '#dcdcdc',
		'ghostwhite'    => '#f8f8ff',
		'gold'          => '#ffd700',
		'goldenrod'     => '#daa520',
		'gray'          => '#808080',
		'grey'          => '#808080',
		'green'         => '#008000',
		'greenyellow'   => '#adff2f',
		'honeydew'      => '#f0fff0',
		'hotpink'       => '#ff69b4',
		'indianred'     => '#cd5c5c',
		'indigo'        => '#4b0082',
		'ivory'         => '#fffff0',
		'khaki'         => '#f0e68c',
		'lavender'      => '#e6e6fa',
		'lavenderblush' => '#fff0f5',
		'lawngreen'     => '#7cfc00',
		'lemonchiffon'  => '#fffacd',
		'lightblue'     => '#add8e6',
		'lightcoral'    => '#f08080',
		'lightcyan'     => '#e0ffff',
		'lightgoldenrodyellow' => '#fafad2',
		'lightgray'     => '#d3d3d3',
		'lightgrey'     => '#d3d3d3',
		'lightgreen'    => '#90ee90',
		'lightpink'     => '#ffb6c1',
		'lightsalmon'   => '#ffa07a',
		'lightseagreen' => '#20b2aa',
		'lightskyblue'  => '#87cefa',
		'lightslategray' => '#778899',
		'lightslategrey' => '#778899',
		'lightsteelblue' => '#b0c4de',
		'lightyellow'    => '#ffffe0',
		'lime'      => '#00ff00',
		'limegreen' => '#32cd32',
		'linen'     => '#faf0e6',
		'magenta'   => '#ff00ff',
		'maroon'    => '#800000',
		'mediumaquamarine' => '#66cdaa',
		'mediumblue'       => '#0000cd',
		'mediumorchid'     => '#ba55d3',
		'mediumpurple'     => '#9370d8',
		'mediumseagreen'   => '#3cb371',
		'mediumslateblue'  => '#7b68ee',
		'mediumspringgreen' => '#00fa9a',
		'mediumturquoise'  => '#48d1cc',
		'mediumvioletred'  => '#c71585',
		'midnightblue'     => '#191970',
		'mintcream'        => '#f5fffa',
		'mistyrose'        => '#ffe4e1',
		'moccasin'         => '#ffe4b5',
		'navajowhite'      => '#ffdead',
		'navy'             => '#000080',
		'oldlace'          => '#fdf5e6',
		'olive'            => '#808000',
		'olivedrab'        => '#6b8e23',
		'orange'        => '#ffa500',
		'orangered'     => '#ff4500',
		'orchid'        => '#da70d6',
		'palegoldenrod' => '#eee8aa',
		'palegreen'     => '#98fb98',
		'paleturquoise' => '#afeeee',
		'palevioletred' => '#d87093',
		'papayawhip'    => '#ffefd5',
		'peachpuff'     => '#ffdab9',
		'peru'          => '#cd853f',
		'pink'          => '#ffc0cb',
		'plum'          => '#dda0dd',
		'powderblue'    => '#b0e0e6',
		'purple'        => '#800080',
		'red'           => '#ff0000',
		'rosybrown'     => '#bc8f8f',
		'royalblue'     => '#4169e1',
		'saddlebrown'   => '#8b4513',
		'salmon'        => '#fa8072',
		'sandybrown'    => '#f4a460',
		'seagreen'      => '#2e8b57',
		'seashell'      => '#fff5ee',
		'sienna'        => '#a0522d',
		'silver'        => '#c0c0c0',
		'skyblue'       => '#87ceeb',
		'slateblue'     => '#6a5acd',
		'slategray'     => '#708090',
		'slategrey'     => '#708090',
		'snow'          => '#fffafa',
		'springgreen'   => '#00ff7f',
		'steelblue'     => '#4682b4',
		'tan'           => '#d2b48c',
		'teal'          => '#008080',
		'thistle'       => '#d8bfd8',
		'tomato'        => '#ff6347',
		'turquoise'     => '#40e0d0',
		'violet'        => '#ee82ee',
		'wheat'         => '#f5deb3',
		'white'         => '#ffffff',
		'whitesmoke'    => '#f5f5f5',
		'yellow'        => '#ffff00',
		'yellowgreen'   => '#9acd32'
	];

	/**
	 * ThemeStyle constructor.
	 */
	public function __construct( $config )
	{
		if   ( is_string( $config ) )
			$config = C::subset('style')->get( $config,[]); // user style config

		$this->setValues( $config );
		$this->fillMissingValues();
	}



	protected function setValues( $styleConfig ) {

		foreach( $styleConfig as $property=>$value ) {
			$property = Converter::toCamelCase($property);
			if   ( property_exists($this,$property ) ) {
				if   ( substr($property,-5) == 'Color')
					// - Converting color names to HEX
					// - Converting HEX to RGB values
					$this->$property = $this->hex2rgb(self::getColorHexCodeForName($value));
				else
					$this->$property = $value;

			}
		}
	}


	/**
	 * Fill empty values with a default value.
	 */
	protected function fillMissingValues() {

		if   ( ! $this->mainTitleBackgroundColor )
			$this->mainTitleBackgroundColor = $this->backgroundColor;

		if   ( ! $this->mainTitleTextColor )
			$this->mainTitleTextColor = $this->textColor;

		if   ( ! $this->mainBackgroundColor )
			$this->mainBackgroundColor = $this->backgroundColor;

		if   ( ! $this->mainTextColor )
			$this->mainTextColor = $this->textColor;

		if   ( ! $this->mainGroupBackgroundColor )
			$this->mainGroupBackgroundColor = $this->mix($this->mainBackgroundColor,$this->mainTextColor,0.95);

		if   ( ! $this->themeColor )
			$this->themeColor = $this->mainTitleBackgroundColor;

		if   ( ! $this->inactiveBackgroundColor )
			$this->inactiveBackgroundColor = $this->backgroundColor;


		if   ( ! $this->navTextColor )
			$this->navTextColor = $this->mainTextColor;

		if   ( ! $this->navBackgroundColor )
			$this->navBackgroundColor = $this->mainBackgroundColor;

		if   ( ! $this->navGroupBackgroundColor )
			$this->navGroupBackgroundColor = $this->mix($this->navBackgroundColor,$this->navTextColor,0.95);

		if   ( ! $this->navTitleTextColor )
			$this->navTitleTextColor= $this->navTextColor;

		if   ( ! $this->navTitleBackgroundColor )
			$this->navTitleBackgroundColor = $this->navBackgroundColor;


		if   ( ! $this->dialogTitleTextColor )
			$this->dialogTitleTextColor = $this->mainTitleTextColor;

		if   ( ! $this->dialogTitleBackgroundColor )
			$this->dialogTitleBackgroundColor = $this->mainTitleBackgroundColor;

		if   ( ! $this->dialogTextColor )
			$this->dialogTextColor = $this->mainTextColor;

		if   ( ! $this->dialogBackgroundColor )
			$this->dialogBackgroundColor = $this->mainBackgroundColor;

		if   ( ! $this->dialogGroupBackgroundColor )
			$this->dialogGroupBackgroundColor = $this->mix($this->dialogBackgroundColor,$this->dialogTextColor,0.95);

		if   ( ! $this->arrowColor )
			$this->arrowColor = $this->themeColor;

		if   ( ! $this->imageColor )
			$this->imageColor = $this->mainTitleTextColor;
	}


	/**
	 * Get all colors from the theme in HEX format.
	 * @return array
	 */
	public function getProperties() {

		return array_map( function ($rgb) {
				if   ( is_array($rgb))
					return $this->rgb2hex($rgb);
				else
					return $rgb;
			},get_object_vars($this)
		);
	}

	/**
	 * Theme color.
	 *
	 * This color is mainly used for colorizing status bars in a web browser.
	 *
	 * @return string
	 */
	public function getThemeColor()
	{
		return $this->rgb2hex($this->themeColor);
	}


	/**
	 * mix
	 *
	 * @param  mixed $color_1
	 * @param  mixed $color_2
	 * @param  mixed $weight
	 *
	 * @return array
	 */
	protected function mix($color_1 = array(0, 0, 0), $color_2 = array(0, 0, 0), $weight = 0.5)
	{
		$f = function ($x) use ($weight) {
			return $weight * $x;
		};

		$g = function ($x) use ($weight) {
			return (1 - $weight) * $x;
		};

		$h = function ($x, $y) {
			return round($x + $y);
		};

		return array_map($h, array_map($f, $color_1), array_map($g, $color_2));
	}
	/**
	 * tint
	 *
	 * @param  mixed $color
	 * @param  mixed $weight
	 *
	 * @return void
	 */
	protected function tint($color, $weight = 0.5)
	{
		$t = $color;

		if (is_string($color)) {
			$t = hex2rgb($color);
		}

		$u = $this->mix($t, array(255, 255, 255), $weight);

		if (is_string($color)) {
			return rgb2hex($u);
		}

		return $u;
	}

	/**
	 * tone
	 *
	 * @param  mixed $color
	 * @param  mixed $weight
	 *
	 * @return void
	 */
	protected function tone($color, $weight = 0.5)
	{
		$t = $color;

		if (is_string($color)) {
			$t = hex2rgb($color);
		}

		$u = $this->mix($t, array(128, 128, 128), $weight);

		if (is_string($color)) {
			return rgb2hex($u);
		}

		return $u;
	}

	/**
	 * shade
	 *
	 * @param  mixed $color
	 * @param  mixed $weight
	 *
	 * @return void
	 */
	protected function shade($color, $weight = 0.5)
	{
		$t = $color;

		if (is_string($color)) {
			$t = hex2rgb($color);
		}

		$u = $this->mix($t, array(0, 0, 0), $weight);

		if (is_string($color)) {
			return rgb2hex($u);
		}

		return $u;
	}

	/**
	 * hex2rgb
	 *
	 * @param  mixed $hex
	 *
	 * @return array|float[]|int[]|void
	 */
	protected function hex2rgb($hex)
	{
		$hex = str_replace('#', '', $hex);

		if   ( strlen($hex) != 3 && strlen($hex) != 6 )
			throw new \InvalidArgumentException("Hex color '".$hex."' is not valid.");

		$hexToDecimal = function ($x) {
			if   (strlen($x)==1)
				$x = $x.$x; // the short hex notation: "F" becomes "FF".
			return hexdec($x);
		};

		return array_map($hexToDecimal, str_split($hex, strlen($hex)/3));
	}

	/**
	 * rgb2hex
	 *
	 * @param  mixed $rgb
	 *
	 * @return string
	 */
	protected function rgb2hex($rgb = array(0, 0, 0))
	{
		$f = function ($x) {
			return str_pad(dechex($x), 2, "0", STR_PAD_LEFT);
		};

		return "#" . implode("", array_map($f, $rgb));
	}


	/**
	 * Translates a color name into its hexadecimal code.
	 *
	 * If the name is not found, then the name will be returned.
	 *
	 * @param $colorName
	 * @return string
	 */
	protected static function getColorHexCodeForName($colorName ) {

		$colorName = strtolower($colorName);

		return isset(self::COLORS[$colorName])?self::COLORS[$colorName]:$colorName;
	}
}