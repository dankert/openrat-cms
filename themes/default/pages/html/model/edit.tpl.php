<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<form action="<?php echo $self ?>" method="post" target="_self">

<input type="hidden" name="subaction" value="save">

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('MODEL') ?></a></th>
</tr>

<tr>
<td width="50%" class="f1"><?php echo lang('NAME') ?></td>
<td width="50%" class="f1"><input type="text" name="name" value="<?php echo $name ?>"></td>
</tr>
<?php if ( $delete )
      { ?>
<tr>
<td width="50%" class="f2" rowspan="2"><?php echo lang('DELETE') ?></a></td>
<td width="50%" class="f2"><input type="checkbox" name="delete" value="1"></td>
</tr>
<tr>
<td class="help"><?php echo lang('HELP_PROJECTMODEL_DELETE') ?></td>
</tr>
<?php } ?>
<tr>
<td colspan="2" class="act"><input type="submit" class="submit" value="<?php echo lang('SAVE') ?>"></a></td>
</tr>

</table>

</form>

</center>

<script name="JavaScript" type="text/javascript"><!--
document.forms[0].name.focus();
//--></script>

<?php include( $tpl_dir.'footer.tpl.php') ?>