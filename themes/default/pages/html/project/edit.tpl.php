<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<form action="<?php echo $self ?>" method="post" target="_self">
<input type="hidden" name="<?php echo session_name() ?>" value="<?php echo session_id() ?>">
<input type="hidden" name="subaction" value="save">

<table class="main" width="90%" cellspacing="0" cellpadding="4">

  <tr>
    <th colspan="2"><?php echo lang('PROJECT') ?></th>
  </tr>

  <tr>
    <td width="50%" class="f1"><?php echo lang('project_name') ?></a></td>
    <td width="50%" class="f1"><input type="text" name="name" class="name" size="50" value="<?php echo $name ?>"></td>
  </tr>
  <tr>
    <td width="50%" class="f2" rowspan="2"><?php echo lang('target_dir') ?></a></td>
    <td width="50%" class="f2"><input type="text" class="filename" name="target_dir" size="50" value="<?php echo $target_dir ?>"></td>
  </tr>
  <tr>
    <td class="help"><?php echo lang('HELP_PROJECT_LOCALPATH') ?></td>
  </tr>

  <tr>
    <td width="50%" class="f1" rowspan="2"><?php echo lang('ftp_url') ?></a></td>
    <td width="50%" class="f1"><input type="text" name="ftp_url" size="50" value="<?php echo $ftp_url ?>"></td>
  </tr>
  <tr>
    <td class="help"><?php echo lang('HELP_PROJECT_FTPPATH') ?></td>
  </tr>

  <tr>
    <td width="50%" class="f1" rowspan="2"><?php echo lang('ftp_passive') ?></a></td>
    <td width="50%" class="f1"><input type="checkbox" name="ftp_passive" value="1"<?php if ($ftp_passive=='1') echo ' checked' ?></td>
  </tr>
  <tr>
    <td class="help"><?php echo lang('HELP_PROJECT_FTP_PASSIVE') ?></td>
  </tr>

  <tr>
    <td width="50%" class="f1" rowspan="2"><?php echo lang('cmd_after_publish') ?></a></td>
    <td width="50%" class="f1"><input type="text" name="cmd_after_publish" size="50" value="<?php echo $cmd_after_publish ?>"></td>
  </tr>
  <tr>
    <td class="help"><?php echo lang('HELP_PROJECT_CMD_AFTER_PUBLISH') ?></td>
  </tr>

  <tr>
    <td class="f1" rowspan="2"><?php echo lang('CONTENT_NEGOTIATION') ?></a></td>
    <td class="f1"><input type="checkbox" name="content_negotiation" value="1"<?php if ($content_negotiation=='1') echo ' checked' ?>></td>
  </tr>
  <tr>
    <td class="help"><?php echo lang('HELP_CONTENT_NEGOTIATION') ?></td>
  </tr>

  <tr>
    <td class="f1" rowspan="2"><?php echo lang('CUT_INDEX') ?></a></td>
    <td class="f1"><input type="checkbox" name="cut_index" value="1"<?php if ($cut_index=='1') echo ' checked' ?>></td>
  </tr>
  <tr>
    <td class="help"><?php echo lang('HELP_CUT_INDEX') ?></td>
  </tr>

  <tr>
    <td class="f1" rowspan="2"><?php echo lang('DELETE') ?></a></td>
    <td class="f1"><input type="checkbox" name="delete" value="1"></td>
  </tr>
  <tr>
    <td class="help"><?php echo lang('HELP_PROJECT_DELETE') ?></td>
  </tr>

  <tr>
    <td class="act"><input type="submit" class="submit" value="<?php echo lang('SAVE') ?>"></td>
    <td class="act"><input type="reset" class="submit"></td>
  </tr>

</table>

</form>

</center>
<?php include( $tpl_dir.'footer.tpl.php') ?>