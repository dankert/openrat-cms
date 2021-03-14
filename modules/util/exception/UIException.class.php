<?php

namespace util\exception;
use Exception;

class UIException extends Exception
{
	public $key;

	public $params;

	// Die Exception neu definieren, damit die Mitteilung nicht optional ist
	public function __construct($key, $message, $params, Exception $previous = null)
	{

		$this->key    = $key;
		$this->params = $params;

		// sicherstellen, dass alles korrekt zugewiesen wird
		parent::__construct($message, 0, $previous);
	}

	// maßgeschneiderte Stringdarstellung des Objektes
	public function __toString()
	{
		return __CLASS__ . ": " . $this->key . ": '{$this->message}' in {$this->file}({$this->line})\n"
			. "{$this->getTraceAsString()}\n".($this->getPrevious()?'Caused by: '.$this->getPrevious()->__toString():'');
	}

}


?>