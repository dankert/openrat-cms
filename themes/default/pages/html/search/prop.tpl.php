<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->

<center>

<form action="<?php echo $self ?>" method="post" target="_self">

<input type="hidden" name="action"     value="search">
<input type="hidden" name="subaction"  value="search">
<input type="hidden" name="searchtype"   value="prop"  >

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('SEARCH_PROP') ?></th>
</tr>

<tr>
<td width="50%" class="f1"><input type="radio" name="type" value="id" onClick="document.forms[0].id.focus();"><?php echo lang('GLOBAL_id') ?></a></td>
<td width="50%" class="f1"><input type="text" name="id" size="10" value="" onFocus="document.forms[0].type[0].checked=true;"></td>
</tr>
<tr>
<td width="50%" class="f1"><input type="radio" name="type" value="name" onClick="document.forms[0].name.focus();"><?php echo lang('GLOBAL_name') ?></a></td>
<td width="50%" class="f1"><input type="text" name="name" size="50" value="" onFocus="document.forms[0].type[1].checked=true;"></td>
</tr>
<tr>
<td width="50%" class="f1"><input type="radio" name="type" value="filename" onClick="document.forms[0].filename.focus();"><?php echo lang('GLOBAL_filename') ?></a></td>
<td width="50%" class="f1"><input type="text" name="filename" size="50" value="" onFocus="document.forms[0].type[2].checked=true;"></td>
</tr>
<tr>
<td width="50%" class="f2"><input type="radio" name="type" value="extension" onClick="document.forms[0].extension.focus();"><?php echo lang('FILE_extension') ?></a></td>
<td width="50%" class="f2"><input type="text" name="extension" size="50" value="" onFocus="document.forms[0].type[3].checked=true;"></td>
</tr>
<tr>
<td width="50%" class="f2"><input type="radio" name="type" value="desc" onClick="document.forms[0].desc.focus();"><?php echo lang('GLOBAL_description') ?></a></td>
<td width="50%" class="f2"><input type="text" name="desc" size="50" value="" onFocus="document.forms[0].type[4].checked=true;"></td>
</tr>
<tr>
<td width="50%" class="f2"><input type="radio" name="type" value="create_user" onClick="document.forms[0].create_user.focus();"><?php echo lang('GLOBAL_created') ?></a></td>
<td width="50%" class="f2"><?php echo Html::selectBox('create_userid',$users) ?></td>
</tr>
<tr>
<td width="50%" class="f2"><input type="radio" name="type" value="lastchange_user" onClick="document.forms[0].lastchange_user.focus();"><?php echo lang('GLOBAL_lastchange') ?></a></td>
<td width="50%" class="f2"><?php echo Html::selectBox('lastchange_userid',$users) ?></td>
</tr>
<tr>
<td class="act" colspan="2"><input type="submit" class="submit" value="<?php echo lang('GLOBAL_SEARCH') ?>"></td>
</tr>

</table>

</form>

</center>

<script name="JavaScript" type="text/javascript"><!--
document.forms[0].name.focus();
//--></script>

<?php include( $tpl_dir.'footer.tpl.php') ?>