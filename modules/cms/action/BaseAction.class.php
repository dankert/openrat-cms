<?php


namespace cms\action;

use util\exception\ClientException;

/**
 */
abstract class BaseAction extends Action implements Method
{

	public function __construct()
	{
		parent::__construct();
	}


	/**
	 * @throws ClientException
	 */
	public function post()
	{
		throw new ClientException("Bad Method");
	}

	/**
	 * @throws ClientException
	 */
	public function view()
	{
		throw new ClientException("Bad Method");
	}
}