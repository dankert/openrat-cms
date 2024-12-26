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

		$this->assertNotEmpty($res->resolveVariables( $example ) );
	}


	/**
	 * Test variables with a prefix.
	 */
	public function testNamespaced() {

		$resolver = new VariableResolver();
		$resolver->addDefaultResolver( function($key) { return 'default'; } );
		$resolver->addResolver( 'name', function($key) { return 'me'; } );
		$resolver->addResolver( 'cms', function($key) { return 'orcms'; } );

		$this->assertEquals( 'default',$resolver->resolveVariables('${x}') );
		$this->assertEquals( 'me',$resolver->resolveVariables('${name.x}') );
		$this->assertEquals( 'orcms',$resolver->resolveVariables('${cms.x}') );
	}

	public function testSpecials() {

		$resolver = new VariableResolver();
		$resolver->addDefaultResolver( ['0','1','2',''=>'space','name'=>'name'] );

		$resolver->marker = '';

		$resolver->parseString('a{0}b');

		$this->assertEquals( 'name',$resolver->resolveVariables('{name}') );
		$this->assertEquals( 'space',$resolver->resolveVariables('{}') );
		$this->assertEquals( '2',$resolver->resolveVariables('{2}') );
		$this->assertEquals( '1',$resolver->resolveVariables('{1}') );
		$this->assertEquals( '0',$resolver->resolveVariables('{0}') );
	}
}

