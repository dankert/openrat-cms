<?php

namespace util\test;

use util\text\TextMessage;
use util\YAML;

class TextMessageTest extends TestCase {

	public function testMessage()
	{
		$abc = TextMessage::create('abc ${text}',['text'=>'def']);

		$this->assertEquals('abc \'def\'',$abc);
	}

	public function testMessageNumberedIndex()
	{
		$abc = TextMessage::create('abc ${0}',['def']);

		$this->assertEquals('abc \'def\'',$abc);
	}

	public function testSanitizer()
	{
		$abc = TextMessage::create('abc ${0}',['def/']);

		$this->assertEquals('abc \'def\'(!)',$abc);
	}
}



