<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->

<center>

<?php echo Html::form('language','save',$languageid) ?>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('GLOBAL_LANGUAGE') ?></a></th>
</tr>

<tr>
<td width="50%" class="f1"><?php echo lang('GLOBAL_LANGUAGE') ?></a></td>
<td width="50%" class="f2"><?php echo Html::selectBox('isocode',$isocodes,$act_isocode) ?></td>
</tr>

<?php if ( $delete )
      { ?>
<tr>
<td width="50%" class="f2" rowspan="2"><?php echo lang('GLOBAL_DELETE') ?></a></td>
<td width="50%" class="f2"><input type="checkbox" name="delete" value="1"></td>
</tr>
<tr>
<td class="help"><?php echo lang('HELP_LANGUAGE_DELETE') ?></td>
<?php } ?>
</tr>

<tr>
<td colspan="2" class="act"><input type="submit" class="submit" value="<?php echo lang('GLOBAL_SAVE') ?>"></a></td>
</tr>
</table>

</form>
</center>

<script name="JavaScript" type="text/javascript"><!--
document.forms[0].name.focus();
//--></script>

<?php include( $tpl_dir.'footer.tpl.php') ?>