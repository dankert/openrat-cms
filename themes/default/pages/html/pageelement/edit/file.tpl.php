<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<form action="<?php echo $form_action ?>" method="post" target="_self">
<input type="hidden" name="<?php echo session_name() ?>" value="<?php echo session_id() ?>">
<input type="hidden" name="subaction" value="elsave">
<input type="hidden" name="old_pageaction" value="<?php echo $old_pageaction ?>">
<input type="hidden" name="valueid" value="<?php echo $valueid ?>">

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th><?php echo $name ?></th>
</tr>
<tr>
  <td class="help"><?php echo $desc ?></th>
</tr>

<tr>
<td class="f1"><?php echo Html::selectBox( 'linkobjectid',$files,$act_objectid,array('onchange'=>'submit();')) ?></td>
</tr>

<tr>
<td class="act"><noscript><input type="submit" class="submit" value="<?php echo lang('SAVE') ?>"></noscript></td>
</tr>

</table>

</form>

</center>

<?php include( $tpl_dir.'footer.tpl.php') ?>