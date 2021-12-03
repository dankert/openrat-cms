<?php

use cms\action\Action;
use language\Messages;
use util\Cookie;
use template_engine\Output;

function component_date($time )
{
	if	( $time==0)
		echo Output::lang(Messages::UNKNOWN );
	else
	{
		// Benutzereinstellung 'Zeitzonen-Offset' auswerten.
		if	( Cookie::has(Action::COOKIE_TIMEZONE_OFFSET) )
		{
			$time -= (int)date('Z');
			$time += ( ((int)Cookie::get(Action::COOKIE_TIMEZONE_OFFSET))*60);
		}
	
		echo '<span class="or-table-sort-value">'.str_pad($time, 20, "0", STR_PAD_LEFT).'</span>'; // For sorting a table.

		echo '<time title="';
		$dl = Output::lang(Messages::DATE_FORMAT_LONG);
		$dl = str_replace('{weekday}',addcslashes(Output::lang('DATE_WEEKDAY'.strval(date('w',$time))),'A..z'),$dl);
		$dl = str_replace('{month}'  ,addcslashes(Output::lang('DATE_MONTH'  .strval(date('n',$time))),'A..z'),$dl);
		$dl = date( $dl,$time );
		echo $dl;
		unset($dl);
		
		
		$past = abs(time()-$time );

		$units = [
			[  60, Messages::SECOND, Messages::SECONDS ],
			[  60, Messages::MINUTE, Messages::MINUTES ],
			[  24, Messages::HOUR  , Messages::HOURS   ],
			[  30, Messages::DAY   , Messages::DAYS    ],
			[  12, Messages::MONTH , Messages::MONTHS  ],
			[ 999, Messages::YEAR  , Messages::YEARS   ],
		];

		echo ' (';
		
		foreach ( $units as $unit ) {
			if	( $past == 1 ) {
				echo $past.' '.Output::lang($unit[1] );
				break;
			}
			elseif	( $past < $unit[0] ) {
				echo $past.' '.Output::lang( $unit[2] );
				break;
			}
			else {
				$past = intval( $past / $unit[0] );
				continue;
			}
		}

		echo ')"';

		echo ' datetime="'.date('c',$time).'"';

		echo '>';
		$format = (\cms\base\Startup::getStartTime()-$time)>(60*60*24)?Messages::DATE_FORMAT:Messages::DATE_FORMAT_TODAY;
		echo date( Output::lang($format),$time );
		echo '</time>';
	}
}
