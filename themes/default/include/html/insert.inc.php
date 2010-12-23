<!-- This line will be ignored by the template compiler --><?php die() ?>

/* #IF-ATTR file# */
<?php include( $tpl_dir.basename($attr_file  ).'.tpl.php'); ?>
/* #END-IF# */

/* #IF-ATTR script# */
<?php
$attr_tmp_file = $tpl_dir.'../../js/'.basename($attr_script).'.js';
if	(!$attr_inline)
{
	?><script src="<?php echo $attr_tmp_file ?>" type="text/javascript"></script><?php 
}
else
{
	echo '<script type="text/javascript">';
	// Sehr einfaches Minifizieren des Java-Skriptes.
	echo str_replace('  ',' ',str_replace('~','',strtr(implode('',file($attr_tmp_file)),"\t\n\b",'~~~')));
	echo '</script>';
}
?>
/* #END-IF# */

/* #IF-ATTR url# */
<iframe src="<?php echo $attr_url ?>"></iframe>
/* #END-IF# */
