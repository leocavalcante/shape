<?php

require_once __DIR__.'/../vendor/autoload.php';

use const Shape\string;
use const Shape\int;
use function Shape\shape;

function string_int_tuple(array $tuple)
{
    return shape([string, int])($tuple);
}

var_dump(string_int_tuple(['one', 1])); // class Shape\Shape

var_dump(string_int_tuple(['one', 'two'])); // TypeError: Key 1 passed to shape() must be of the type integer, string given
