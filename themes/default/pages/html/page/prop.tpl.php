<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<form action="<?php echo $self ?>" method="post" target="_self">

<input type="hidden" name="action"    value="page"    />
<input type="hidden" name="subaction" value="propsave"/>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

  <tr>
    <th colspan="2"><?php echo lang('GLOBAL_PROP') ?></th>
  </tr>

  <tr>
    <td width="50%" rowspan="2" class="f1"><?php echo lang('GLOBAL_NAME') ?></a></td>
    <td width="50%"             class="f1"><input type="text" class="name" name="name" size="50" value="<?php echo $name ?>"></td>
  </tr>
  <tr>
  <td width="50%" class="help"><?php echo lang('GLOBAL_NAME_DESC') ?></td>
  </tr>
  <tr>
    <td width="50%" rowspan="2" class="f1"><?php echo lang('GLOBAL_FILENAME') ?></a></td>
    <td width="50%"             class="f1"><input type="text" class="filename" name="filename" size="50" value="<?php echo $filename ?>"></td>
  </tr>
  <tr>
	<td width="50%" class="help"><?php echo lang('GLOBAL_FILENAME_DESC') ?></td>
  </tr>
  <tr>
    <td width="50%" class="f2"><?php echo lang('GLOBAL_DESCRIPTION') ?></a></td>
    <td width="50%" class="f2"><textarea cols="40" rows="10" name="desc"><?php echo $desc ?></textarea></td>
  </tr>
  <tr>
    <td width="50%" class="f1"><?php echo lang('GLOBAL_TEMPLATE') ?></a></td>
    <?php if (isset($template_url))
          { ?>
    <td width="50%" class="f1"><a href="<?php echo $template_url ?>" target="cms_main"><img src="<?php echo $image_dir ?>icon_tpl.png" border="0" align="left"><?php echo $template_name ?></a></td>
    <?php }
          else
          { ?>
    <td width="50%" class="f1"><img src="<?php echo $image_dir ?>icon_tpl.png" align="left"><?php echo $template_name ?></td>
    <?php } ?>
  </tr>
  <tr>
    <td width="50%" class="f1"><?php echo lang('GLOBAL_FULL_FILENAME') ?></a></td>
    <td width="50%" class="f1"><tt><?php echo $full_filename ?></tt></td>
  </tr>
  <tr>
    <td width="50%" class="f2"><?php echo lang('GLOBAL_created') ?></a></td>
    <td width="50%" class="f2"><?php echo date(lang('DATE_FORMAT'),$create_date) ?></td>
  </tr>
  <tr>
    <td width="50%" class="f2"><?php echo lang('GLOBAL_lastchange') ?></a></td>
    <td width="50%" class="f2"><?php echo date(lang('DATE_FORMAT'),$lastchange_date) ?></td>
  </tr>

  <tr>
    <td class="act" colspan="2"><input type="submit" class="submit" value="<?php echo lang('GLOBAL_SAVE') ?>"></td>
  </tr>

</table>

</form>


<!-- Vorlage tauschen -->
<?php if (count($templates)>0) // Nur anzeigen, wenn es Vorlagen zu tauschen gibt
      { ?>
<form action="<?php echo $self ?>" method="post" target="_self">

<input type="hidden" name="action"    value="page" />
<input type="hidden" name="subaction" value="replaceTemplateSelectElements" />

<table class="main" width="90%" cellspacing="0" cellpadding="4">

  <tr>
    <th colspan="2"><?php echo lang('PAGE_REPLACE_TEMPLATE') ?></th>
  </tr>

  <tr>
    <td width="50%" class="f1"><?php echo lang('GLOBAL_TEMPLATES') ?></a></td>
    <td width="50%" class="f1"><?php echo Html::selectBox('templateid',$templates) ?></td>
  </tr>

  <tr>
    <td class="act" colspan="2"><input type="submit"  class="submit" value="<?php echo lang('GLOBAL_REPLACE') ?>"></td>
  </tr>

</table>

</form>
<?php } ?>


<?php Html::focusField('name') ?>

</center>

<?php include( $tpl_dir.'footer.tpl.php') ?>