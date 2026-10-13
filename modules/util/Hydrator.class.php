<?php
declare(strict_types=1);

namespace util;

use cms\api\ArrayOf;
use InvalidArgumentException;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionType;
use UnitEnum;

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


	public static function map(string $targetClass, array $data): object
	{
		$reflection = new ReflectionClass($targetClass);
		$constructor = $reflection->getConstructor();

		if (!$constructor) {
			$instance = $reflection->newInstanceWithoutConstructor();
			foreach ($data as $key => $value) {
				if ($reflection->hasProperty($key)) {
					$property = $reflection->getProperty($key);
					$property->setValue($instance, self::mapValue($property->getType(), $value));
				}
			}
			return $instance;
		}

		$arguments = [];
		foreach ($constructor->getParameters() as $parameter) {
			$name = $parameter->getName();
			$type = $parameter->getType();

			if (array_key_exists($name, $data)) {
				// PRÜFUNG: Hat der Parameter das #[MapArray]-Attribut?
				$mapArrayAttr = $parameter->getAttributes(ArrayOf::class);

				if (!empty($mapArrayAttr) && is_array($data[$name])) {
					// Wenn ja, mappen wir jedes Element im Array rekursiv
					$targetInnerClass = $mapArrayAttr[0]->newInstance()->className;
					$arguments[] = array_map(
						fn($item) => is_array($item) ? self::map($targetInnerClass, $item) : $item,
						$data[$name]
					);
				} else {
					// Normales Mapping für Einzelwerte/Objekte
					$arguments[] = self::mapValue($type, $data[$name]);
				}
			} elseif ($parameter->isDefaultValueAvailable()) {
				$arguments[] = $parameter->getDefaultValue();
			} else {
				if   ( $parameter->allowsNull() )
					$arguments[] = null;
				else
					throw new InvalidArgumentException("Missing value '$name' in type '$targetClass'");
			}
		}

		return $reflection->newInstanceArgs($arguments);
	}

	private static function mapValue(?ReflectionType $type, mixed $value): mixed
	{
		if (!$type || $value === null) {
			return $value;
		}

		if ($type instanceof ReflectionNamedType && !$type->isBuiltin()) {
			$className = $type->getName();

			if (is_subclass_of($className, UnitEnum::class)) {
				return $className::from($value);
			}

			if (is_array($value)) {
				return self::map($className, $value);
			}
		}

		return $value;
	}

}
