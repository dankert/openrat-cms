<?php


namespace util\text;


use util\Text;
use util\text\variables\VariableResolver;

class TextMessage
{
	/**
	 * Creates a text message with variables.
	 *
	 * @param $text
	 * @param array $params
	 * @return string
	 */
	public static function create( $text, $params=[] ) {
		if   ( $params) {
			$resolver = new VariableResolver();
			$resolver->addDefaultResolver( function($key) use ($params) {
				return TextMessage::sanitizeInput( @$params[$key] );
			});
			return $resolver->resolveVariables($text);
		}
		else {
			// no params, so no resolver needed
			return $text;
		}
	}


	public static function sanitizeInput( $input ) {
		$white = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789.,_-';
		$clean = Text::clean($input,$white);
		return "'".$clean."'".(strlen($input)>strlen($clean)?'(!)':'');
	}

}