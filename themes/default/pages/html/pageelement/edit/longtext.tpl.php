<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<form action="<?php echo $form_action ?>" method="post" target="_self">
<input type="hidden" name="<?php echo session_name() ?>" value="<?php echo session_id() ?>">
<input type="hidden" name="pageaction" value="elsave">
<input type="hidden" name="old_pageaction" value="<?php echo $old_pageaction ?>">
<input type="hidden" name="valueid" value="<?php echo $valueid ?>">

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th><?php echo $name ?></th>
</tr>
<tr>
  <td class="help"><?php echo $desc ?><br><br><?php echo lang('HELP_LONGTEXT_WIKI') ?><br></td>
</tr>

<tr>
<td class="f1"><br><textarea class="longtext" name="text"><?php echo $text ?></textarea></td>
</tr>

<tr>
<td class="act"><input type="submit" class="submit" value="<?php echo lang('SAVE') ?>"></td>
</tr>

<!--
<tr>
<td class="help"><?php echo lang('HELP_LONGTEXT_WIKI') ?>
</td>
</tr>
-->

</table>

</form>

</center>

<script name="JavaScript"><!--
document.forms[0].text.focus();
//--></script>

<?php include( $tpl_dir.'footer.tpl.php') ?>