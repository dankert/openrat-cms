<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Frameset//EN">
<html>
<!-- $Id$ -->
<head>
<title><?php echo $title ?></title>
</head>

<frameset rows="20,*" border="0" frameborder="5" framespacing="0" bordercolor="#000000">
     <frame src="<?php echo sid($frame_src_title) ?>" name="cms_title" marginheight="0" marginwidth="0" scrolling="no">
     <frameset cols="<?php echo $tree_width ?>,*" border="0" frameborder="0" framespacing="0" bordercolor="grey">
          <frameset rows="70,*"  border="0" frameborder="0" framespacing="0" bordercolor="#000000">
               <frame src="<?php echo sid($frame_src_treemenu) ?>" name="cms_treemenu" marginheight="0" marginwidth="0" scrolling="no">

               <frame src="<?php echo sid($frame_src_tree) ?>" name="cms_tree" marginheight="0" marginwidth="0" scrolling="auto">
          </frameset>
          <frame src="<?php echo sid($frame_src_main) ?>" name="cms_main" marginheight="0" marginwidth="0" frameborder="0" scrolling="no">
     </frameset>
</frameset>

</html>