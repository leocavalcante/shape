<?php

namespace Shape;

use TypeError;

class Shape
{
    /** @access private */
    const NULLABLE_PREFIX = '?';

    private $shape;
    private $var;

    public static function factory($type, array $var): Shape
    {
        $shape = is_string($type) && class_exists($type) ? get_class_vars($type) : $type;
        $shape = new self($shape, $var);
        $shape->assert();

        return $shape;
    }

    private function __construct(array $shape, array $var)
    {
        $this->shape = $shape;
        $this->var = $var;
    }

    public function assert(): bool
    {
        foreach ($this->shape as $key => $expectedType) {
            if (! array_key_exists($key, $this->var)) {
                throw new TypeError(sprintf('Missing key: %s', $key));
            }

            $value = $this->var[$key];

            if ($expectedType[0] === self::NULLABLE_PREFIX) {
                $expectedType = substr($expectedType, 1);
                if ($value === null) {
                    continue;
                }
            }

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
    }
}
