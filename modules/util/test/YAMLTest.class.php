<?php

namespace util\test;

use util\YAML;

class YAMLTest extends TestCase {

	public function testYAMLParser()
	{

		$yaml = <<<EOF
test : 'blabla'
a: '\\n\i\x\\nnux'
EOF;

		$arr = YAML::parse($yaml);
		$this->assertEquals('blabla', $arr['test']);
	}
}



