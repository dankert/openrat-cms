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
		echo '<div class="entry clickable'.($selected?' selected':'').'"';
        echo ' data-name="'.$el['name'].'"';
        echo ' data-action="'.$el['type'].'"';
        echo ' data-id="'.$el['id'].'"';
        echo '>';
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