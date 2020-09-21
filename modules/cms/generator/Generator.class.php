<?php


namespace cms\generator;


interface Generator
{
	public function getCache();

	public function getPublicFilename();
}