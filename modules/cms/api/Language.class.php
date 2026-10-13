<?php

namespace cms\api;

class Language {

	public function __construct(
		public int $id,
		public string $isoCode,
		public string $label,
	)
	{
	}

}
