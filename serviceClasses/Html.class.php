<?php


class Html
{
	function selectBox( $name,$values,$default='',$params=Array() )
	{
		$src = '<select size="1" name="'.$name.'"';
		foreach( $params as $name=>$value )
			$src .= " $name=\"$value\"";
		$src .= '>';

		foreach( $values as $key=>$value )
		{
			$src .= '<option value="'.$key.'"';
			if ($key == $default)
				$src .= ' selected="selected"';
			$src .= '>'.$value.'</option>';
		}
		$src .= '</select>';

		return $src;
	}


	function checkBox( $name,$value=false,$writable=true,$params=Array() )
	{
		$src = '<input type="checkbox" name="'.$name.'"';

		foreach( $params as $name=>$val )
			$src .= " $name=\"$val\"";

		if	( !$writable )
			$src .= ' disabled="disabled"';

		if	( $value )
			$src .= ' checked="checked"';

		$src .= ' />';

		return $src;
	}


	function url( $params )
	{
		$url = '';
		foreach( $params as $var=>$value )
		{
			if	( $url == '' )
				$url = '?';
			else	$url .= '&';
			
			$url .= urlencode($var).'='.urlencode($value);
		}
		return 'do.'.CONF_PHP.$url;
	}
}
?>