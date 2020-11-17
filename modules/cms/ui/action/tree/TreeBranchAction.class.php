<?php
namespace cms\ui\action\tree;
use cms\ui\action\TreeAction;
use cms\action\Method;
class TreeBranchAction extends TreeAction implements Method {
    public function view() {

        $type = $this->getRequestVar('type');

        $branch = $this->loadTreeBranch( $type );

		$this->setTemplateVar( 'branch',$branch );
    }
    public function post() {
    }
}
