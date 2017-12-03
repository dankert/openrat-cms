<?php

namespace template_engine\components;

class TreeComponent extends Component
{
	public $tree;
	
	public function begin()
	{
		parent::include('tree/component-tree.php');
		echo '<?php component_tree('.$this->value($this->tree).') ?>';
		
	}
}


?>