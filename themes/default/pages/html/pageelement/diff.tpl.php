<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('GLOBAL_COMPARE').' '.$title1 ?></th>
  <th colspan="2"><?php echo lang('GLOBAL_WITH')   .' '.$title2 ?></th>
</tr>


<?php $fx = fx('');
      if (count($text1) > 0)
      {
      	$i=0;
      	while( isset($text1[$i]) || isset($text2[$i]) )
      	{
      		$fx = fx($fx);
      		?>
      		<tr>

      		<?php
      		if	( isset($text1[$i]['text']) )
      		{
      			?>
				<td class="<?php echo $fx ?>" width="5%" ><?php echo $text1[$i]['line'] ?></td>
				<td class="diff_<?php echo $text1[$i]['type'] ?>" width="45%"><?php echo $text1[$i]['text'] ?></td>
      			<?php
      		}
      		else
      		{
      			?>
      			<td colspan="2" class="help" with="50%">&nbsp;</td>
      			<?php
      		}

      		if	( isset($text2[$i]['text']) )
      		{
      			?>
				<td class="<?php echo $fx ?>" width="5%" ><?php echo $text2[$i]['line'] ?></td>
				<td class="diff_<?php echo $text2[$i]['type'] ?>" width="45%"><?php echo $text2[$i]['text'] ?></td>
      			<?php
      		}
      		else
      		{
      			?>
      			<td colspan="2" class="help" with="50%">&nbsp;</td>
      			<?php
      		}
      		?>
      		</tr>
      		<?php
      		$i++;
		}
      }
      else
      { ?>
<tr>
  <td class="f1" colspan="4"><strong><?php echo lang('GLOBAL_NO_DIFFERENCES_FOUND') ?></strong></td>
</tr>
<?php } ?>

</table>

</center>

<br/><br/><br/>
<?php include( $tpl_dir.'footer.tpl.php') ?>