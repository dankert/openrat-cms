<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<form enctype="multipart/form-data" action="<?php echo $self ?>" method="post" target="_self">
<input type="hidden" name="subaction" value="createnew">
<input type="hidden" name="<?php echo session_name() ?>" value="<?php echo session_id() ?>">

<table class="main" width="90%" cellspacing="0" cellpadding="4">

  <tr>
    <th colspan="4"><?php echo lang('NEW') ?></th>
  </tr>

  <tr>
    <td class="f1">
      <input type="radio" name="type" value="page" onClick="document.forms[0].pagename.focus();"><?php echo lang('PAGE') ?>
    </td>
    <td class="f1">
      <?php echo Html::selectBox('templateid',$templates) ?>
      <input type="text" name="pagename" size="20" value="" onFocus="document.forms[0].type[0].checked=true;" tabindex="1">
    </td>
  </tr>

  <tr>
    <td class="f1">
      <input type="radio" name="type" value="file" onClick="document.forms[0].file.focus();"><?php echo lang('FILE') ?>
    </td>
    <td class="f1">
      <input type="file" name="file" onFocus="document.forms[0].type[1].checked=true;" tabindex="2">
    </td>
  </tr>

  <tr>
    <td class="f1">
      <input type="radio" name="type" value="folder" onClick="document.forms[0].foldername.focus();"><?php echo lang('FOLDER') ?>
    </td>
    <td class="f1">
      <input type="text" name="foldername" size="20" value="" onFocus="document.forms[0].type[2].checked=true;" tabindex="3">
    </td>
  </tr>

  <tr>
    <td class="f1">
      <input type="radio" name="type" value="link" onClick="document.forms[0].linkname.focus();"><?php echo lang('link') ?>
    </td>
    <td class="f1">
      <input type="text" name="linkname" size="20" value="" onFocus="document.forms[0].type[3].checked=true;" tabindex="4">
    </td>
  </tr>

  <tr>
    <td colspan="5" class="act">
      <input type="submit" class="submit" value="<?php echo lang('NEW') ?>">

    </td>
  </tr>

</table>

</form>
</center>

<script name="JavaScript" type="text/javascript"><!--
document.forms[0].pagename.focus();
//--></script>
<?php include( $tpl_dir.'footer.tpl.php') ?>