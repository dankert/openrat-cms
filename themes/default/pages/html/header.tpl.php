<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<!-- $Id$ -->
<head>
<title><?php echo $cms_title ?></title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<meta name="MSSmartTagsPreventParsing" content="TRUE">
<meta name="robots" content="noindex,nofollow">
<meta http-equiv="expires" content="0">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="pragma" content="no-cache">
<link rel="stylesheet" type="text/css" href="<?php echo $stylesheet ?>">
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

		if ((el.style)&& (el.style.backgroundColor!=null))
		{
			el.style.backgroundColor = "#7B9CBD";      
    		}
	}
}	
function unmark( id )
{
	if( (document.getElementById) && (top.cms_tree.document.getElementById( id )!=null) )
	{
		var el = top.cms_tree.document.getElementById( id );

		if ((el.style)&& (el.style.backgroundColor!=null))
		{
			el.style.backgroundColor = "#dad2b6";      
    		}
	}
}	
//-->
</script>
<?php } ?>


</head>

<body<?php if($css_body_class!="")echo ' class="'.$css_body_class.'"' ?><?php if(isset($id)) echo ' onLoad="mark('."'".$id."'".')" onUnload="unmark('."'".$id."'".')"' ?>>

<?php if   ( $tree_refresh )
      { ?>
<script name="JavaScript">
<!--
top.cms_tree.location.href='tree.<?php echo $conf_php ?>?refresh=1&jo=1&<?php echo session_name() ?>=<?php echo session_id() ?>';
//-->
</script>
<?php } ?>
