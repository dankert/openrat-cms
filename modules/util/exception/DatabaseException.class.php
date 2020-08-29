<?php

namespace util\exception;
use Exception;

class DatabaseException extends Exception {

	// Die Exception neu definieren, damit die Mitteilung nicht optional ist
	public function __construct($message, Exception $previous = null)
	{
		parent::__construct($message, 0, $previous);
	}
}
