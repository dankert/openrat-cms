<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<form action="<?php echo $self ?>" method="post" target="_self">

<input type="hidden" name="action"    value="link">
<input type="hidden" name="subaction" value="save">

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('PROP') ?></th>
</tr>

  <tr>
    <td width="50%" class="f1" rowspan="2"><?php echo lang('name') ?></a></td>
    <td width="50%" class="f1"><input type="text" class="name" name="name" size="50" value="<?php echo $name ?>"></td>
  </tr>
  <tr>
    <td width="50%" class="help"><?php echo lang('HELP_NAME') ?></td>
  </tr>
  <tr>
    <td width="50%" class="f2"><?php echo lang('description') ?></a></td>
    <td width="50%" class="f2"><textarea class="desc" cols="40" rows="10" name="desc"><?php echo $desc ?></textarea></td>
  </tr>
  <tr>
    <td class="f1"><input type="radio" name="type" value="link"<?php if ($type=='link') echo ' checked="checked"'; ?>><?php echo lang('target') ?></a></td>
    <td class="f1"><?php echo Html::selectBox('linkobjectid',$objects,$act_linkobjectid) ?></td>
  </tr>
  <tr>
    <td class="f1"><input type="radio" name="type" value="url"<?php if ($type=='url') echo ' checked="checked"'; ?>><?php echo lang('url') ?></a></td>
    <td class="f1"><input type="text" name="url" size="50" maxlength="255" value="<?php echo $url; ?>"></td>
  </tr>
  <tr>
    <td width="50%" class="f2"><?php echo lang('created') ?></a></td>
    <td width="50%" class="f2"><?php echo date(lang('DATE_FORMAT'),$create_date) ?>, <?php if (isset($create_user['url'])) echo'<a href="'.$create_user['url'].'" target="cms_main">' ?><?php echo $create_user['name'] ?><?php if (isset($create__user['url'])) echo'</a>' ?></td>
  </tr>
  <tr>
    <td width="50%" class="f2"><?php echo lang('lastchange') ?></a></td>
    <td width="50%" class="f2"><?php echo date(lang('DATE_FORMAT'),$lastchange_date) ?>, <?php if (isset($lastchange_user['url'])) echo'<a href="'.$lastchange_user['url'].'" target="cms_main">' ?><?php echo $lastchange_user['name'] ?><?php if (isset($lastchange_user['url'])) echo'</a>' ?></td>
  </tr>
  <tr>
    <td class="f1" rowspan="2"><?php echo lang('DELETE') ?></a></td>
    <td class="f1"><input type="checkbox" name="delete" value="1"></td>
  </tr>
  <tr>
    <td class="help"><?php echo lang('LINK_DELETE_DESC') ?></td>
  </tr>
  <tr>
    <td class="act" colspan="2"><input type="submit" class="submit" value="<?php echo lang('SAVE') ?>"></td>
  </tr>

</table>

</form>



</center>

<?php Html::focusField('name') ?>

<?php include( $tpl_dir.'footer.tpl.php') ?>