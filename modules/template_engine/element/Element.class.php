<?php


namespace template_engine\element;


use cms\template_engine\SimpleAttribute;

class Element
{
	private $name;
	/**
	 * @var array
	 */
	protected $attributes = [];
	protected $content    = '';

	protected $selfClosing = false;

	/**
	 * @var array
	 */
	protected $children = [];


	/**
	 * @param $element Element
	 */
	public function asChildOf($element ) {
		$element->addChild($this);
		return $this;
	}

	public function addChild($child ) {

		if   ( is_array( $child ) )
			$this->children += $child;
		else
			$this->children[] = $child;

		return $this;
	}

	public function __construct( $name )
	{
		$this->name = $name;
	}

	protected function getAttributeValue($name ){
		return $this->attributes[$name]->render();
	}

	public function content( $content )
	{
		$this->content = $content;
		return $this;
	}

	public function render() {

		$this->selfClosing = $this->selfClosing && !$this->content && !$this->children;

		$content = '';

		if   ( $this->name )
			$content .= '<'.$this->name.
				array_reduce( array_keys($this->attributes),function($carry,$key){return $carry.' '.$this->getAttributeValue($key);},'').(($this->selfClosing ?' /':'').'>');

		$content .= $this->getContent();

		$content .= $this->renderChildren();

		if   ( $this->selfClosing )
			;
		else
			if   ( $this->name )
				$content .= '</'.$this->name.'>';

		return $content;
	}

	public function addAttribute($key, $value) {
		$this->attributes[] = new SimpleAttribute($key,$value);
		return $this;
	}

	public function selfClosing($selfClosing) {
		$this->selfClosing = boolval($selfClosing);
		return $this;
	}

	protected function getContent()
	{
		return $this->content;
	}

	protected function renderChildren()
	{
		$content = '';

		/** @var Element $child */
		foreach($this->children as $child ) {
			$content .= $child->render();
		}

		return $content;
	}
}




class Value {
	private $value;
	private $expressions = [];

	const CONTEXT_PHP  = 0;
	const CONTEXT_HTML = 1;
	const CONTEXT_RAW  = 2;

	public static function createExpression( $type, $name ) {
		return $type.'{'.$name.'}';
	}

	public function __construct( $value )
	{
		while( true ) {
			if   ( ! $value )
				break;

			$epos = strpos($value,'{',1);
			$fpos = strpos($value,'}',1);

			if   ( $epos === false || $fpos === false )
				break;

			$type = substr($value,$epos-1,1            );
			$name = substr($value,$epos+1,$fpos-$epos-1);

			$this->expressions[] = new ValueExpression($type,$name,$epos-1);
			$value = substr($value,0,$epos-1).substr($value,$fpos+1);
		}
		$this->value = $value;
	}


	public function render( $context ) {
		switch( $context ) {
			case Value::CONTEXT_PHP:
				return "'".array_reduce(array_reverse($this->expressions),function($carry,$expr) {
					return substr($carry, 0,$expr->position)."'.".$expr->render().'.\''.substr($carry,$expr->position);
				},$this->value)."'";

			case Value::CONTEXT_HTML:
			case Value::CONTEXT_RAW:
				$escape = function($expr) use($context) {
					if   ( $context == self::CONTEXT_HTML )
						return 'encodeHtml(htmlentities('.$expr.'))';
					else
						return $expr;
				};
				return array_reduce(array_reverse($this->expressions),function($carry,$expr) use ($escape) {
					//echo "carry:".$carry.";expr:".$expr->position.':'.$expr->name;
					return substr($carry, 0,$expr->position)."<?php echo ".$escape($expr->render()).' ?>'.substr($carry,$expr->position);
				},$this->value);
		}
	}
}



class ValueExpression {

	public $type;
	public $name;
	public $position;

	const TYPE_DATA_VAR = '$';
	const TYPE_MESSAGE  = '#';
	const TYPE_CONFIG   = '%';

	/**
	 * ValueExpression constructor.
	 * @param $type
	 * @param $name
	 * @param $position
	 */
	public function __construct($type, $name, $position)
	{
		$this->type = $type;
		$this->name = $name;
		$this->position = $position;
	}

	public function render()
	{
		switch( $this->type ) {
			case self::TYPE_DATA_VAR:
				$parts = explode('.', $this->name);

				return array_reduce($parts, function ($carry, $item) {
					if (!$carry)
						return '@$' . $item;
					else
						return $carry.'[\'' . $item . '\']';
				}, '');
			case self::TYPE_MESSAGE:
				return '@lang(\'' . $this->name . '\')';

			case self::TYPE_CONFIG:
				$config_parts = explode('/', $this->name);
				return 'config(' . "'" . implode("'" . ',' . "'", $config_parts) . "'" . ')';
		}
	}

}