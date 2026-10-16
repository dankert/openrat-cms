<?php

namespace cms\api;

class Session
{
	public function __construct (
		public string $name,
		public string $id,
		public string $token,
	){
	}

}