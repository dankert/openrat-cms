<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<form action="<?php echo $self ?>" method="post" target="_self">

<input type="hidden" name="action"    value="page"    />
<input type="hidden" name="subaction" value="propsave"/>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

  <tr>
    <th colspan="2"><?php echo lang('PROP') ?></th>
  </tr>

  <tr>
    <td width="50%" rowspan="2" class="f1"><?php echo lang('name') ?></a></td>
    <td width="50%"             class="f1"><input type="text" class="name" name="name" size="50" value="<?php echo $name ?>"></td>
  </tr>
  <tr>
  <td width="50%" class="help"><?php echo lang('HELP_NAME') ?></td>
  </tr>
  <tr>
    <td width="50%" rowspan="2" class="f1"><?php echo lang('filename') ?></a></td>
    <td width="50%"             class="f1"><input type="text" class="filename" name="filename" size="50" value="<?php echo $filename ?>"></td>
  </tr>
  <tr>
	<td width="50%" class="help"><?php echo lang('HELP_FILENAME') ?></td>
  </tr>
  <tr>
    <td width="50%" class="f2"><?php echo lang('description') ?></a></td>
    <td width="50%" class="f2"><textarea cols="40" rows="10" name="desc"><?php echo $desc ?></textarea></td>
  </tr>
  <tr>
    <td width="50%" class="f1"><?php echo lang('template') ?></a></td>
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
    <td width="50%" class="f1"><?php echo lang('full_filename') ?></a></td>
    <td width="50%" class="f1"><tt><?php echo $full_filename ?></tt></td>
  </tr>

  <?php if ($delete)
        { ?>
  <tr>
    <td class="f1" rowspan="2"><?php echo lang('DELETE') ?></a></td>
    <td class="f1"><input type="checkbox" name="delete" value="1"></td>
  </tr>
  <tr>
    <td class="help"><?php echo lang('HELP_PAGE_DELETE') ?></td>
  </tr>
  <?php } ?>

  <tr>
    <td class="act" colspan="2"><input type="submit" class="submit" value="<?php echo lang('SAVE') ?>"></td>
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
    <td width="50%" class="f1"><?php echo lang('TEMPLATES') ?></a></td>
    <td width="50%" class="f1"><?php echo Html::selectBox('templateid',$templates) ?></td>
  </tr>

  <tr>
    <td class="act" colspan="2"><input type="submit"  class="submit" value="<?php echo lang('GLOBAL_REPLACE') ?>"></td>
  </tr>

</table>

</form>
<?php } ?>


<!-- Verschieben -->
<form action="<?php echo $self ?>" method="post" target="_self">

<input type="hidden" name="action"    value="page" />

<table class="main" width="90%" cellspacing="0" cellpadding="4">

  <tr>
    <th colspan="2"><?php echo lang('GLOBAL_MOVE') ?> / <?php echo lang('GLOBAL_COPY') ?></th>
  </tr>

  <tr>
    <td width="50%" class="f1"><?php echo lang('GLOBAL_ACTION') ?></a></td>
    <td width="50%" class="f1"><input type="radio" name="subaction" value="move" checked="checked" /> <?php echo lang('GLOBAL_MOVE') ?><br />
    <input type="radio" name="subaction" value="copy" /> <?php echo lang('GLOBAL_COPY') ?><br />
    <input type="radio" name="subaction" value="link" /> <?php echo lang('GLOBAL_LINK') ?><br />
    </td>
  </tr>

  <tr>
    <td width="50%" class="f1"><?php echo lang('GLOBAL_FOLDER') ?></a></td>
    <td width="50%" class="f1"><?php echo Html::selectBox('targetobjectid',$folder,$act_folderobjectid) ?></td>
  </tr>

  <tr>
    <td class="act" colspan="2"><input type="submit"  class="submit" value="<?php echo lang('GLOBAL_SAVE') ?>"></td>
  </tr>

</table>

</form>


<script name="JavaScript" type="text/javascript"><!--
document.forms[0].name.focus();
//--></script>

</center>

<?php include( $tpl_dir.'footer.tpl.php') ?>