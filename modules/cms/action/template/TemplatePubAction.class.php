<?php
namespace cms\action\template;
use cms\action\Method;
use cms\action\TemplateAction;
use cms\model\Acl;
use cms\model\Page;
use util\Session;


class TemplatePubAction extends TemplateAction implements Method {
    public function view() {

    }
    public function post() {
		$objectIds = $this->template->getDependentObjectIds();

		Session::close();

		// FIXME use generators
		$publisher = new PublishPublic( $this->template->projectid );
		
		foreach( $objectIds as $objectid )
		{
			$page = new Page( $objectid );
			$page->load();
			
			if	( !$page->hasRight( Acl::ACL_PUBLISH ) )
				continue;
			
			$page->publisher = $publisher;
			$page->publish();
        }

        $this->addNotice('template', 0, $this->template->name, 'PUBLISHED', Action::NOTICE_OK, array(), array_map(function ($obj) {
			return $obj['full_filename'];
		}, $publisher->publishedObjects));

        $publisher->close();
    }
}
