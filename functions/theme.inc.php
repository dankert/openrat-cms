<?php


// Ausgabe CSS-Klasse pro Zeile
function fx( $fx )
{
	if   ( $fx == 'f1' )
		return 'f2';
	else return 'f1';
}



function nice_date( $time )
{
	if	( $time==0)
		return ang('GLOBAL_UNKNOWN');

	$sekunden = time()-$time;
	$minuten = intval($sekunden/60);
	$stunden = intval($minuten /60);
	$tage    = intval($stunden /24);
	$monate  = intval($tage    /30);
	$jahre   = intval($monate  /12);
	
	if	( $sekunden == 1 )
		return $sekunden.' '.lang('GLOBAL_SECOND');
	if	( $sekunden < 60 )
		return $sekunden.' '.lang('GLOBAL_SECONDS');

	if	( $minuten == 1 )
		return $minuten.' '.lang('GLOBAL_MINUTE');
	if	( $minuten < 60 )
		return $minuten.' '.lang('GLOBAL_MINUTES');

	if	( $stunden == 1 )
		return $stunden.' '.lang('GLOBAL_HOUR');
	if	( $stunden < 60 )
		return $stunden.' '.lang('GLOBAL_HOURS');

	if	( $tage == 1 )
		return $tage.' '.lang('GLOBAL_DAY');
	if	( $tage < 60 )
		return $tage.' '.lang('GLOBAL_DAYS');

	if	( $monate == 1 )
		return $monate.' '.lang('GLOBAL_MONTH');
	if	( $monate < 12 )
		return $monate.' '.lang('GLOBAL_MONTHS');

	if	( $jahre == 1 )
		return $jahre.' '.lang('GLOBAL_YEAR');

	return $jahre.' '.lang('GLOBAL_YEARS');
	


//	return date(lang('DATE_FORMAT'),$time);
}


function windowOpen( $title,$colSpan=2,$icon='',$attr=array() )
{
	global $image_dir;
	if	( !isset($attr['width'])) $attr['width']='90%';
	echo '<center>';
	echo '<table style="margin:20px;" cellspacing="0" cellpadding="0"';
	foreach( $attr as $aName=>$aValue )
		echo " $aName=\"$aValue\"";
	echo '>';
	echo '<tr><td colspan="2" rowspan="2">';
	echo '<table class="main" cellspacing="0" width="100%" cellpadding="4">';
	echo '<tr><th colspan="'.intval($colSpan).'">';
	if	( !empty($icon) )
		echo '<img src="'.$image_dir.'icon_'.$icon.IMG_EXT.'" align="left" border="0">';
	echo lang( $title ).'</th></tr>';
}

function windowClose()
{
	echo '<tr><td>&nbsp;</td></tr>';
	echo '</table>';
	echo '</td><td style="width:5px;height:5px;"></td></tr>';	
	echo '<tr><td rowspan="2" style="background-color:grey; width:5px;"></td></tr>';
	echo '<tr><td style="width:5px;height:5px;"></td><td style="background-color:grey; height:5px;"></td></tr>';
	echo '</table>';

	echo '</center>';
}

?>