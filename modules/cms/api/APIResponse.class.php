<?php

namespace cms\api;

class APIResponse
{
	public function __construct (
		public array $notices,
		public array $errors,
		public string $status,
		public string $notice_status,
		public bool $success,
		public string $session,
		public string $version,
		public string  $api,
	){
	}

}