<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<?php echo Html::form( 'folder','createnew',$objectid,array('enctype'=>'multipart/form-data') ) ?>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

  <tr>
    <th colspan="4"><?php echo lang('GLOBAL_NEW') ?></th>
  </tr>

  <?php $nr = 0 ?>
  <?php $tab = 0 ?>

  <?php if ($new_page)
        { ?>
  <?php   if (count($templates)>0) // Nur, wenn Vorlagen vorhanden
          { ?>
  <tr>
    <td class="f1">
      <input type="radio" name="type" value="page" onClick="document.forms[0].pagename.focus();"><?php echo lang('GLOBAL_PAGE') ?>
    </td>
    <td class="f1">
      <?php echo Html::selectBox('templateid',$templates) ?>
      <input type="text" name="pagename" size="20" value="" onFocus="document.forms[0].type[<?php echo $nr++ ?>].checked=true;" tabindex="<?php echo $tab++ ?>">
    </td>
  </tr>
  <?php   }
          else
          { ?>
  <tr>
    <td class="help" colspan="2"><?php echo lang('GLOBAL_NO_TEMPLATES_AVAILABLE_DESC') ?></td>
  </tr>
  <?php   } ?>
  <?php } ?>

  <?php if ($new_file)
        { ?>
  <tr>
    <td class="f1">
      <input type="radio" name="type" value="file" onClick="document.forms[0].file.focus();"><?php echo lang('GLOBAL_FILE') ?>
    </td>
    <td class="f1">
      <input type="file" name="file" onFocus="document.forms[0].type[<?php echo $nr++ ?>].checked=true;" tabindex="<?php echo $tab++ ?>">
    </td>
  </tr>
  <?php } ?>

  <?php if ($new_folder)
        { ?>
  <tr>
    <td class="f1">
      <input type="radio" name="type" value="folder" onClick="document.forms[0].foldername.focus();"><?php echo lang('GLOBAL_FOLDER') ?>
    </td>
    <td class="f1">
      <input type="text" name="foldername" size="20" value="" onFocus="document.forms[0].type[<?php echo $nr++ ?>].checked=true;" tabindex="<?php echo $tab++ ?>">
    </td>
  </tr>
  <?php } ?>

  <?php if ($new_link)
        { ?>
  <tr>
    <td class="f1">
      <input type="radio" name="type" value="link" onClick="document.forms[0].linkname.focus();"><?php echo lang('GLOBAL_LINK') ?>
    </td>
    <td class="f1">
      <input type="text" name="linkname" size="20" value="" onFocus="document.forms[0].type[<?php echo $nr++ ?>].checked=true;" tabindex="<?php echo $tab++ ?>">
    </td>
  </tr>
  <?php } ?>

  <tr>
    <td colspan="5" class="act">
      <input type="submit" class="submit" value="<?php echo lang('GLOBAL_NEW') ?>">

    </td>
  </tr>

</table>

</form>
</center>

<?php
	if		($new_page)   Html::focusField('pagename'  );
	elseif	($new_folder) Html::focusField('foldername');
	elseif	($new_file)   Html::focusField('filename'  );
	elseif	($new_link)   Html::focusField('linkname'  );
?>

<?php include( $tpl_dir.'footer.tpl.php') ?>