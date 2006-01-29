page
	form
		window name:element
			row
				cell colspan:2 class:help
					text var:desc
RAW
<tr>
  <th colspan="7"><?php echo $name ?> (<?php echo $title ?>)</th>
</tr>

<?php

	echo '<tr>';
	for  ( $wday=0; $wday<=6; $wday++ )
	{
		echo '<td class="help">'.lang('DATE_WEEKDAY'.$wday).'</th>';
	}
	echo '</tr>';

	$d = 0;
	$begin = false;
	do
	{
		echo '<tr>';
		for  ( $wday=0; $wday<=6; $wday++ )
		{
			
			if   (!$begin)
			{
				if   ($wday == $first_weekday)
				{
					$begin = true;
				}
			}
			
			if   ($begin && $d < $days )
			{
				echo '<td class="f1">';
				
				$d++;
				if   ($d == $day)
					echo "<strong>$d</strong>";
				else echo '<a href="'.Html::url('pageelement','edit','-',array('year'=>$year,'month'=>$month,'day'=>$d,'hour'=>$hour,'minute'=>$minute,'second'=>$second)).'">'.$d.'</a>';
				echo '</td>';
			}
			else echo '<td></td';
		}
		echo '</tr>';
	}
	while( $d < $days-1 )
?>



<tr>
<?php
	$lastyear  = $year-1;
	echo '<td colspan="3"><a href="'.Html::url('pageelement','edit','-',array('year'=>$lastyear,'month'=>$month,'day'=>$day,'hour'=>$hour,'minute'=>$minute,'second'=>$second)).'">'.lang('DATE_LAST_YEAR').'</a>&nbsp;&laquo;&nbsp;';

	$lastyear  = $year;
	$lastmonth = $month - 1;

	if   ( $lastmonth == 0 )
	{
		$lastyear--;
		$lastmonth = 12;
	}
	echo '&nbsp;&nbsp;<a href="'.Html::url('pageelement','edit','-',array('year'=>$lastyear,'month'=>$lastmonth,'day'=>$day,'hour'=>$hour,'minute'=>$minute,'second'=>$second)).'">'.lang('DATE_LAST_MONTH').'</a>&nbsp;&laquo;&nbsp;</td>';

	// Link auf heutiges Datum
	echo '<td style="text-align:center"><a href="'.$todayurl.'">'.lang('DATE_TODAY').'</a></td>';

	$nextyear  = $year;
	$nextmonth = $month + 1;

	if   ( $nextmonth == 13 )
	{
		$nextyear++;
		$nextmonth = 1;
	}
	echo '<td colspan="3" style="text-align:right">&raquo;&nbsp;<a href="'.Html::url('pageelement','edit','-',array('year'=>$lastyear,'month'=>$nextmonth,'day'=>$day,'hour'=>$hour,'minute'=>$minute,'second'=>$second)).'">'.lang('DATE_NEXT_MONTH').'</a>';

	$nextyear  = $year+1;
	echo '&nbsp;&nbsp;&raquo;&nbsp;<a href="'.Html::url('pageelement','edit','-',array('year'=>$nextyear,'month'=>$month,'day'=>$day,'hour'=>$hour,'minute'=>$minute,'second'=>$second)).'">'.lang('DATE_NEXT_YEAR').'</a></td>';
?>

</tr>
END

			if present:release
				row
					cell colspan:2 class:fx
						checkbox name:release
						text raw:_
						text text:GLOBAL_RELEASE

			if present:publish
				row
					cell colspan:2 class:fx
						checkbox name:publish
						text raw:_
						text text:PAGE_PUBLISH_AFTER_SAVE

			row
				cell colspan:2 class:act
					button type:ok

	focus field:text

