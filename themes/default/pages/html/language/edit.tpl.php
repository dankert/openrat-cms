<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->

<center>

<form action="<?php echo $self ?>" method="post" target="_self">
<input type="hidden" name="languageaction" value="save">
<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('LANGUAGE') ?></a></th>
</tr>

<tr>
<td width="50%" class="f1"><?php echo lang('LANGUAGE') ?></a></td>
<td width="50%" class="f1"><input type="text" size="50" name="name" value="<?php echo $name ?>"></td>
</tr>
<tr>
<td width="50%" class="f2"><?php echo lang('ISOCODE') ?></a></td>
<td width="50%" class="f2"><input type="text" size="10" name="isocode" maxlength="10" value="<?php echo $isocode ?>"></td>
</tr>
<?php if ( $delete )
      { ?>
<tr>
<td width="50%" class="f2" rowspan="2"><?php echo lang('DELETE') ?></a></td>
<td width="50%" class="f2"><input type="checkbox" name="delete" value="1"></td>
</tr>
<tr>
<td class="help"><?php echo lang('HELP_LANGUAGE_DELETE') ?></td>
</tr>
<?php } ?>

<tr>
<td colspan="2" class="act"><input type="submit" class="submit" value="<?php echo lang('SAVE') ?>"></a></td>
</tr>
</table>

</form>
</center>

<script name="JavaScript"><!--
document.forms[0].name.focus();
//--></script>

<?php include( $tpl_dir.'footer.tpl.php') ?>