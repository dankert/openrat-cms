<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<table class="main" width="60%" cellspacing="0" cellpadding="4">

  <tr>
    <th><?php echo $title ?></th>
  </tr>
  <tr>
    <td class="message"><?php echo $text ?>
    
    <?php if ($info!='')
             echo '<br /><br /><br /><strong>'.lang('ADDITIONAL_INFO').'</strong><pre>'.htmlentities($info).'</pre>';
    ?>
    </td>
  </tr>

</table>

</center>

<?php include( $tpl_dir.'footer.tpl.php') ?>