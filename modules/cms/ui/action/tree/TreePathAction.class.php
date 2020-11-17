<?php
namespace cms\ui\action\tree;
use cms\action\RequestParams;
use cms\ui\action\TreeAction;
use cms\action\Method;
class TreePathAction extends TreeAction implements Method {
    public function view() {
		$type = $this->getRequestVar('type');
		$id = $this->getRequestVar('id', RequestParams::FILTER_ALPHANUM);

		$result = $this->calculatePath($type, $id);
		$this->setTemplateVar('path', $result);

		$name = $this->calculateName($type, $id);
		$this->setTemplateVar('actual', $this->pathItem($type, $id, $name));
    }
    public function post() {
    }
}
