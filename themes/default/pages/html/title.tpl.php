<?php include($tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<?php if (isset($username))
      { ?>

<table cellpadding="5" cellspacing="0" width="100%">
  <tr>
    <td class="title"><span title="<?php echo lang('LOGINAS') ?>: <?php echo $username ?>"><?php echo $userfullname ?></span> <strong>@</strong> <span title="<?php echo lang('DATABASE') ?>: <?php echo $dbid ?>"><?php echo $dbname ?></span></td>
    <td class="title" style="text-align:right;"><a href="<?php echo $profile_url ?>" title="<?php echo lang('HELP_PROFILE'); ?>" target="cms_main_main"><?php echo lang('YOURPROFILE'); ?></a>&nbsp;|&nbsp;<a href="<?php echo $logout_url ?>" title="<?php echo lang('HELP_LOGOUT'); ?>" target="_top"><?php echo lang('LOGOUT'); ?></a></td>
  </tr>
</table>

<?php } ?>

<?php include($tpl_dir.'footer.tpl.php') ?>