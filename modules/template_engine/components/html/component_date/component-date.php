<?php	
function component_date( $time )
{
	if	( $time==0)
		echo \cms\base\Language::lang('UNKNOWN');
	else
	{
		// Benutzereinstellung 'Zeitzonen-Offset' auswerten.
		if	( isset($_COOKIE['or_timezone_offset']) )
		{
			$time -= (int)date('Z');
			$time += ((int)$_COOKIE['or_timezone_offset']*60);
		}
	
		echo '<span class="or-table-sort-value">'.str_pad($time, 20, "0", STR_PAD_LEFT).'</span>'; // For sorting a table.

		echo '<span title="';
		$dl = \cms\base\Language::lang('DATE_FORMAT_LONG');
		$dl = str_replace('{weekday}',addcslashes(\cms\base\Language::lang('DATE_WEEKDAY'.strval(date('w',$time))),'A..z'),$dl);
		$dl = str_replace('{month}'  ,addcslashes(\cms\base\Language::lang('DATE_MONTH'  .strval(date('n',$time))),'A..z'),$dl);
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
		echo $sekunden.' '.\cms\base\Language::lang('SECOND');
		elseif	( $sekunden < 60 )
		echo $sekunden.' '.\cms\base\Language::lang('SECONDS');
		
		elseif	( $minuten == 1 )
		echo $minuten.' '.\cms\base\Language::lang('MINUTE');
		elseif	( $minuten < 60 )
		echo $minuten.' '.\cms\base\Language::lang('MINUTES');
		
		elseif	( $stunden == 1 )
		echo $stunden.' '.\cms\base\Language::lang('HOUR');
		elseif	( $stunden < 60 )
		echo $stunden.' '.\cms\base\Language::lang('HOURS');
		
		elseif	( $tage == 1 )
		echo $tage.' '.\cms\base\Language::lang('DAY');
		elseif	( $tage < 60 )
		echo $tage.' '.\cms\base\Language::lang('DAYS');
		
		elseif	( $monate == 1 )
		echo $monate.' '.\cms\base\Language::lang('MONTH');
		elseif	( $monate < 12 )
		echo $monate.' '.\cms\base\Language::lang('MONTHS');
		
		elseif	( $jahre == 1 )
		echo $jahre.' '.\cms\base\Language::lang('YEAR');
		else
			echo $jahre.' '.\cms\base\Language::lang('YEARS');
			
		echo ')';
						
		
		echo '">';
		echo date(\cms\base\Language::lang('DATE_FORMAT'),$time);
		echo '</span>';
	}
}
?>