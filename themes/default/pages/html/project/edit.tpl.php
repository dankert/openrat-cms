<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<?php echo Html::form('project','save',$projectid ) ?>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

  <tr>
    <th colspan="2"><?php echo lang('GLOBAL_PROJECT') ?></th>
  </tr>

  <tr>
    <td width="50%" class="f1"><?php echo lang('PROJECT_NAME') ?></a></td>
    <td width="50%" class="f1"><input type="text" name="name" class="name" size="50" value="<?php echo $name ?>" /></td>
  </tr>
  <tr>
    <td width="50%" class="f2" rowspan="2"><?php echo lang('PROJECT_TARGET_DIR') ?></a></td>
    <td width="50%" class="f2"><input type="text" class="filename" name="target_dir" size="50" value="<?php echo $target_dir ?>" /></td>
  </tr>
  <tr>
    <td class="help"><?php echo lang('PROJECT_LOCALPATH_DESC') ?></td>
  </tr>

  <tr>
    <td width="50%" class="f1" rowspan="2"><?php echo lang('PROJECT_FTP_URL') ?></a></td>
    <td width="50%" class="f1"><input type="text" name="ftp_url" size="50" value="<?php echo $ftp_url ?>" /></td>
  </tr>
  <tr>
    <td class="help"><?php echo lang('PROJECT_FTP_URL_DESC') ?></td>
  </tr>

  <tr>
    <td width="50%" class="f1" rowspan="2"><?php echo lang('PROJECT_FTP_PASSIVE') ?></a></td>
    <td width="50%" class="f1"><input type="checkbox" name="ftp_passive" value="1"<?php if ($ftp_passive=='1') echo ' checked="checked"' ?> /></td>
  </tr>
  <tr>
    <td class="help"><?php echo lang('PROJECT_FTP_PASSIVE_DESC') ?></td>
  </tr>

  <tr>
    <td width="50%" class="f1" rowspan="2"><?php echo lang('PROJECT_CMD_AFTER_PUBLISH') ?></a></td>
    <td width="50%" class="f1"><input type="text" name="cmd_after_publish" size="50" value="<?php echo $cmd_after_publish ?>"></td>
  </tr>
  <tr>
    <td class="help"><?php echo lang('PROJECT_CMD_AFTER_PUBLISH_DESC') ?></td>
  </tr>

  <tr>
    <td class="f1" rowspan="2"><?php echo lang('PROJECT_CONTENT_NEGOTIATION') ?></a></td>
    <td class="f1"><input type="checkbox" name="content_negotiation" value="1"<?php if ($content_negotiation=='1') echo ' checked' ?>></td>
  </tr>
  <tr>
    <td class="help"><?php echo lang('PROJECT_CONTENT_NEGOTIATION_DESC') ?></td>
  </tr>

  <tr>
    <td class="f1" rowspan="2"><?php echo lang('PROJECT_CUT_INDEX') ?></a></td>
    <td class="f1"><input type="checkbox" name="cut_index" value="1"<?php if ($cut_index=='1') echo ' checked' ?>></td>
  </tr>
  <tr>
    <td class="help"><?php echo lang('PROJECT_CUT_INDEX_DESC') ?></td>
  </tr>

  <tr>
    <td class="f1" rowspan="2"><?php echo lang('GLOBAL_DELETE') ?></a></td>
    <td class="f1"><input type="checkbox" name="delete" value="1"></td>
  </tr>
  <tr>
    <td class="help"><?php echo lang('PROJECT_DELETE_DESC') ?></td>
  </tr>

  <tr>
    <td class="act"><input type="submit" class="submit" value="<?php echo lang('GLOBAL_SAVE') ?>" /></td>
    <td class="act"><input type="reset"  class="submit" value="<?php echo lang('GLOBAL_UNDO') ?>" /></td>
  </tr>

</table>

</form>

</center>
<?php include( $tpl_dir.'footer.tpl.php') ?>