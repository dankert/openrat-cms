<?php include($tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->

<table cellpadding="5" cellspacing="0" width="100%">
  <tr>
    <td class="title"><span title="<?php echo lang('USER_LOGINAS') ?>: <?php echo $username ?>"><?php echo $userfullname ?></span> <strong>@</strong> <span title="<?php echo lang('GLOBAL_DATABASE') ?>: <?php echo $dbid ?>"><?php echo $dbname ?></span></td>
    <td class="title" style="text-align:right;"><a href="<?php echo $profile_url ?>" title="<?php echo lang('USER_PROFILE_DESC'); ?>" target="cms_main_main"><?php echo lang('USER_YOURPROFILE'); ?></a>&nbsp;|&nbsp;<a href="<?php echo $logout_url ?>" title="<?php echo lang('USER_LOGOUT_DESC'); ?>" target="_top"><?php echo lang('USER_LOGOUT'); ?></a></td>
  </tr>
</table>

<?php include($tpl_dir.'footer.tpl.php') ?>