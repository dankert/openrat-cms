<?php
namespace cms\ui\action\tree;
use cms\ui\action\TreeAction;
use cms\action\Method;
use util\Tree;

class TreeBranchAction extends TreeAction implements Method {
    public function view() {

        $type = $this->request->getVar('type');

        $branch = $this->loadTreeBranch( $type );

		$this->setTemplateVar( 'branch',$branch );
    }


    public function post() {
    }


	protected function loadTreeBranch($type )
	{
		$tree = new Tree();

		try
		{
			$method    = new \ReflectionMethod($tree,$type);
			if	( $this->request->has('id'))
				$method->invoke($tree, $this->request->getVar('id') );
			else
				$method->invoke($tree); // <== Executing the Action
		}
		catch (\ReflectionException $re)
		{
			throw new \LogicException('Treemethod not found: '.$type);
		}


		$branch = array();
		foreach($tree->treeElements as $element )
		{
			$branch[] = get_object_vars($element);
		}

		return $branch;
	}

}
