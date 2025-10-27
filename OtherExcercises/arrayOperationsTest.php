<?php

// Запуск теста ../vendor/bin/phpunit arrayOperationsTest.php

use PHPUnit\Framework\TestCase;

require_once 'arrayOperations.php';

class arrayOperationsTest extends TestCase
{
    public function testFindMax()
    {
        $this->assertEquals(5, findMax([1, 2, 3, 4, 5]));
        $this->assertEquals(-1, findMax([-5, -3, -1]));
        $this->assertNull(findMax([]));
    }

    public function testFindMin()
    {
        $this->assertEquals(1, findMin([1, 2, 3, 4, 5]));
        $this->assertEquals(-5, findMin([-1, -3, -5]));
        $this->assertNull(findMin([]));
    }

    public function testCalculateAverage()
    {
        $this->assertEquals(3, calculateAverage([1, 2, 3, 4, 5]));
        $this->assertEquals(0, calculateAverage([-2, -1, 1, 2]));
        $this->assertNull(calculateAverage([]));
    }

    public function testFilterEvenNumbers()
    {
        $this->assertEquals([2, 4, 6], array_values(filterEvenNumbers([1, 2, 3, 4, 5, 6])));
        $this->assertEquals([], filterEvenNumbers([1, 3, 5]));
        $this->assertEquals([-4, -2, 0, 2], array_values(filterEvenNumbers([-4, -3, -2, -1, 0, 1, 2])));
    }

    public function testCountItem()
    {
        $this->assertEquals(3, countItem([1, 2, 1, 3, 1], 1));
        $this->assertEquals(0, countItem([1, 2, 3], 4));
        $this->assertEquals(2, countItem(['a', 'b', 'a', 'c'], 'a'));
    }
}
