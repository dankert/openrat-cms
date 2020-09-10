<?php

namespace security\test;

use security\Password;
use util\test\TestCase;

class PasswordTest extends TestCase {

	public function testHash() {
		$this->assertEquals("aadce520e20c2899f4ced228a79a3083",Password::hash("wtf",Password::ALGO_MD5));
	}


	public function testCheck() {

		$this->assertEquals( true, Password::check("wtf",'$2y$10$LNY2qCb9elkMe/ITN09cB.6t5QqDzm9Uh9h/LV1I',Password::ALGO_CRYPT) );

		$this->assertEquals( true,Password::check("wtf",'aadce520e20c2899f4ced228a79a3083',Password::ALGO_MD5));
	}
}
