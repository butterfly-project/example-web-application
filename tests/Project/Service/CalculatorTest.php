<?php

namespace Tests\Project\Service;

use Project\Service\Calculator;

class CalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function testSum()
    {
        $calculator = new Calculator();

        $result = $calculator->sum(1, 2);

        $this->assertEquals(3, $result);
    }
}
 