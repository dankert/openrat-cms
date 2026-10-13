<?php

namespace cms\api;

class Values
{
	public function __construct(

		#[ArrayOf(Value::class)]
		public array $values
	){
	}

}