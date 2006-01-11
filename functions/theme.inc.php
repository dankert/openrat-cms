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
		return lang('GLOBAL_UNKNOWN');

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


function windowOpen( $title,$objectName='',$icon='',$attr=array() )
{
	global $image_dir;
	global $windowMenu;
	global $actionName;
	if	( !isset($attr['width'])) $attr['width']='90%';
	echo '<br/><br/><br/><center>';
	echo '<table class="main" cellspacing="0" cellpadding="4" ';
	foreach( $attr as $aName=>$aValue )
		echo " $aName=\"$aValue\"";
	echo '>';
	echo '<tr><th>';
	if	( !empty($icon) )
		echo '<img src="'.$image_dir.'icon_'.$icon.IMG_EXT.'" align="left" border="0">';
	echo $objectName.': ';
	echo lang( $title );
	echo <<<EOF
    </th>
  </tr>
EOF
;
?>
  <tr><td class="subaction">
    <?php foreach( $windowMenu as $action )
          {
          	?><a href="<?php echo Html::url($actionName,$action['subaction']) ?>"><?php echo lang('global_'.$action['text']) ?></a> <?php
          }
          	?></td>
  </tr>
<?php

	echo <<<EOF
	  <tr>
    <td>
      <table class="n" cellspacing="0" width="100%" cellpadding="4">
EOF
;
	echo '';
}


function windowClose()
{
	echo <<<EOF
      </table>
	</td>
  </tr>
</table>

</center>
EOF
;
}

?>