<?php
namespace cms\ui\action\tree;
use cms\action\RequestParams;
use cms\model\BaseObject;
use cms\model\Element;
use cms\model\Folder;
use cms\model\Language;
use cms\model\Model;
use cms\model\ModelFactory;
use cms\model\Page;
use cms\model\Template;
use cms\ui\action\TreeAction;
use cms\action\Method;

/**
 * Calculating a path to an object, normally used for a breadcrumb navigation.
 */
class TreePathAction extends TreeAction implements Method {

    public function view() {
		$type = $this->request->getVar('type');
		$id   = $this->request->getVar('id', RequestParams::FILTER_ALPHANUM);

		// Calculating the path to the actual object
		$result = $this->calculatePath($type, $id);
		$this->setTemplateVar('path', $result);

		// The parent object
		$this->setTemplateVar('parent', end($result ) );

		// The actual object
		$name = $this->calculateName($type, $id);
		$this->setTemplateVar('actual', $this->pathItem($type, $id, $name));
    }


    public function post() {
    }


	/**
	 * The path to an object.
	 */
	protected function calculatePath($type, $id) {

		switch( $type ) {

			case 'index':
				return array(
				);

			case 'projectlist':
				return array(
					$this->pathItem('index',0)
				);

			case 'configuration':
				return array(
					$this->pathItem('index',0)
				);

			case 'project':
				return array(
					$this->pathItem('index'       ,0  ),
					$this->pathItem('projectlist',0)
				);
			case 'folder':
			case 'link'  :
			case 'url'   :
			case 'page'  :
			case 'file'  :
			case 'image' :
			case 'text' :
				$o = new BaseObject( $id );
				$o->load();

				$result= array(
					$this->pathItem('index'       ,0  ),
					$this->pathItem('projectlist' ),
					$this->pathItem('project'   , $o->projectid),
				);

				$parents = array_keys( $o->parentObjectFileNames(true) );
				foreach( $parents as $pid )
				{
					$f = new Folder($pid);
					$f->load();
					$result[] = $this->pathItem('folder'  ,$pid,$f->filename );
				}
				return $result;

			case 'pageelement' :

				$ids = explode('_',$id);
				if	( count($ids) > 1 )
				{
					list( $pageid, $elementid ) = $ids;
				}

				$p = new Page($pageid);
				$p->load();

				$result= array(
					$this->pathItem('index'       ,0  ),
					$this->pathItem('projectlist' ),
					$this->pathItem('project'   , $p->projectid),
				);

				$parents = array_keys( $p->parentObjectFileNames(true ) );
				foreach( $parents as $pid ) {
					$f = new Folder($pid);
					$f->load();
					$result[] = $this->pathItem('folder'  ,$pid,$f->filename );
				}
				$result[] = $this->pathItem('page'  ,$id,$p->filename );
				return $result;

			case 'userlist':
				return array(
					$this->pathItem('index'       ,0  ),
					$this->pathItem('usergroup' ,0)
				);
			case 'usergroup':
				return array(
					$this->pathItem('index' ,0)
				);
			case 'user':
				return array(
					$this->pathItem('index'      ,0  ),
					$this->pathItem('usergroup'  ,0),
					$this->pathItem('userlist'   ,0)
				);
			case 'grouplist':
				return array(
					$this->pathItem('index'       ,0  ),
					$this->pathItem('usergroup'   ,0)
				);
			case 'group':
				return array(
					$this->pathItem('index'       ,0  ),
					$this->pathItem('usergroup'   ,0),
					$this->pathItem('grouplist'   ,0),
				);

			case 'templatelist':
			case 'languagelist':
			case 'modellist':
				return array(
					$this->pathItem('index'       ,0  ),
					$this->pathItem('projectlist' ,0  ),
					$this->pathItem('project'     ,$id)
				);

			case 'template':
				$t = new Template( $id );
				$t->load();

				return array(
					$this->pathItem('index'       ,0  ),
					$this->pathItem('projectlist' ,0        ),
					$this->pathItem('project'     ,$t->projectid),
					$this->pathItem('templatelist',$t->projectid)
				);

			case 'element':
				$e = new Element( $id );
				$e->load();
				$t = new Template( $e->templateid );
				$t->load();

				return array(
					$this->pathItem('index'       ,0  ),
					$this->pathItem('projectlist' ,0         ),
					$this->pathItem('project'     ,$t->projectid ),
					$this->pathItem('templatelist',$t->projectid ),
					$this->pathItem('template'    ,$t->templateid,$t->name)
				);

			case 'language':
				$l = new Language( $id );
				$l->load();

				return array(
					$this->pathItem('index'       ,0  ),
					$this->pathItem('projectlist' ,0  ),
					$this->pathItem('project'     ,$l->projectid),
					$this->pathItem('languagelist',$l->projectid)
				);

			case 'model':
				$m = new Model( $id );
				$m->load();

				return array(
					$this->pathItem('index'       ,0  ),
					$this->pathItem('projectlist' ,0        ),
					$this->pathItem('project'     ,$m->projectid),
					$this->pathItem('modellist'   ,$m->projectid)
				);

			default:
				throw new \InvalidArgumentException('Unknown type: '.$type);
		}
	}


	protected function pathItem($action, $id = 0, $name = '' ) {
		return array('type'=>$this->typeToInternal($action),'action'=>$action ,'id'=>$id,'name'=>$name  );
	}


	private function typeToInternal($type)
	{
		switch( $type) {

			case 'projectlist':
				return 'projects';

			case 'userlist':
				return 'users';

			case 'grouplist':
				return 'groups';

			case 'templatelist':
				return 'templates';

			case 'languagelist':
				return 'languages';

			case 'modellist':
				return 'models';

			default:
				return $type;
		}

	}

	/**
	 * @param $type
	 * @param $id
	 * @return string
	 */
	protected function calculateName($type, $id)
	{
		$o = ModelFactory::create($type, $id);

		if ($o) {
			$o->load();
			$name = $o->getName();
		}
		else{
			//$name = \cms\base\Language::lang($type);
			$name = '';
		}
		return $name;
	}

}
