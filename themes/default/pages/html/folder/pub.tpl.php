<?php include( $tpl_dir.'header.tpl.php') ?>

<center>

<form action="<?php echo $self ?>" method="post" target="_self">

<input type="hidden" name="<?php echo session_name() ?>" value="<?php echo session_id() ?>">
<input type="hidden" name="subaction" value="pub">
<input type="hidden" name="go" value="1">

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('PUBLISH') ?></th>
</tr>

<tr>
<td width="50%" class="f1"><input type="checkbox" name="pages" value="1" checked="checked"><?php echo lang('pages') ?><br>
                           <input type="checkbox" name="files" value="1" checked="checked"><?php echo lang('files') ?></td>
<td width="50%" class="f1"><input type="checkbox" name="subdirs" value="1"><?php echo lang('PUBLISH_WITH_SUBDIRS') ?></td>
</tr>

<tr>
<td class="act" colspan="2"><input type="submit"  class="submit" value="<?php echo lang('PUBLISH') ?>"></td>
</tr>

</table>

</form>


</center>

<script name="JavaScript" type="text/javascript"><!--
document.forms[0].subdirs.focus();
//--></script>

<?php include( $tpl_dir.'footer.tpl.php') ?>