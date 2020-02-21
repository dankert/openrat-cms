<?php	
function component_date( $time )
{
	if	( $time==0)
		echo lang('GLOBAL_UNKNOWN');
	else
	{
		// Benutzereinstellung 'Zeitzonen-Offset' auswerten.
		if	( isset($_COOKIE['or_timezone_offset']) )
		{
			$time -= (int)date('Z');
			$time += ((int)$_COOKIE['or_timezone_offset']*60);
		}
	
		echo '<span class="sort-value">'.str_pad($time, 20, "0", STR_PAD_LEFT).'</span>'; // For sorting a table.

		echo '<span title="';
		$dl = date(lang('DATE_FORMAT_LONG'),$time);
		$dl = str_replace('{weekday}',lang('DATE_WEEKDAY'.strval(date('w',$time))),$dl);
		$dl = str_replace('{month}'  ,lang('DATE_MONTH'  .strval(date('n',$time))),$dl);
//		$dl = str_replace(' ','&nbsp;',$dl);
		echo $dl;
		unset($dl);
		
		
		$sekunden = time()-$time;
		$minuten = intval($sekunden/60);
		$stunden = intval($minuten /60);
		$tage    = intval($stunden /24);
		$monate  = intval($tage    /30);
		$jahre   = intval($monate  /12);
		
		echo ' (';
		
		
		if	( $sekunden == 1 )
		echo $sekunden.' '.lang('GLOBAL_SECOND');
		elseif	( $sekunden < 60 )
		echo $sekunden.' '.lang('GLOBAL_SECONDS');
		
		elseif	( $minuten == 1 )
		echo $minuten.' '.lang('GLOBAL_MINUTE');
		elseif	( $minuten < 60 )
		echo $minuten.' '.lang('GLOBAL_MINUTES');
		
		elseif	( $stunden == 1 )
		echo $stunden.' '.lang('GLOBAL_HOUR');
		elseif	( $stunden < 60 )
		echo $stunden.' '.lang('GLOBAL_HOURS');
		
		elseif	( $tage == 1 )
		echo $tage.' '.lang('GLOBAL_DAY');
		elseif	( $tage < 60 )
		echo $tage.' '.lang('GLOBAL_DAYS');
		
		elseif	( $monate == 1 )
		echo $monate.' '.lang('GLOBAL_MONTH');
		elseif	( $monate < 12 )
		echo $monate.' '.lang('GLOBAL_MONTHS');
		
		elseif	( $jahre == 1 )
		echo $jahre.' '.lang('GLOBAL_YEAR');
		else
			echo $jahre.' '.lang('GLOBAL_YEARS');
			
		echo ')';
						
		
		echo '">';
		echo date(lang('DATE_FORMAT'),$time);
		echo '</span>';
	}
}
?>