<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<?php echo Html::form('page','elsave') ?>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th><?php echo $name ?></th>
</tr>
<tr>
  <td class="help"><?php echo $desc ?></th>
</tr>

<tr>
<td class="f1"><?php echo Html::selectBox( 'text',$items,$text,array('onchange'=>'submit();')) ?></td>
</tr>

<?php if	( $release )
      { ?>
<tr>
<td class="f2"><?php echo Html::checkBox('release',true,true) ?> <?php echo lang('GLOBAL_RELEASE') ?></td>
</tr>
<?php } ?>

<tr>
<td class="act"><input type="submit" class="submit" value="<?php echo lang('GLOBAL_SAVE') ?>"></td>
</tr>

</table>

</form>

</center>

<script name="JavaScript" type="text/javascript"><!--
document.forms[0].text.focus();
//--></script>

<?php include( $tpl_dir.'footer.tpl.php') ?>