<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<form action="<?php echo $self ?>" method="post" target="_self">
<input type="hidden" name="action" value="page">
<input type="hidden" name="subaction" value="elsave">
<input type="hidden" name="old_pageaction" value="<?php echo $old_pageaction ?>">

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th><?php echo $name ?></th>
</tr>
<tr>
  <td class="help"><?php echo $desc ?></th>
</tr>

<tr>
<td class="f1"><?php echo Html::selectBox( 'linkobjectid',$objects,$act_linkobjectid,array('onchange'=>'submit();')) ?></td>
</tr>

<?php if	( $release )
      { ?>
<tr>
<td class="f2"><?php echo Html::checkBox('release',true,true) ?> <?php echo lang('RELEASE') ?></td>
</tr>
<?php } ?>

<tr>
<td class="act"><noscript><input type="submit" class="submit" value="<?php echo lang('SAVE') ?>"></noscript></td>
</tr>

</table>

</form>

</center>

<?php include( $tpl_dir.'footer.tpl.php') ?>