<?php
namespace cms\action\configuration;
use cms\action\ConfigurationAction;
use cms\action\Method;
use cms\base\DefaultConfig;
use util\ArrayUtils;
use util\Request;
use util\Session;

class ConfigurationEditAction extends ConfigurationAction {


	public function view() {

		$defaultConfig = DefaultConfig::get();;
		$currentConfig = Request::getConfig();

		$currentConfig['system'] = $this->getSystemConfiguration();

		// Language are to much entries
		unset($currentConfig['language']);

		$pad = str_repeat("\xC2\xA0",10); // Hard spaces

		$flatDefaultConfig = ArrayUtils::dryFlattenArray( $defaultConfig      , $pad );
		$flatCMSConfig     = ArrayUtils::dryFlattenArray( Request::getConfig(), $pad );
		$flatConfig        = ArrayUtils::dryFlattenArray( $currentConfig      , $pad );

		$config = array_map( function($key,$value) use ($flatConfig,$flatCMSConfig,$flatDefaultConfig) {

			if   ( strpos($value['key'],'password') !== false )
				$value['value'] = '**********';

			return ['key'=>$key,'value'=>$value,'class'=>(empty($flatCMSConfig[$key])?'readonly':(isset($flatDefaultConfig[$key]) && $flatDefaultConfig[$key]==$flatConfig[$key]?'default':'changed'))];

		},array_keys($flatConfig),$flatConfig);

		$this->setTemplateVar('config',$config );
	}
}
