<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->

<center>

<?php echo Html::form('search','search',0,array('searchtype'=>'content')) ?>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('SEARCH_CONTENT') ?></th>
</tr>
<?php $nr=0 ?>

<tr>
<td width="50%" class="f1"><input type="radio" name="type" value="value" onClick="document.forms[0].text.focus();"><?php echo lang('GLOBAL_value') ?></a></td>
<td width="50%" class="f1"><input type="text" name="text" size="50" value="" onFocus="document.forms[0].type[0].checked=true;" tabindex="<?php echo ++$nr ?>"></td>
</tr>
<tr>
<td width="50%" class="f2"><input type="radio" name="type" value="lastchange_userid" onClick="document.forms[0].lastchange_userid.focus();"><?php echo lang('GLOBAL_lastchange') ?></a></td>
<td width="50%" class="f2"><?php echo Html::selectBox('lastchange_userid',$users,$act_userid,array('tabindex'=>++$nr,'onFocus'=>'document.forms[0].type[1].checked=true;')) ?></td>
</tr>
<tr>
<td class="act" colspan="2"><input type="submit" class="submit" value="<?php echo lang('GLOBAL_SEARCH') ?>"></td>
</tr>

</table>

</form>

</center>

<?php Html::focusField('text') ?>

<?php include( $tpl_dir.'footer.tpl.php') ?>