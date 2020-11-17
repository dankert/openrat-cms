<?php

echo "<html><body>";

ini_set('display_errors', 1);
ini_set('html_errors', 0);
error_reporting(E_ALL & ~E_NOTICE);

require (__DIR__.'/../modules/autoload.php');

$tests = [
	new \util\text\variables\VariablesTest(),
	new \util\test\YAMLTest(),
	new \util\test\MustacheTest(),
	new \security\test\PasswordTest(),
	new \util\test\ClassNameTest(),
];

echo '<h1>Running Tests</h1>';

$success = 0;
$failed  = 0;

foreach( $tests as $test ) {
	$class = new ReflectionClass($test);

	echo '<h2>'.$class->getName().'</h2>';
	$methods = $class->getMethods();
	foreach( $methods as $method ) {
		if   ( strstr($method->getName(),'test') ) {
			echo '<h3>'.$method->getName().'</h3>';
			try {
				$method->invoke($test);
				echo '<span style="color:green">OK</span>';
				$success++;
			}
			catch( \Exception $e ) {
				echo '<strong style="color:red">Test failed: '.$e->getMessage().'</strong>';
				echo '<pre style="background-color:red">'.$e->getTraceAsString().'</pre>';
				$failed++;
			}
		}
	}


}

echo "<h1>Summary</h1>".($success+$failed).' Tests, '.$success.' success, '.$failed.' failed';

echo '<p><strong>'.(($failed==0)?"ALL TESTS OK":"THERE ARE TEST FAILURES").'</strong></p>';

echo "</body></html>";