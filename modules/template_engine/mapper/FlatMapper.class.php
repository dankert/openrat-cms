<?php

namespace template_engine\mapper;

use util\ArrayUtils;

/**
 * creates a UI-ready flat array from a deep array.
 */
class FlatMapper implements Mapper
{
	public function map( $arr)
	{
		$pad = str_repeat("\xC2\xA0",10); // Hard spaces

		return array_map( function($value) use($pad) {
			return [
				'key'   => implode('.',($value['path'])),
				'label' => str_repeat( $pad ,sizeof($value['path'])).end($value['path']),
				'value' => $value['value']
			];
		}, ArrayUtils::flatArray( $arr ) );
	}
}