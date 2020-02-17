<?php


namespace modules\template_engine;


class Element
{
	private $name;
	private $attributes = [];
	private $content    = '';
	private $selfClosing    = true;

	/**
	 * @var array
	 */
	private $parents = [];

	private $children = [];

	/**
	 * @param $wrapperElement Element
	 * @return $this
	 */
	public function addWrapper($wrapperElement ) {
		$wrapperElement->selfClosing(false);
		$this->parents[] = $wrapperElement;
		return $this;
	}

	public function addChild($child ) {
		$this->selfClosing(false );
		$this->children[] = $child;
		return $this;
	}

	public function __construct( $name )
	{
		$this->name = $name;
	}

	protected function getAttribute( $name ){
		return (new Value($this->attributes[$name]))->render(Value::CONTEXT_HTML );
	}

	public function content( $content )
	{
		$this->content = $content;
		return $this;
	}

	public function getBegin() {

		$content = array_reduce( array_reverse($this->parents), function($carry,$item) {
			//$content = '';
			//foreach( $item->children as $child) {
			//	$content .= $child->getBegin().$child->getEnd();
			//}
				return $carry.$item->getBegin();
		}, '' );

		if   ( $this->name )
			$content .= '<'.$this->name.
				array_reduce( array_keys($this->attributes),function($carry,$key){return $carry.' '.$key.'="'.$this->getAttribute($key).'"';},'').(($this->selfClosing && !$this->content && !$this->children)?' /':'').'>';

		$content .= $this->getContent();

		return $content;
	}


	public function getEnd() {

		$content = '';
		if   ( $this->selfClosing && !$this->content && !$this->children)
			;
		else
			if   ( $this->name )
				$content .= '</'.$this->name.'>';

		$content .= array_reduce( $this->parents, function($carry,$item) {
			return $carry.$item->getEnd();
		}, '' );

		return $content;
	}

	public function addAttribute($key, $value) {
		$this->attributes[$key] = $value;
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