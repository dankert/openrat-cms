
<!-- 
<div id="shortcuts">
<?php 
$icons = @$viewconfig['icons'];
if (false&&!empty($icons))
{
	foreach( explode(',',$icons) as $name )
	{
		echo "<div class=\"shortcut\" title=\"".lang('ACTION_'.$name)."\" onClick=\"javascript:openNewAction('".lang('ACTION_'.$name)."','$name','','');\"><img src=\"".OR_THEMES_EXT_DIR.'/default/images/icon_'.$name.'.png'."\" /></div>";
	}
} 
?>

</div>
 -->

<div class="bar" id="navigationbar">
<?php 
view_header('tree');
?>
</div>

<div class="bar" id="contentbar">
<?php 
view_header('content');
?>
</div>

<div class="bar" id="sidebar">
<?php 
view_header('side');
?>
</div>

<div class="bar" id="bottombar">
<?php 
view_header('bottom');
?>
</div>

</div>
