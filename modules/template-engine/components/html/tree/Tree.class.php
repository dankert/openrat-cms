<?php

namespace template_engine\components;

use modules\template_engine\CMSElement;

class TreeComponent extends Component
{
	public $tree;

	public function createElement()
	{
		return new CMSElement(null);
	}

	public function unsed__begin()
	{
		parent::includeResource('tree/component-tree.php');
		echo '<?php component_tree('.$this->value($this->tree).') ?>';
	}
}