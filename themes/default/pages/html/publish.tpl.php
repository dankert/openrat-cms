<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<table class="main" width="60%" cellspacing="0" cellpadding="4">

  <tr>
    <th colspan="1"><?php echo lang('PUBLISH') ?></th>
  </tr>

  <?php foreach( $filenames as $filename )
        { ?>
  <tr>
    <td width="50%" class="f1"><?php echo $filename ?></td>
  </tr>
  <?php } ?>

<!--
  <tr>
    <td colspan="4"><pre><?php echo $log ?></pre>
    </td>
  </tr>
-->  
</table>


</center>

<?php include( $tpl_dir.'footer.tpl.php') ?>