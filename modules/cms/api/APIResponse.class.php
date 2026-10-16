<?php

namespace cms\api;

class APIResponse
{
	public function __construct (
		public string $message,
		#[ArrayOf(Notice::class)]
		public array $notices,
		public array $errors,
		public string $status,
		public string $notice_status,
		public bool $success,
		public Session $session,
		public string $version,
		public int $api,
		public Exception|null $cause,
	){
	}

}