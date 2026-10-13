<?php

namespace cms\api;

class Element {

	public function __construct(

		public int $id,

		public string $name,
		public string $label,
		public string $description,

		public string $type,
		public int $typeId,
)
	{
	}

}
