<?php

namespace Shape;

use Closure;
use TypeError;

const Bool = 'boolean';
const Boolean = 'boolean';
const Int = 'integer';
const Integer = 'integer';
const Float = 'double';
const Double = 'double';
const String = 'string';
const Arr = 'array';

/**
 * Returns a Closure to perform type checking against its first argument using the given $type.
 *
 * @param array|string $type
 * @return Closure -> array -> bool
 */
function shape($type): Closure
{
    $shape = is_string($type) && class_exists($type) ? get_class_vars($type) : $type;

    return function (array $var) use ($shape): bool {
        foreach ($shape as $key => $expectedType) {
            if (! array_key_exists($key, $var)) {
                throw new TypeError(sprintf('Missing key: %s', $key));
            }

            $value = $var[$key];

            if (is_object($value)) {
                if (! ($value instanceof $expectedType)) {
                    throw new TypeError(
                        sprintf(
                            'Key %s passed to shape() must be of the type %s, %s given',
                            $key,
                            $expectedType,
                            get_class($value)
                        )
                    );
                }

                continue;
            }

            $valueType = gettype($value);

            if ($valueType !== $expectedType) {
                throw new TypeError(
                    sprintf(
                        'Key %s passed to shape() must be of the type %s, %s given',
                        $key,
                        $expectedType,
                        $valueType
                    )
                );
            }
        }

        return true;
    };
}
