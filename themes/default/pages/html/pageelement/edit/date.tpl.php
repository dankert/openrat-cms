<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<?php echo Html::form('page','elsave') ?>


<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="7"><?php echo $name ?> (<?php echo $title ?>)</th>
</tr>

<tr>
  <td colspan="7" class="help"><?php echo $desc ?><br><br></td>
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

<tr>
<td class="help" colspan="7"><br><?php echo lang('HELP_DATE') ?>:</td>
</tr>

<tr>
<td class="f2" colspan="1"><?php echo lang('DATE') ?>
<td class="f2" colspan="4">
<?php echo Html::selectBox('year' ,$all_years ,$year ) ?>&nbsp;<strong>-</strong>&nbsp;
<?php echo Html::selectBox('month',$all_months,$month) ?>&nbsp;<strong>-</strong>&nbsp;
<?php echo Html::selectBox('day'  ,$all_days  ,$day  ) ?>
</td><td class="f1" colspan="2">&nbsp;
</td>
</tr>

<tr>
<td class="f1"><?php echo lang('DATE_TIME') ?>
<td class="f1" colspan="4">
<?php echo Html::selectBox('hour'  ,$all_hours   ,$hour  ) ?>&nbsp;:&nbsp;
<?php echo Html::selectBox('minute',$all_minutes ,$minute) ?>&nbsp;:&nbsp;
<?php echo Html::selectBox('second',$all_seconds ,$second) ?>
</td><td class="f1" colspan="2">&nbsp;
<!--<noscript><input type="submit" class="submit" value="<?php echo lang('REFRESH') ?>"></noscript>-->
</td>
</tr>

<tr>
<td class="help" colspan="7"><?php echo lang('HELP_DATE_ANSIDATE') ?>:</td>
</tr>
<tr>
<td class="f2"><?php echo lang('DATE_ANSI') ?>
<td class="f2" colspan="4"><input type="text" name="ansidate" class="ansidate" width="25" maxlength="25" value="<?php echo $ansidate ?>">
                           <input type="hidden" name="ansidate_orig" value="<?php echo $ansidate ?>">
</td><td class="f1" colspan="2">&nbsp;
</td>
</tr>

<?php if	( $release )
      { ?>
<tr>
<td class="f2"><?php echo Html::checkBox('release',true,true) ?> <?php echo lang('GLOBAL_RELEASE') ?></td>
</tr>
<?php } ?>
<?php if	( $publish )
      { ?>
<tr>
  <td class="f2"><?php echo Html::checkBox('publish',false) ?> <?php echo lang('PAGE_PUBLISH_AFTER_SAVE') ?></td>
</tr>
<?php } ?>

<tr>
<td class="act" colspan="7"><?php echo lang('DATE').': <strong>'.$actdate ?></strong><br><br>
<!--<input type="hidden" name="date" value="<?php echo $date ?>">-->
<input type="submit" class="submit" value="<?php echo lang('GLOBAL_SAVE') ?>"></td>
</tr>

</table>

</form>

</center>

<?php Html::focusField('ansidate') ?>

<?php include( $tpl_dir.'footer.tpl.php') ?>