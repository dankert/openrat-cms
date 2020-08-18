<?php	
function component_date( $time )
{
	if	( $time==0)
		echo lang('UNKNOWN');
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
		$dl = lang('DATE_FORMAT_LONG');
		$dl = str_replace('{weekday}',addcslashes(lang('DATE_WEEKDAY'.strval(date('w',$time))),'A..z'),$dl);
		$dl = str_replace('{month}'  ,addcslashes(lang('DATE_MONTH'  .strval(date('n',$time))),'A..z'),$dl);
		$dl = date( $dl,$time );
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
		echo $sekunden.' '.lang('SECOND');
		elseif	( $sekunden < 60 )
		echo $sekunden.' '.lang('SECONDS');
		
		elseif	( $minuten == 1 )
		echo $minuten.' '.lang('MINUTE');
		elseif	( $minuten < 60 )
		echo $minuten.' '.lang('MINUTES');
		
		elseif	( $stunden == 1 )
		echo $stunden.' '.lang('HOUR');
		elseif	( $stunden < 60 )
		echo $stunden.' '.lang('HOURS');
		
		elseif	( $tage == 1 )
		echo $tage.' '.lang('DAY');
		elseif	( $tage < 60 )
		echo $tage.' '.lang('DAYS');
		
		elseif	( $monate == 1 )
		echo $monate.' '.lang('MONTH');
		elseif	( $monate < 12 )
		echo $monate.' '.lang('MONTHS');
		
		elseif	( $jahre == 1 )
		echo $jahre.' '.lang('YEAR');
		else
			echo $jahre.' '.lang('YEARS');
			
		echo ')';
						
		
		echo '">';
		echo date(lang('DATE_FORMAT'),$time);
		echo '</span>';
	}
}
?>