<?php

namespace cms\api;

/**
 * Event which happens in the CMS.
 */
class Event
{
	public function __construct (

		/**
		 * What type of object
		 */
		public string $type,

		/**
		 * The Id of the object
		 */
		public int $id,

		/**
		 * What happens
		 */
		public string $event,

		/**
		 * A description
		 */
		public string $description,
	){
	}

}