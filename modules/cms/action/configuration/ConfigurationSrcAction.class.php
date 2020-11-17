<?php
namespace cms\action\configuration;
use cms\action\ConfigurationAction;
use cms\action\Method;
use util\Session;


class ConfigurationSrcAction extends ConfigurationAction implements Method {
    public function view() {
        $conf = Session::getConfig();
        unset( $conf['language']);

        // Mask passwords.
        array_walk_recursive($conf,function(&$item,$key)
        {
            if($key=='password'){
                $item='*************';
            }
        });

        $this->setTemplateVar('source', \util\YAML::dump($conf,4,0,true));
    }
    public function post() {
    }
}
