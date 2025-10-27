<?php

// Запуск теста ../vendor/bin/phpunit calculatorTest.php

use PHPUnit\Framework\TestCase;

require_once 'calculator.php';

class CalculatorTest extends TestCase
{
    public function testAdd()
    {
        $this->assertEquals(3, add(2, 1));
        $this->assertEquals(0, add(0, 0));
        $this->assertEquals(-100, add(-101, 1));
    }

    public function testSubtract()
    {
        $this->assertEquals(1, subtract(3, 2));
        $this->assertEquals(-1, subtract(102,103));
        $this->assertEquals(0, subtract(5, 5));
    }

    public function testMultiply()
    {
        $this->assertEquals(16, multiply(2, 8));
        $this->assertEquals(0, multiply(5, 0));
        $this->assertEquals(-16, multiply(2, -8));
    }

    public function testDivide()
    {
        $this->assertEquals(2, divide(6, 3));
        $this->assertEquals(2.5, divide(5, 2));
        $this->assertEquals(-2, divide(-6, 3));
    }

    public function testDivideByZero()
    {
        $this->expectException(InvalidArgumentException::class);
        divide(15, 0);
    }
      public function testPower()
    {
        $this->assertEquals(8, power(2, 3));
        $this->assertEquals(1, power(5, 0));
        $this->assertEquals(0.5, power(2, -1));
    }

}
