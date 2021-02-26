<?php


namespace cms\generator\filter;


interface Filter
{
	/**
	 * Filtering a value.
	 *
	 * @param $value string
	 * @return string
	 */
	public function filter( $value );
}