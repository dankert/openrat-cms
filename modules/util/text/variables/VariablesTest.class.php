<?php

namespace util\text\variables;

use util\test\TestCase;

class VariablesTest extends TestCase {

	public function testResolver() {
		$res = new \util\text\variables\VariableResolver();

		$example = <<<SRC
Hello \${planet:unknown planet}!

Are you ok? My name is \${me.name:unnamed} and robots name is \${me.\${nix.nada:name}}, i was born \${me.date:before some years}.
Message: \${message.somemessage:defaultMessage}
SRC;

		$res->addDefaultResolver( function($x) {return 'world';} );
		$res->addResolver('me', function($t) {if ($t == 'name') return 'alice';return '';});
		$res->addResolver('message', function($t) {return 'this is a message';});

//		echo "Input:\n\n";
//		echo $example."\n\n";
//
//		echo "Output:\n\n";
//		echo $res->resolveVariables( $example )."\n\n";
//
//		echo "Resolver:\n\n";
		//print_r($res);
		$this->assertNotEmpty($res->resolveVariables( $example ) );
	}
}

