<?php include( $tpl_dir.'header.tpl.'.$conf_php ) ?>

<!-- $Id$ -->

<table cellpadding="0" cellspacing="0" border="0">

<?php foreach( $zeilen as $z )
      { ?>
<tr>

<?php if   (is_array($z['cols'])) foreach( $z['cols'] as $i )
      { ?>
<td width="1%"><img src="<?php echo $image_dir.'tree_'.$i ?>.gif" border="0"></td>
<?php } ?>

<td width="1%">
<?php if (isset($z['image_url'])) { ?><a href="<?php echo $z['image_url'].'#'.$z['name'] ?>" class="tree" target="_self"><?php } ?><img src="<?php echo $image_dir.'tree_'.$z['image'] ?>.gif" border=""><?php if (isset($z['image_url'])) { ?></a><?php } ?>
</td>

<td colspan="20" id="<?php echo $z['name'] ?>" valign="middle" style="white-space:nowrap;">
<a name="<?php echo $z['name'] ?>"></a>
<?php if (isset($z['url'])) { ?><a href="<?php echo $z['url'] ?>" <?php if($z['desc']!='') echo 'title="'.$z['desc'].'" ' ?>class="tree" target="<?php echo $z['target'] ?>"><?php } ?><img src="<?php echo $image_dir.'icon_'.$z['icon'] ?>.png" border="0" align="left"><?php echo $z['text'] ?><?php if (isset($z['url'])) { ?></a><?php if(isset($z['add'])) echo '&nbsp;<small>'.$z['add'].'<small>' ?><?php } ?>
</td>

</tr>
<?php } ?>

</table>

<br><br>

<?php include( $tpl_dir.'footer.tpl.'.$conf_php ) ?>