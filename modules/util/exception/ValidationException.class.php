<?php

namespace util\exception;
use Exception;

class ValidationException extends Exception
{
	public $fieldName;

	// Die Exception neu definieren, damit die Mitteilung nicht optional ist
	public function __construct($fieldName)
	{

		$this->fieldName = $fieldName;

		// sicherstellen, dass alles korrekt zugewiesen wird
		parent::__construct('Field validation: ' . $fieldName, 0, null);
	}

	// maßgeschneiderte Stringdarstellung des Objektes
	public function __toString()
	{
		return __CLASS__ . ": " . $this->fieldName . ": '{$this->message}' in {$this->file}({$this->line})\n"
			. "{$this->getTraceAsString()}\n";
	}

}


?>