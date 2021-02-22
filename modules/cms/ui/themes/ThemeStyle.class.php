<?php


namespace cms\ui\themes;


use cms\base\Configuration as C;
use util\text\Converter;

class ThemeStyle
{
	private $name;

	private $textColor       = 'black';
	private $backgroundColor = '#d9d9d9';

	private $inactiveBackgroundColor;

	private $mainTextColor      ;
	private $mainBackgroundColor;
	private $mainTitleBackgroundColor;
	private $mainTitleTextColor;

	private $navBackgroundColor;
	private $navTextColor;
	private $navTitleBackgroundColor;
	private $navTitleTextColor;

	private $dialogTitleBackgroundColor;
	private $dialogTitleTextColor;
	private $dialogBackgroundColor;
	private $dialogTextColor;

	private $themeColor;
	private $arrowColor;
	private $imageColor;

	private $noticeOkColor      = '#00d95a';
	private $noticeInfoColor    = '#86caff';
	private $noticeWarningColor = '#FBDE2D';
	private $noticeErrorColor   = '#f54b07';

	private $transitionDuration = '0.2s';

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

		if   ( ! $this->mainTitleBackgroundColor )
			$this->mainTitleBackgroundColor = $this->backgroundColor;

		if   ( ! $this->mainTitleTextColor )
			$this->mainTitleTextColor = $this->textColor;

		if   ( ! $this->mainBackgroundColor )
			$this->mainBackgroundColor = $this->backgroundColor;

		if   ( ! $this->mainTextColor )
			$this->mainTextColor = $this->textColor;

		if   ( ! $this->themeColor )
			$this->themeColor = $this->mainTitleBackgroundColor;

		if   ( ! $this->inactiveBackgroundColor )
			$this->inactiveBackgroundColor = $this->backgroundColor;


		if   ( ! $this->navTextColor )
			$this->navTextColor = $this->mainTextColor;

		if   ( ! $this->navBackgroundColor )
			$this->navBackgroundColor = $this->mainBackgroundColor;

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


		if   ( ! $this->arrowColor )
			$this->arrowColor = $this->themeColor;

		if   ( ! $this->imageColor )
			$this->imageColor = $this->mainTitleTextColor;
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