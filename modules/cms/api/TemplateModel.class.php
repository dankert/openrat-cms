<?php

namespace cms\api;

class TemplateModel {

	public function __construct(

	public int $id,
	public string $name,
	public string $source,
	public string $format,
	){}
}
