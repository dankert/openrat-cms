<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->

<center>

<form action="<?php echo $self ?>" method="post" target="_self">
<input type="hidden" name="<?php echo session_name() ?>" value="<?php echo session_id() ?>">
<input type="hidden" name="subaction" value="save">

<table class="main" width="90%" cellspacing="0" cellpadding="4">

  <tr>
    <th colspan="2"><?php echo lang('GLOBAL_GROUP') ?></th>
  </tr>

  <tr>
    <td width="50%" class="f1"><?php echo lang('GLOBAL_NAME') ?></a></td>
    <td width="50%" class="f1"><input type="text" name="name" value="<?php echo $name ?>"></td>
  </tr>

  <tr>
    <td class="f1" rowspan="2"><?php echo lang('GLOBAL_DELETE') ?></a></td>
    <td class="f1"><input type="checkbox" name="delete" value="1"></td>
  </tr>
  <tr>
    <td class="help"><?php echo lang('GROUP_DELETE_DESC') ?></td>
  </tr>

  <tr>
    <td class="act" colspan="2"><input type="submit" class="submit" value="<?php echo lang('GLOBAL_SAVE') ?>"></td>
  </tr>

</table>

</form>

<script name="JavaScript" type="text/javascript"><!--
document.forms[0].name.focus();
//--></script>

</center>
<?php include( $tpl_dir.'footer.tpl.php') ?>