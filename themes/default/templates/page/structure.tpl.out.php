<!-- Compiling output/output-begin @ Wed, 29 Nov 2017 00:51:13 +0100 --><!-- Compiling part/part-begin @ Wed, 29 Nov 2017 00:51:13 +0100 --><?php $a2_class='structure tree'; ?><div class="<?php echo $a2_class ?>"><?php unset($a2_class) ?><!-- Compiling tree/tree-begin @ Wed, 29 Nov 2017 00:51:13 +0100 --><?php $a3_tree=$outline; ?><?php showList($a3_tree);
function showList( $contents )
{
	echo '<ul class="tree">';
	foreach( $contents as $key=>$el) {
		$selected = isset($el['self']);
		if	($selected )
			echo '<li class="">';
		else
			echo '<li>';
		echo '<div class="tree" />';
		echo '<div class="entry '.($selected?' selected':'').'" onclick="javascript:openNewAction( \''.$el['name'].'\',\''.$el['type'].'\',\''.$el['id'].'\',0 );">';
		echo '<img src="'.OR_THEMES_EXT_DIR.'default/images/icon_'.$el['type'].'.png" />';
		echo $el['name'];
		echo '</div>';
		if	( isset($el['children']) )
		{
			showList($el['children'] );
		}
		echo  '</li>';
	} 
	echo '</ul>';
}
?><?php unset($a3_tree) ?><!-- Compiling part/part-end @ Wed, 29 Nov 2017 00:51:13 +0100 --></div>