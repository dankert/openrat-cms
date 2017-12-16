<?php

function component_tree( $contents )
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
		echo '<img src="'.OR_THEMES_DIR.'default/images/icon_'.$el['type'].'.png" />';
		echo $el['name'];
		echo '</div>';
		
		if	( isset($el['children']) )
		{
			component_tree($el['children'] );
		}
		
		echo  '</li>';
	} 
	echo '</ul>';
}
?>