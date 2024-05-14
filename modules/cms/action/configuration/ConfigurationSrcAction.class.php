<?php
namespace cms\action\configuration;
use cms\action\ConfigurationAction;
use cms\action\Method;
use util\Request;
use util\YAML;


class ConfigurationSrcAction extends ConfigurationAction implements Method {
    public function view() {
        $conf = Request::getConfig();
        unset( $conf['language']);

        // Mask passwords.
        array_walk_recursive($conf,function(&$item,$key)
        {
            if($key=='password'){
                $item='*************';
            }
        });

        $this->setTemplateVar('source', YAML::dump($conf,4,0,true));
    }
    public function post() {
    }
}
