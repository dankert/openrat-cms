<?php
namespace cms\action\configuration;
use cms\action\ConfigurationAction;
use cms\action\Method;
use cms\base\DefaultConfig;
use util\Session;

class ConfigurationEditAction extends ConfigurationAction implements Method {


	public function view() {

		$defaultConfig = DefaultConfig::get();;
		$currentConfig = Session::getConfig();

		$currentConfig['system'] = $this->getSystemConfiguration();

		// Language are to much entries
		unset($currentConfig['language']);

		$pad = str_repeat("\xC2\xA0",10); // Hard spaces

		$flatDefaultConfig = \util\ArrayUtils::dryFlattenArray( $defaultConfig      , $pad );
		$flatCMSConfig     = \util\ArrayUtils::dryFlattenArray( Session::getConfig(), $pad );
		$flatConfig        = \util\ArrayUtils::dryFlattenArray( $currentConfig      , $pad );

		$config = array_map( function($key,$value) use ($flatConfig,$flatCMSConfig,$flatDefaultConfig) {

			if   ( strpos($key,'password') !== false )
				$value = '*';

			return ['key'=>$key,'value'=>$value,'class'=>(empty($flatCMSConfig[$key])?'readonly':(isset($flatDefaultConfig[$key]) && $flatDefaultConfig[$key]==$flatConfig[$key]?'default':'changed'))];

		},array_keys($flatConfig),$flatConfig);

		$this->setTemplateVar('config',$config );
	}


    public function post() {
    }
}
