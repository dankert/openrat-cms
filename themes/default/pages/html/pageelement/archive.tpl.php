<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="6"><?php echo lang('ARCHIVE') ?> (<?php echo lang('ELEMENT') ?>: <?php echo $name ?>)</th>
</tr>
<?php if (count($el)>0)
      { ?>
<tr>
  <td class="help"><?php echo lang('GLOBAL_NR')    ?></td>
  <td class="help"><?php echo lang('DATE')  ?></td>
  <td class="help"><?php echo lang('USER')  ?></td>
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
<td width="5%"  class="<?php echo $fx ?>"><?php echo $e['lfd_nr'] ?></td>
<td width="20%" class="<?php echo $fx ?>"><?php echo $e['date']   ?></td>
<td width="20%" class="<?php echo $fx ?>"><?php echo $e['user' ]  ?></td>
<td width="45%" class="<?php echo $fx ?>"><?php echo $e['value']  ?></td>
<td width="15%" class="<?php echo $fx ?>"><?php if ($e['public']) echo lang('public'); elseif ($e['releaseUrl']!='') { ?><a href="<?php echo $e['releaseUrl'] ?>"><?php echo lang('RELEASE') ?></a><?php } else { ?>&nbsp;<?php } ?></td>
<td width="10%" class="<?php echo $fx ?>"><?php if ($e['active']) echo lang('active'); elseif ($e['useUrl'    ]!='') { ?><a href="<?php echo $e['useUrl'    ] ?>"><?php echo lang('USE'    ) ?></a><?php } else { ?>&nbsp;<?php }  ?></td>
</tr>
<?php } ?>
<tr>
  <td class="help" colspan="6"><?php echo lang('PAGE_ARCHIVE_DESC') ?></td>
</tr>
<?php }
      else
      { ?>
<tr>
  <td class="f1" colspan="6"><strong><?php echo lang('NOT_FOUND') ?></strong></td>
</tr>
<?php } ?>

</table>



<?php if (count($version_list)>1)
      { ?>
<form action="<?php echo $self ?>" method="post" target="_self">
<input type="hidden" name="action"    value="pageelement" />
<input type="hidden" name="subaction" value="diff"        />

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('GLOBAL_DIFFERENCES') ?></th>
</tr>
<tr>
  <td colspan="2" class="help"><?php echo lang('GLOBAL_DIFFERENCES_DESC') ?></td>
</tr>
<tr>
  <?php $ver_keys   = array_keys( $version_list );
        $default1id = $ver_keys[ count($ver_keys)-2 ];  
        $default2id = $ver_keys[ count($ver_keys)-1 ];
  ?>
  <td class="<?php echo $fx ?>" width="50%"><?php echo lang('GLOBAL_COMPARE') ?>&nbsp;<?php echo Html::selectBox('value1id',$version_list,$default1id) ?></td>
  <td class="<?php echo $fx ?>" width="50%"><?php echo lang('GLOBAL_WITH'   ) ?>&nbsp;<?php echo Html::selectBox('value2id',$version_list,$default2id) ?></td>
</tr>
<tr>
  <td colspan="2" class="act"><input class="submit" type="submit" value="<?php echo lang('SAVE') ?>" /></td>
</tr>

</table>
</form>
<?php } ?>


</center>
<?php include( $tpl_dir.'footer.tpl.php') ?>