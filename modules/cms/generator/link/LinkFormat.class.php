<?php


namespace cms\generator\link;


use cms\model\BaseObject;

interface LinkFormat
{
	/**
	 * Creates an absolute or relative URL to a node object.
	 *
	 * @param BaseObject $from the actual context
	 * @param BaseObject $to the target object we want to link to
	 * @return string the link to the object
	 */
	public function linkToObject( BaseObject $from, BaseObject $to );
}