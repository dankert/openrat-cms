<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<form action="<?php echo $self ?>" method="post" target="_self">
<input type="hidden" name="subaction" value="add">

<table class="main" width="50%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('TEMPLATES') ?></th>
</tr>

<?php $f1=true;
	 $fx='';
      foreach( $templates as $id=>$e )
      {
      	$fx = fx( $fx ); ?>
<tr>
<td class="<?php echo $fx ?>"><a href="<?php echo $e['url'] ?>" target="cms_main"><?php echo $e['name'] ?></a></td>
</tr>
<?php } ?>

<tr>
<td class="act"><input type="text" name="name" value="">&nbsp;<input type="submit" class="submit" value="<?php echo lang('ADD') ?>"></td>
</tr>

</table>

</form>

<script name="JavaScript" type="text/javascript"><!--
document.forms[0].name.focus();
//--></script>
</center>
<?php include( $tpl_dir.'footer.tpl.php') ?>