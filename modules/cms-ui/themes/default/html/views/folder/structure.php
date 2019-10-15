<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		<div class="structure tree">
			<?php include_once( 'modules/template-engine/components/html/tree/component-tree.php') ?><?php component_tree($outline) ?>
			
		</div>
	