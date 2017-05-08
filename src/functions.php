<?php

namespace Shape;

use Closure;

/**
 * Returns a Closure to perform type checking against its first argument using the given $type.
 *
 * @param array|string $type
 * @return Closure -> array -> Shape
 */
function shape($type): Closure
{
    return function (array $var) use ($type) {
        return Shape::factory($type, $var);
    };
}

function nullable(string $type): string
{
    return '?'.$type;
}
