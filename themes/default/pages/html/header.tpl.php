<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<!-- $Id$ -->
<head>
  <title><?php echo $cms_title ?></title>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <meta name="MSSmartTagsPreventParsing" content="true" />
  <meta name="robots" content="noindex,nofollow" />
  <meta http-equiv="expires" content="0" />
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="pragma" content="no-cache" />
  <link rel="stylesheet" type="text/css" href="<?php echo $stylesheet ?>" />
<?php if (isset($request_timeout))
      { ?>
  <meta http-equiv="refresh" content="<?php echo $refresh_timeout ?>;url=<?php echo $refresh_url ?>">
<?php } ?>

<?php if (isset($id))
      {
?>
<script language="JavaScript" type="text/javascript">
<!--
function mark( id )
{
	if( (document.getElementById) && (top.cms_tree.document.getElementById( id )!=null) )
	{
		var el = top.cms_tree.document.getElementById( id );

		el.className="mark";      
	}
}	
function unmark( id )
{
	if( (document.getElementById) && (top.cms_tree.document.getElementById( id )!=null) )
	{
		var el = top.cms_tree.document.getElementById( id );

		//if ((el.style)&& (el.style.backgroundColor!=null))
		//{
			el.className="";      
    		//}
	}
}	
//-->
</script>
<?php } ?>


</head>

<body<?php if( isset($css_body_class) )echo ' class="'.$css_body_class.'"' ?><?php if(isset($id)) echo ' onLoad="mark('."'".$id."'".')" onUnload="unmark('."'".$id."'".')"' ?>>

<?php if   ( isset($tree_refresh) )
      { ?>
<script name="JavaScript" type="text/javascript">
<!--
//top.cms_tree.location.href='<?php echo Html::url(array('action'=>'tree','subaction'=>'reload',session_name()=>session_id())) ?>';
//-->
</script>
<?php } ?>


<?php if (isset($message))
      { ?>
<!-- $Id$ -->
<center>

<table class="main" width="98%" cellspacing="0" cellpadding="4">
  <tr>
    <th><?php echo $title ?></th>
  </tr>
  <tr>
    <td class="message"><?php echo $message ?>
    
    <?php if ($info!='')
             echo '<br /><br /><br /><strong>'.lang('ADDITIONAL_INFO').'</strong><pre>'.htmlentities($info).'</pre>';
    ?>
    </td>
  </tr>

</table>

</center>

<?php } ?>



<?php if (isset($notices) && count($notices)>0 )
      { ?>
<!-- $Id$ -->
<center>

<table class="main" width="99%" cellspacing="0" cellpadding="4">

  <tr>
    <th colspan="3"><?php echo lang('GLOBAL_NOTICES') ?></th>
  </tr>

  <?php foreach( $notices as $notice ) { ?>
  <tr>
    <td class="f1"><img src="<?php echo $image_dir.'icon_'.$notice['type'] ?>.png" align="left" /><?php echo $notice['name'] ?></td>
    <td class="f1"><img src="<?php echo $image_dir.$notice['status'].'.gif' ?>" align="left" />
                   <strong><?php echo $notice['text'] ?></strong></td>
  </tr>
  <?php } ?>

</table>

</center>

<?php } ?>
