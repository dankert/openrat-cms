<?php

namespace cms\api;

use cms\base\Language as L;

/**
 * Notice to tell about something.
 */
class Notice
{
	public function __construct (
			/** Object type */
			public string $type,
			/**
			 * ID of the object
			 */
			public int $id,
			/**
			 * Name of the object
			 */
			public string $name,
			public string $key,
			public array $vars,
			public string $text,
			public array $log,
			public string $status,
	){
	}

}