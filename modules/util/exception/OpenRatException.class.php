<?php

namespace util\exception;
use Exception;

class OpenRatException extends Exception
{
	public $key;

	// Die Exception neu definieren, damit die Mitteilung nicht optional ist
	public function __construct($key, $message, $code = 0, Exception $previous = null)
	{

		$this->key = $key;

		// sicherstellen, dass alles korrekt zugewiesen wird
		parent::__construct($message, $code, $previous);
	}

	// maßgeschneiderte Stringdarstellung des Objektes
	public function __toString()
	{
		return __CLASS__ . ": " . $this->key . " [{$this->code}]: '{$this->message}' in {$this->file}({$this->line})\n"
			. "{$this->getTraceAsString()}\n";
	}

}


?>