<?php


namespace cms\generator\link;


use cms\model\BaseObject;

interface LinkFormat
{
	public function linkToObject( BaseObject $from, BaseObject $to );
}