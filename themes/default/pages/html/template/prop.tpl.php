<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<?php echo Html::form('template','propsave',$templateid ) ?>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

  <tr>
    <th colspan="2"><?php echo lang('GLOBAL_PROP') ?></th>
  </tr>

  <tr>
    <td width="50%" class="f1"><?php echo lang('GLOBAL_name') ?></a></td>
    <td width="50%" class="f1"><input type="text" name="name" size="50" value="<?php echo $name ?>"></td>
  </tr>
  <?php if ( count($pages)==0)
        { ?>
  <tr>
    <td class="f1" rowspan="2"><?php echo lang('GLOBAL_DELETE') ?></a></td>
    <td class="f1"><input type="checkbox" name="delete" value="1"></td>
  </tr>
  <tr>
    <td class="help"><?php echo lang('HELP_TEMPLATE_DELETE') ?></td>
  </tr>
<?php } ?>

  <tr>
    <td class="act" colspan="2"><input type="submit" class="submit" value="<?php echo lang('GLOBAL_SAVE') ?>"></td>
  </tr>

</table>

</form>


<?php echo Html::form('template','extensionsave',$templateid ) ?>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('TEMPLATE_EXTENSION') ?></th>
</tr>

<tr>
<td width="50%" class="f1"><?php echo lang('TEMPLATE_extension') ?></a></td>
<td width="50%" class="f1"><input type="text" name="extension" size="10" value="<?php echo $extension ?>"></td>
</tr>
<tr>
<td class="act" colspan="2"><input type="submit" class="submit" value="<?php echo lang('GLOBAL_SAVE') ?>"></td>
</tr>

</table>

</form>




<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('GLOBAL_PAGES') ?></th>
</tr>

<?php $f1=true;
      foreach( $pages as $id=>$p )
      { ?>
<tr>
<td class="f1"><a href="<?php echo $p['url'] ?>" target="cms_main"><img src="<?php echo $image_dir.'icon_page'.IMG_EXT ?>" border="0" align="left"><?php echo $p['name'] ?></a></td>
</tr>
<?php }
      if ( count($pages)==0)
      { ?>
<tr>
<td class="f1"><?php echo lang('GLOBAL_NOT_FOUND') ?></td>
</tr>
<?php } ?>
  

</table>


</center>

<?php Html::focusField('name') ?>


<?php include( $tpl_dir.'footer.tpl.php') ?>