<?php
namespace dsl\standard;

class StandardDate
{
	/**
	 * Date.now()
	 *
	 * milliseconds since 1970.
	 *
	 * @return int
	 */
	public function now() {

		return time();
	}
}