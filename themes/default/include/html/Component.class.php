<?php

abstract class Component
{

	/**
	 * Gets the beginning of this component.
	 * @return string
	 */
	public function getBegin()
	{
		ob_start();
		$this->begin();
		$src = ob_get_contents();
		ob_end_clean();
		return $src;
	}

	public function getEnd()
	{
		ob_start();
		$this->end();
		$src = ob_get_contents();
		ob_end_clean();
		return $src;
	}

	/**
	 * Outputs the beginning of this component.
	 */
	protected function begin()
	{}

	protected function end()
	{}
}

?>