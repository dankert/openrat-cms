<?php

header('Content-Type: text/plain');



// error_reporting(E_ALL);
// 	$oldlang = parse_ini_file('../language/es.ini.php');
// var_dump($oldlang);
// exit;



include('../util/Spyc.class.php');

$lang = array();

foreach( explode(',','de,en,es,fr,it,ru,cn') as $iso )
{
	$oldlang = parse_ini_file('../language/'.$iso.'.ini.php');
	//echo "ISO: $iso -Size:".count($oldlang)."\n";
	
	foreach( $oldlang as $key=>$value )
	
	{
		$value = trim($value," '\"");
		if	(empty($value))
			continue;
		
		if	( @$lang[$key]['en'] == $value )
			continue;
		
		$lang[$key][$iso] = $value;
	}
	
}

echo Spyc::YAMLDump($lang, false, 0, true);

// file_put_contents('../language/language.yml',spyc_dump($lang));

?>