<?php


namespace util;

/**
 * VariableResolver for resolving variables in strings and arrays.
 */

class VariableResolver
{
	public $begin  = '${';
	public $end    = '}';
	public $split  = ':';

	/**
	 * Resolving a variable in a text like 'name is ${env:username:default}.'
	 *
	 * @param $value array
	 * @param $key string
	 * @param $resolver callable
	 * @return array
	 */
	public function resolveVariablesInArray($value,$key,$resolver) {

		return $this->resolveVariablesInArrayWith( $value, [$key=>$resolver] );
	}



	/**
	 * Resolving a variable in a text like 'name is ${env:username:default}.'
	 *
	 * @param $value array
	 * @param $resolvers array List of resolvers
	 * @return array
	 */
	public function resolveVariablesInArrayWith($value,$resolvers) {

		// pass-by-reference
		array_walk_recursive($value, function (&$item, $keyI) use ($resolvers) {

			$item = $this->resolveVariablesWith($item, $resolvers);
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
	public function resolveVariables($value,$key,$resolver)
	{
		return $this->resolveVariablesWith( $value,[$key=>$resolver] );
	}



	/**
	 * Resolving a variable in a text like 'name is ${env:username:default}'.
	 *
	 * @param $value
	 * @param $key
	 * @param $resolver
	 * @return string
	 */
	public function resolveVariablesWith($value, $resolvers)
	{
		$offset = 0;

		while( true )
		{
			if   ( $offset >= strlen($value) )
				return $value;

			$pos = strpos($value, $this->begin, $offset);

			if ($pos === FALSE)
				return $value;


			$posEnd = strpos($value, $this->end, $offset);

			if ($posEnd === FALSE)
				return $value;

			$names = explode( $this->split, substr($value, $pos + strlen($this->begin ), $posEnd - strlen($this->begin) - $pos ));
			$resolverName =  $names[0];
			$key          = @$names[1];
			$default      = @$names[2];

			$varValue = $default;

			if   ( isset( $resolvers[$resolverName] )) {

				$resolverFunction = $resolvers[ $resolverName ];

				if   ( is_callable($resolverFunction ) )
				{
					$result = $resolverFunction($key);

					if   ( $result )
						$varValue = $result;
				}
			}

			$value = substr($value, 0, $pos) . $varValue . substr($value,$posEnd + strlen($this->end));
			$offset = $pos + strlen($varValue);
		}

		return $value;
	}
}

/** Usage: *

$resolver = new VariableResolver();
print_r( $resolver->resolveVariables('Born in the ${bruce:birthcountry}.','bruce',function($name){return 'USA';} ) );
print_r( $resolver->resolveVariables('Born in ${bruce:birthyear:19??}.','bruce',function($name){return '';} ) );
print_r( $resolver->resolveVariables('Born in the ${bruce:birthcountry}.${x:y}${x}','bruce',function($name){return 'USA';} ) );
exit;
*/