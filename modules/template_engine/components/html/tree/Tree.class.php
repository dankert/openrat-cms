<?php

namespace template_engine\components;

use template_engine\components\html\Component;
use template_engine\element\CMSElement;

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