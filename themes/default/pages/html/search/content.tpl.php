<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->

<center>

<form action="<?php echo $self ?>" method="post" target="_self">

<input type="hidden" name="searchaction" value="search">
<input type="hidden" name="searchtype"   value="content">

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('SEARCH_CONTENT') ?></th>
</tr>

<tr>
<td width="50%" class="f1"><input type="radio" name="type" value="value" onClick="document.forms[0].text.focus();"><?php echo lang('value') ?></a></td>
<td width="50%" class="f1"><input type="text" name="text" size="50" value="" onFocus="document.forms[0].type[0].checked=true;"></td>
</tr>
<tr>
<td width="50%" class="f2"><input type="radio" name="type" value="lastchange_user"><?php echo lang('lastchange') ?></a></td>
<td width="50%" class="f2"><?php echo Html::selectBox('lastchange_userid',$users) ?></td>
</tr>
<tr>
<td class="act" colspan="2"><input type="submit" class="submit" value="<?php echo lang('SEARCH') ?>"></td>
</tr>

</table>

</form>

</center>

<script name="JavaScript"><!--
document.forms[0].text.focus();
//--></script>

<?php include( $tpl_dir.'footer.tpl.php') ?>