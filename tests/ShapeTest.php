<?php

namespace Shape\Test;

use const Shape\bool;
use const Shape\float;
use const Shape\int;
use const Shape\string;
use const Shape\arr;

use DateTime;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use TypeError;
use Shape\Shape;

use function Shape\shape;
use function Shape\nullable;

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

        shape(['foo' => bool])(['foo' => null]);
    }

    public function testInteger()
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionMessage('Key foo passed to shape() must be of the type integer, NULL given');

        shape(['foo' => int])(['foo' => null]);
    }

    public function testDouble()
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionMessage('Key foo passed to shape() must be of the type double, NULL given');

        shape(['foo' => float])(['foo' => null]);
    }

    public function testString()
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionMessage('Key foo passed to shape() must be of the type string, NULL given');

        shape(['foo' => string])(['foo' => null]);
    }

    public function testArr()
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionMessage('Key foo passed to shape() must be of the type array, NULL given');

        shape(['foo' => arr])(['foo' => null]);
    }

    public function testInterface()
    {
        $this->assertInstanceOf(Shape::class, shape(['foo' => FixtureInterface::class])(['foo' => new Fixture()]));
    }

    public function testAbstractClass()
    {
        $this->assertInstanceOf(Shape::class, shape(['foo' => AbstractFixture::class])(['foo' => new Fixture()]));
    }

    public function testClass()
    {
        $this->assertInstanceOf(Shape::class, shape(['foo' => Fixture::class])(['foo' => new Fixture()]));
    }

    public function testNullable()
    {
        $this->assertInstanceOf(Shape::class, shape(['foo' => nullable('string')])(['foo' => null]));
    }
}
