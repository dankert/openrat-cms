<?php

namespace util\test;

use util\ClassName;
use util\YAML;

class ClassNameTest extends TestCase {

	public function testShortName()
	{
		$classname = new ClassName( 'cms\action\page\PageShowAction');

		$this->assertEquals( 'PageShowAction',$classname->dropNamespace()->get() );
		$this->assertEquals( 'PageShow',$classname->dropSuffix('Action')->get() );
	}


	public function testParent()
	{
		$classname = (new ClassName( 'PageShowAction'))->addNamespace(['cms','action','page']);

		$this->assertEquals( true,$classname->getParent()->exists() );
		$this->assertEquals( 'cms\action\PageAction',$classname->get() );
		$this->assertEquals( true,$classname->getParent()->exists() );
		$this->assertEquals( 'cms\action\ObjectAction',$classname->get() );
		$this->assertEquals( true,$classname->getParent()->exists() );
		$this->assertEquals( 'cms\action\BaseAction',$classname->get() );
		$this->assertEquals( true,$classname->getParent()->exists() );
		$this->assertEquals( 'cms\action\Action',$classname->get() );
		$this->assertEquals( false,$classname->getParent()->exists() );
		$this->assertEquals( false,$classname->get() );
	}
}



