<?php

namespace cms\api;

class TraceElement
{
	public function __construct (
		public string $file,
		public int $line,
		public string $function,
		public string $class,
	){
	}

}