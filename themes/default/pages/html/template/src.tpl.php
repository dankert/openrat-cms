<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<form action="<?php echo $self ?>" method="post" target="_self">
<input type="hidden" name="subaction" value="srcsave">

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th><?php echo lang('SOURCE') ?></th>
</tr>

<tr>
<td class="f1"><textarea rows="25" cols="80" name="src"><?php echo $text ?></textarea></td>
</tr>

<?php if ( count($elements)>0 )
      { ?>
<tr>
<td class="f2"><input type="checkbox" name="addelement" value="1">
               <?php echo lang('ADD') ?>
               <?php echo Html::selectBox('elementid',$elements) ?></td>
</tr>
<?php } ?>

<?php if ( count($icon_elements)>0 )
      { ?>
<tr>
<td class="f2"><input type="checkbox" name="addicon" value="1">
               <?php echo lang('ADD') ?>
               <?php echo Html::selectBox('iconid',$icon_elements) ?></td>
</tr>
<?php } ?>

<tr>
<td class="act"><input type="submit" class="submit" value="<?php echo lang('SAVE') ?>"></td>
</tr>

</table>

</form>

</center>

<script name="JavaScript" type="text/javascript"><!--
document.forms[0].src.focus();
//--></script>

<?php include( $tpl_dir.'footer.tpl.php') ?>