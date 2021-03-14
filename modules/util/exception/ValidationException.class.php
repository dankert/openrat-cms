<?php

namespace util\exception;
use Exception;

class ValidationException extends UIException
{
	public $fieldName;

	// Die Exception neu definieren, damit die Mitteilung nicht optional ist
	public function __construct($fieldName,$key='COMMON_VALIDATION_ERROR',$params = [] )
	{
		$this->fieldName = $fieldName;

		// sicherstellen, dass alles korrekt zugewiesen wird
		parent::__construct($key, '', $params );
	}

	// maßgeschneiderte Stringdarstellung des Objektes
	public function __toString()
	{
		return __CLASS__ . ": " . $this->fieldName . ": '{$this->message}' in {$this->file}({$this->line})\n"
			. "{$this->getTraceAsString()}\n";
	}

}