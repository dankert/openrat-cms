<?php


namespace cms\ui\themes;


use cms\base\Configuration as C;
use util\text\Converter;

class ThemeStyle
{
	private $name;
	private $titleBackgroundColor;
	private $titleTextColor;
	private $textColor       = 'black';
	private $backgroundColor = '#d9d9d9';
	private $inactiveBackgroundColor;
	private $themeColor;
	private $searchBackgroundcolor;
	private $searchTextColor;
	private $navBackgroundcolor;
	private $navTextColor;
	private $arrowColor;
	private $imageColor;

	private $noticeOkColor      = '#00d95a';
	private $noticeInfoColor    = '#86caff';
	private $noticeWarningColor = '#FBDE2D';
	private $noticeErrorColor   = '#f54b07';

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
				$this->$property = $value;
			}
		}
	}


	/**
	 * Fill empty values with a default value.
	 */
	protected function fillMissingValues() {

		if   ( ! $this->titleBackgroundColor )
			$this->titleBackgroundColor = $this->backgroundColor;

		if   ( ! $this->titleTextColor )
			$this->titleTextColor = $this->textColor;

		if   ( ! $this->themeColor )
			$this->themeColor = $this->titleBackgroundColor;

		if   ( ! $this->inactiveBackgroundColor )
			$this->inactiveBackgroundColor = $this->backgroundColor;

		if   ( ! $this->searchTextColor )
			$this->searchTextColor = $this->titleTextColor;

		if   ( ! $this->searchBackgroundcolor )
			$this->searchBackgroundcolor = $this->titleBackgroundColor;

		if   ( ! $this->navTextColor )
			$this->navTextColor = $this->textColor;

		if   ( ! $this->navBackgroundcolor )
			$this->navBackgroundcolor = $this->backgroundColor;

		if   ( ! $this->arrowColor )
			$this->arrowColor = $this->themeColor;

		if   ( ! $this->imageColor )
			$this->imageColor = $this->themeColor;
	}



	public function getProperties() {

		return get_object_vars($this);
	}

	/**
	 * Theme color.
	 *
	 * @return string
	 */
	public function getThemeColor()
	{
		return $this->themeColor;
	}
}