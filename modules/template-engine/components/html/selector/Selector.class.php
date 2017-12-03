<?php

namespace template_engine\components;

class SelectorComponent extends Component
{

	public $types;

	public $name;

	public $id;

	public $folderid;

	public $param;

	public function begin()
	{
		$types = $this->htmlvalue($this->types);
		$name = $this->htmlvalue($this->name);
		$id = $this->htmlvalue($this->id);
		$folderid = $this->htmlvalue($this->folderid);
		$param = $this->htmlvalue($this->param);
		
		echo <<<HTML
<div class="selector">
<div class="inputholder">
<input type="hidden" name="{$param}" value="{id}" />
<input type="text" disabled="disabled" value="{name}" />
</div>
<div class="tree selector" data-types="{types}" data-init-id="{$id}" data-init-folderid="{$folderid}">
HTML;
	}
}

?>