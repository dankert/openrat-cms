<?php


namespace util\text\variables;

/**
 * VariableResolver for resolving variables in strings and arrays.
 */

class VariableResolver
{
	public $marker   = '$';
	public $open     = '{';
	public $close    = '}';
	public $namespaceSeparator  = '.';
	public $defaultSeparator    = ':';
	public $renderOnlyVariables = false;

	/**
	 * @var callable
	 */
	private $filterValue = null;

	private $resolvers = [];

	private $value = null;


	/**
	 * Adding a filter function for values.
	 * @param $filter callable
	 */
	public function addFilter( $filter ) {
		$this->filterValue = $filter;
	}

	/**
	 * Adding a default variable resolver.
	 * @param $resolver callable|array
	 */
	public function addDefaultResolver( $resolver ) {
		$this->resolvers[''] = $resolver;
	}

	/**
	 * Adding a variable resolver for a key.
	 *
	 * @param $key string key
	 * @param $resolver callable|array
	 */
	public function addResolver( $key, $resolver ) {
		$this->resolvers[$key] = $resolver;
	}


	/**
	 * Resolving a variable in a text like 'name is ${env:username:default}.'
	 *
	 * @param $value string
	 * @return string
	 */
	public function resolveVariables($value) {

		$this->parseString( $value );
		return $this->renderToString();
	}

	/**
	 * Resolving a variable in a text like 'name is ${env.username:default}.'
	 *
	 * @param $value array
	 * @return array
	 */
	public function resolveVariablesInArray($value) {

		// pass-by-reference
		array_walk_recursive($value, function (&$item, $keyI) {

			$item = $this->resolveVariables($item);
			return $item;
		});

		return $value;

	}

	/**
	 * Resolving a variable in a text like 'name is ${env:username:default}'.
	 *
	 * @param $value
	 * @param $key
	 * @param $resolver
	 * @return string
	 */
	public function parseString($value)
	{
		$this->value = $this->parseToValue($value);
	}

	public function renderToString()
	{
		return $this->render( $this->value );
	}



	protected function render( $value )
	{
		$text = '';

		foreach( $value->expressions as $expression )
		{
			if   ( $expression instanceof ValueExpression ) {
				$key = $this->render($expression->prefix);
				$resolver = @$this->resolvers[ $key ];
				$v = '';
				if   ( is_callable($resolver) ) {
					$v = $resolver( $this->render($expression->name) );
				}
				elseif   ( is_array($resolver) ) {
					$v = @$resolver[ $this->render($expression->name ) ];
				}
				if   ( strlen($v)==0 )
					$v = $this->render($expression->default);

				if   ( $this->filterValue ) {
					$filter = $this->filterValue;
					$v = $filter( $v );
				}

				$text .= $v;
			}else {
				$text .= strval( $expression );
			}
		}

		return $text;
	}


	private function findNextPosOfChar( $haystack, $needle ) {

		$chars = str_split($haystack);
		$depth = 0;
		$pos   = 0;
		foreach( $chars as $char) {

			if   ( $char == $this->open )
				$depth++;
			elseif   ( $char == $needle && $depth == 0 )
				return $pos;
			elseif   ( $char == $this->close )
				$depth--;

			$pos++;
		}

		return false;

	}

	/**
	 * @param $inputText
	 * @return Value
	 */
	public function parseToValue($inputText)
	{
		$v = new Value();

		while (true) {

			if	( strlen($inputText)==0 ) // Do not compare to "false" here, as '0' is false ;)
				break;

			// Search the next variable marker '$'
			$nextVariableMarkerPos = strpos($inputText, $this->marker.$this->open);

			if   ($nextVariableMarkerPos === false )
			{
				// no variable found.
				$v->expressions[] = $inputText;
				break;
			}
			else
			{
				$v->expressions[] = substr($inputText,0,$nextVariableMarkerPos);

				$inputText = substr($inputText,$nextVariableMarkerPos+strlen($this->marker)+strlen($this->open));

				$pos = $this->findNextPosOfChar($inputText,$this->close);

				if   ( $pos  === false)
					throw new \RuntimeException('non-closed variable: '.$inputText);

				$vv = substr($inputText,0,$pos);
				$namespace = '';
				$default   = '';

				$prefixSepPos = $this->findNextPosOfChar($vv,$this->namespaceSeparator);
				if   ( $prefixSepPos!==false) {
					$namespace = substr($vv,0,$prefixSepPos);
					$vv        = substr($vv,$prefixSepPos+strlen($this->namespaceSeparator));
				}

				$defaultSepPos = $this->findNextPosOfChar($vv,$this->defaultSeparator);
				if   ( $defaultSepPos!==false) {
					$default = substr($vv,$defaultSepPos+strlen($this->defaultSeparator));
					$vv      = substr($vv, 0,$defaultSepPos);
				}

				$v->expressions[] = new ValueExpression($this->parseToValue($namespace),$this->parseToValue($vv),$this->parseToValue($default));

				$inputText = substr($inputText,$pos+1);
			}

		}

		return $v;
	}


	public function createExpression($namespace, $name, $default='')
	{
		return $this->marker.$this->open.($namespace?$namespace.$this->namespaceSeparator:'').$name.($default?$this->defaultSeparator.$default:'').$this->close;
	}
}

/** Usage: *

$resolver = new VariableResolver();
print_r( $resolver->resolveVariables('Born in the ${bruce:birthcountry}.','bruce',function($name){return 'USA';} ) );
print_r( $resolver->resolveVariables('Born in ${bruce:birthyear:19??}.','bruce',function($name){return '';} ) );
print_r( $resolver->resolveVariables('Born in the ${bruce:birthcountry}.${x:y}${x}','bruce',function($name){return 'USA';} ) );
exit;
*/