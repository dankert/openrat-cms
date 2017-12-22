<?php

header('Content-Type: text/plain');

include('../modules/util/Spyc.class.php');

$lang = Spyc::YAMLLoad('../language/language.yml');

foreach( explode(',','de,en,es,fr,it,ru,cn') as $iso )
{
	$filename = '../language/lang-'.$iso.'.php';
	file_put_contents($filename, "<?php /* DO NOT CHANGE THIS GENERATED FILE */\n");
	foreach( $lang as $key=>$value )
	{
		if	( isset($value[$iso] ) )
			$t = $value[$iso];
		else
			$t = $value['en'];
		$t = str_replace('"','\"',$t);
		file_put_contents($filename, "\$lang['$key']=\"$t\";\n",FILE_APPEND);
	}
	$success = file_put_contents($filename, "?>",FILE_APPEND);

	if($success)
		echo "File written: $filename\n";
	else
	    die("Failed write to $filename\n");
}

?>