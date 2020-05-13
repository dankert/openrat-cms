<?php

require_once('../../../autoload.php');

header('Content-Type: text/plain');
set_time_limit(2);

$res = new \util\text\variables\VariableResolver();

$example = 'Hello ${planet:unknown planet}! Are you ok? My name is ${me.name:unnamed} and robots name is ${me.${nix.nada:name}}, i was born ${me.date:before some years}';
#$example = 'Hello ${planet:unknown planet}! Are you ok? My name is ${me.name:unnamed}. I was born ${me.date:before some years}.';
$res->addDefaultResolver( function($x) {return 'world';} );
$res->addResolver('me', function($t) {if ($t == 'name') return 'alice';return '';});

echo 'result: '.$res->resolveVariables( $example );
echo "\n\n";
print_r($res);