<?php

namespace cms\api;

class Exception
{
	public function __construct (
		public string $error,
		public string $description,
		public int $code,
		#[ArrayOf(TraceElement::class)]
		public array $trace,
		public Exception|null $cause,
	){
	}

}