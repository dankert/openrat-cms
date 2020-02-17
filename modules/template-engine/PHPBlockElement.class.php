<?php


namespace modules\template_engine;


class PHPBlockElement extends HtmlElement
{
	public $beforeBlock;
	public $inBlock;

	public function __construct()
	{
		parent::__construct( null );
	}


	public function getBegin()
	{
		return '<?php '.$this->beforeBlock.' { '.$this->inBlock.' ?>';
	}


	public function getEnd()
	{
		return ' <?php } ?>';
	}





	public function textasvarname($value)
	{
		$expr = new Expression($value);
		return $expr->getTextAsVarName();

	}


	public function varname($value)
	{
		$expr = new Expression($value);
		return $expr->getVarName();
	}



	public function htmlvalue($value)
	{
		$expr = new Expression($value);
		return $expr->getHTMLValue();
	}



	public function value( $value )
	{
		$expr = new Expression($value);
		return $expr->getPHPValue();
	}


	public function includeResource($file )
	{
		return "include_once( 'modules/template-engine/components/html/".$file."');";
	}

}



class Expression
{
	public $type;
	public $value;
	public $invert = false;

	public function getHTMLValue()
	{
		switch ($this->type) {
			case 'text':
				return $this->value;

			default:
				return '<' . '?php echo ' . $this->getPHPValue() . ' ?>';
		}
	}


	public function __construct($value)
	{
		// Falls der Wert 'true' oder 'false' ist.
		if (is_bool($value))
			$value = $value ? 'true' : 'false';

		// Negierung berücksichtigen.
		if (substr($value, 0, 4) == 'not:') {
			$value = substr($value, 4);
			$this->invert = true;
		}

		if ($value && strlen($value) >= 3 && $value[1] == '{') {
			$this->type = $value[0];
			$this->value = substr($value, 2, -1);
		} else {
			$this->type = 'text';
			$this->value = $value;
		}
	}


	public function getVarName()
	{
		switch ($this->type) {
			case '$':
				return '$' . $this->value;
			case 'text':
				return $this->value;
			default:
				throw new \LogicException("Invalid expression type '$this->type' in attribute value. Allowed: text|var");
		}
	}


	public function getTextAsVarName()
	{
		switch ($this->type) {
			case '$':
				return '$$' . $this->value;
			case 'text':
				return '$' . $this->value;
			default:
				return $this->getPHPValue();
		}
	}


	public function getPHPValue()
	{
		$value = $this->value;

		$invert = $this->invert ? '!' : '';

		switch ($this->type) {
			case 'text':
				// Sonderf�lle f�r die Attributwerte "true" und "false".
				// Hinweis: Die Zeichenkette "false" entspricht in PHP true.
				// Siehe http://de.php.net/manual/de/language.types.boolean.php
				if ($value == 'true' || $value == 'false')
					return $value;
				else
					return "'" . $value . "'";
			case '$':
				return $invert . '$' . $value;
			case 'size':
				return '@count($' . $value . ')';
			case '#':
				// macht aus "text1{var}text2" => "text1".$var."text2"
				$value = preg_replace('/{(\w+)\}/', '\'.$\\1.\'', $value);
				return 'lang(' . "'" . $value . "'" . ')';
			case '%':
				$config_parts = explode('/', $value);
				return $invert . 'config(' . "'" . implode("'" . ',' . "'", $config_parts) . "'" . ')';

			default:
				throw new \LogicException("Unknown expression type '{$this->type}' in attribute value. Allowed: var|function|method|text|size|property|message|messagevar|arrayvar|config or none");
		}
	}
}