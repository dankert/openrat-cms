<?php

namespace cms\generator\dsl;

use dsl\context\BaseScriptableObject;
use mqtt\Mqtt;

/**
 * A Proxy for MqTT methods.
 */
class DslMqtt extends BaseScriptableObject
{
	/**
	 * @var Mqtt
	 */
	private $mqtt;


	public function __construct($url,$user,$password )
	{
		$this->mqtt = new Mqtt( $url );
		$this->mqtt->connect( $user, $password );
	}

	public function publish($topic,$value)
	{
		$this->mqtt->publish($topic,$value);
	}

	public function subscribe($topic)
	{
		return $this->mqtt->subscribe($topic);
	}

	public function disconnect()
	{
		$this->mqtt->disconnect();
	}
}