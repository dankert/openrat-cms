
/* #IF-ATTR file# */
<?php include( $tpl_dir.basename($attr_file  ).'.tpl.php'); ?>
/* #END-IF# */

/* #IF-ATTR script# */
<script src="<?php echo OR_THEMES_DIR.$conf['interface']['theme'].'/js/'.basename($attr_script).'.js' ?>" type="text/javascript"></script>
/* #END-IF# */
