<?php
declare(strict_types=1);

namespace util;

class Hydrator {
	/**
	 * Konvertiert ein Objekt (und alle darin enthaltenen Objekte/Arrays) rekursiv in ein Array.
	 */
	public static function toArray($data) {
		// Wenn es ein Objekt ist, holen wir uns die sichtbaren Eigenschaften
		if (is_object($data)) {
			$data = get_object_vars($data);
		}

		// Wenn es ein Array ist (oder durch get_object_vars dazu wurde), gehen wir tiefer
		if (is_array($data)) {
			$result = [];
			foreach ($data as $key => $value) {
				$result[$key] = self::toArray($value); // Rekursiver Aufruf
			}
			return $result;
		}

		// Skalare Werte (string, int, bool) werden einfach zurückgegeben
		return $data;
	}
}
