<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<form action="<?php echo $self ?>" method="post" target="_self">

<input type="hidden" name="action"    value="page"    />
<input type="hidden" name="subaction" value="saveform"/>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="4"><?php echo lang('ELEMENTS') ?></th>
</tr>

<?php if ( count($el) > 0 )
      { ?>
<tr>
  <td class="help"><?php echo lang('PAGE_ELEMENT_NAME') ?></td>
  <td class="help"><?php echo lang('GLOBAL_CHANGE') ?></td>
  <td class="help"><?php echo lang('GLOBAL_VALUE') ?></td>
</tr>

<?php $f1=true;
      $tabindex=0;
      $firstId = 0;
      foreach( $el as $id=>$e )
      {
      	$onchange = "window.document.forms[0].elements['saveid".$id."'].checked=true;";
      	if	( $firstId == 0 )
      		$firstId = $id;
      	$fx = fx($f1);
      	?>
<tr>
<td width="30%" class="<?php echo $fx ?>"><img src="<?php echo $image_dir.'icon_el_'.$e['type'].'.png' ?>" border="0" align="left"><?php echo $e['name'] ?></td>
<td width="5%" class="<?php echo $fx ?>"><input type="checkbox" name="saveid<?php echo $id ?>" value="1" /> </td>
<td width="65%" class="<?php echo $fx ?>">

<?php switch($e['type'])
      {
      	case 'text':
      	case 'date':
      	case 'number':
      		?>
      		<input tabindex="<?php echo ++$tabindex ?>" type="text" name="id<?php echo $id ?>" value="<?php echo $e['value'] ?>" size="40" maxlength="255" onchange="<?php echo $onchange ?>" />
      		<?php
      		break;
      	case 'longtext':
      		?>
      		<textarea tabindex="<?php echo ++$tabindex ?>" name="id<?php echo $id ?>" rows="7" cols="50" onchange="<?php echo $onchange ?>"><?php echo $e['value'] ?></textarea>
      		<?php
      		break;
      	case 'select':
      	case 'link':
      	case 'list':
			echo Html::selectBox( 'id'.$id,$e['list'],$e['value'],array('tabindex'=>++$tabindex,'onchange'=>$onchange) );
      		break;
      }
      ?>
&nbsp;</td>
</tr>
<?php } ?>

<?php if	( isset($release) || true )
      { ?>
<tr>
<td class="<?php echo $fx ?>&nbsp;</td>
<td class="<?php echo $fx ?> colspan="2"><?php echo Html::checkBox('release',true,true) ?> <?php echo lang('GLOBAL_RELEASE') ?></td>
</tr>
<?php } ?>

<tr>
  <td class="act" colspan="4"><input type="submit" value="<?php echo lang('GLOBAL_SAVE') ?>" class="submit" /></td>
</tr>


<?php }
      else
      { ?>
<tr>
<td colspan="4" class="f1"><strong><?php echo lang('GLOBAL_NOT_FOUND') ?></strong></td>
</tr>
<?php } ?>


</table>

</form>

</center>

<script name="JavaScript" type="text/javascript"><!--
document.forms[0].id<?php echo $firstId ?>.focus();
//--></script>

<?php include( $tpl_dir.'footer.tpl.php') ?>