<?php

require_once __DIR__.'/../vendor/autoload.php';

use const Shape\int;
use function Shape\shape;

$points = [
    ['x' => 1, 'y' => 2],
    ['x' => 3, 'y' => 4],
];

array_map(shape(['x' => int, 'y' => int]), $points);
