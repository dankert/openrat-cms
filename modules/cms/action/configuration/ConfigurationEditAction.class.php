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

		//$flatDefaultConfig = ArrayUtils::flatArray( $defaultConfig       );
		//$flatCMSConfig     = ArrayUtils::flatArray( Request::getConfig() );
		//$flatConfig        = ArrayUtils::flatArray( $currentConfig       );
		$flatConfig        = $currentConfig;

		array_walk_recursive($flatConfig,function(&$item,$key)
		{
			if  ( strpos($key,'password') !== false) {
				$item='*************';
			}
		});

		/*
		$config = array_map( function($key,$value) use ($flatConfig,$flatCMSConfig,$flatDefaultConfig) {

			if   (  )
				$value['value'] = '**********';

			return ['label'=>$label,'key'=>$key,'value'=>$value['value'],'class'=>(empty($flatCMSConfig[$key])?'readonly':(isset($flatDefaultConfig[$key]) && $flatDefaultConfig[$key]==$flatConfig[$key]?'default':'changed'))];

		},array_keys($flatConfig),$flatConfig);
		*/

		$this->setTemplateVar('config',$flatConfig );
	}
}
