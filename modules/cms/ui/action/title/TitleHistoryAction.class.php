<?php
namespace cms\ui\action\title;
use cms\action\Method;
use cms\model\BaseObject;
use cms\ui\action\TitleAction;
use util\Html;
use util\Session;

class TitleHistoryAction extends TitleAction implements Method {
    public function view() {
		$resultList = array();

		$history = Session::get('history');
		
		if	( is_array($history) )
		{
			foreach( array_reverse($history) as $objectid )
			{
				$o = new BaseObject( $objectid );
				$o->load();
				$resultList[$objectid] = array();
				$resultList[$objectid]['url']  = Html::url($o->getType(),'',$objectid);
				$resultList[$objectid]['type'] = $o->getType();
				$resultList[$objectid]['name'] = $o->name;
				$resultList[$objectid]['lastchange_date'] = $o->lastchangeDate;
	
				if	( $o->desc != '' )
					$resultList[$objectid]['desc'] = $o->desc;
				else
					$resultList[$objectid]['desc'] = \cms\base\Language::lang('NO_DESCRIPTION_AVAILABLE');
			}
		}

		$this->setTemplateVar( 'history',$resultList );		
    }
    public function post() {
    }
}
