<?php

namespace template_engine\components;

use modules\template_engine\CMSElement;

class SelectorComponent extends Component
{

	public $types;

	public $name;

	public $id;

	public $folderid;

	public $param;

	public function createElement()
	{
		return new CMSElement(null);
	}

	public function unused____begin()
	{
		$types = mlvalue($this->types);
		$name = $this->htmlvalue($this->name);
		$id = $this->htmlvalue($this->id);
		$folderid = $this->htmlvalue($this->folderid);
		$param = $this->htmlvalue($this->param);
		
		echo <<<HTML
<div class="selector">
<div class="inputholder or-droppable">
<input type="hidden" class="or-selector-link-value" name="{$param}" value="{$id}" />
<input type="text" class="or-selector-link-name" value="{$name}" placeholder="{$name}" />
</div>
<div class="dropdown"></div>
<div class="tree selector" data-types="{types}" data-init-id="{$id}" data-init-folderid="{$folderid}">
</div>
</div>
HTML;
	}
}

?>