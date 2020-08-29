<?php

namespace util\exception;
use Exception;

class UIException extends Exception
{
	public $key;

	// Die Exception neu definieren, damit die Mitteilung nicht optional ist
	public function __construct($key, $message, Exception $previous = null)
	{

		$this->key = $key;

		// sicherstellen, dass alles korrekt zugewiesen wird
		parent::__construct($message, 0, $previous);
	}

	// maßgeschneiderte Stringdarstellung des Objektes
	public function __toString()
	{
		return __CLASS__ . ": " . $this->key . " [{$this->code}]: '{$this->message}' in {$this->file}({$this->line})\n"
			. "{$this->getTraceAsString()}\n";
	}

}


?>