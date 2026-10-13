<?php

namespace cms\api;

class Values
{
	#[ArrayOf(Value::class)]
	public array $values;
}