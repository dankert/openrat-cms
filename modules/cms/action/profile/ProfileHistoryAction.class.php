<?php
namespace cms\action\profile;
use cms\action\Method;
use cms\action\ProfileAction;
use cms\model\BaseObject;

class ProfileHistoryAction extends ProfileAction implements Method {
    public function view() {
        $lastChanges = $this->user->getLastChanges( time()-(60*60*24*365*1) );

        $timeline = array();

        foreach( $lastChanges as $entry )
        {
            $timeline[ $entry['objectid'] ] = $entry;
            $baseObject = new BaseObject( $entry['objectid']);
            $baseObject->objectLoad();
            $timeline[ $entry['objectid'] ]['type'] = $baseObject->getType();
        }
        $this->setTemplateVar('timeline', $timeline);
    }


    public function post() {
    }
}
