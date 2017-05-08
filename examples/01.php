<?php

require_once __DIR__.'/../vendor/autoload.php';

use const Shape\int;
use function Shape\shape;

$pointShape = shape([
    'x' => int,
    'y' => int,
]);

$validPoint = ['x' => 1, 'y' => 2];

$pointShape($validPoint); // Shape

$invalidPoint = ['x' => 1, 'y' => 'two'];

$pointShape($invalidPoint); // TypeError: Key y passed to shape() must be of the type integer, string given
