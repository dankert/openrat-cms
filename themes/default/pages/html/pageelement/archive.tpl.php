<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="5"><?php echo lang('ARCHIVE') ?> (<?php echo lang('ELEMENT') ?>: <?php echo $name ?>)</th>
</tr>
<?php if (count($el)>0)
      { ?>
<tr>
  <td class="help"><?php echo lang('DATE') ?></td>
  <td class="help"><?php echo lang('USER') ?></td>
  <td class="help"><?php echo lang('VALUE') ?></td>
  <td class="help">&nbsp;</td>
  <td class="help">&nbsp;</td>
</tr>

<?php $f1=true;
      foreach( $el as $id=>$e )
      {
      	$fx = fx($f1);
      	?>
<tr>
<td width="20%" class="<?php echo $fx ?>"><?php echo $e['date']  ?></td>
<td width="20%" class="<?php echo $fx ?>"><?php echo $e['user' ] ?></td>
<td width="45%" class="<?php echo $fx ?>"><?php echo $e['value'] ?></td>
<td width="15%" class="<?php echo $fx ?>"><?php if ($e['public']) echo lang('public'); elseif ($e['releaseUrl']!='') { ?><a href="<?php echo $e['releaseUrl'] ?>"><?php echo lang('RELEASE') ?></a><?php } else { ?>&nbsp;<?php } ?></td>
<td width="15%" class="<?php echo $fx ?>"><?php if ($e['active']) echo lang('active'); elseif ($e['useUrl'    ]!='') { ?><a href="<?php echo $e['useUrl'    ] ?>"><?php echo lang('USE'    ) ?></a><?php } else { ?>&nbsp;<?php }  ?></td>
</tr>
<?php } ?>
<tr>
  <td class="help" colspan="4"><?php echo lang('PAGE_ARCHIVE_DESC') ?></td>
</tr>
<?php }
      else
      { ?>
<tr>
  <td class="f1" colspan="4"><strong><?php echo lang('NOT_FOUND') ?></strong></td>
</tr>
<?php } ?>

</table>

</center>
<?php include( $tpl_dir.'footer.tpl.php') ?>