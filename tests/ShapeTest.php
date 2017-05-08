<?php

namespace Shape\Test;

use const Shape\Bool;
use const Shape\Float;
use const Shape\Int;
use const Shape\String;
use const Shape\Arr;

use DateTime;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use TypeError;

use function Shape\shape;

class ShapeTest extends TestCase
{
    public function testMissingKey()
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionMessage('Missing key: foo');

        shape(['foo' => 'bar'])(['baz' => 'qux']);
    }

    public function testObject()
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionMessage('Key foo passed to shape() must be of the type DateTimeImmutable, DateTime given');

        shape(['foo' => DateTimeImmutable::class])(['foo' => new DateTime()]);
    }

    public function testBoolean()
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionMessage('Key foo passed to shape() must be of the type boolean, NULL given');

        shape(['foo' => Bool])(['foo' => null]);
    }

    public function testInteger()
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionMessage('Key foo passed to shape() must be of the type integer, NULL given');

        shape(['foo' => Int])(['foo' => null]);
    }

    public function testDouble()
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionMessage('Key foo passed to shape() must be of the type double, NULL given');

        shape(['foo' => Float])(['foo' => null]);
    }

    public function testString()
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionMessage('Key foo passed to shape() must be of the type string, NULL given');

        shape(['foo' => String])(['foo' => null]);
    }

    public function testArr()
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionMessage('Key foo passed to shape() must be of the type array, NULL given');

        shape(['foo' => Arr])(['foo' => null]);
    }
}
