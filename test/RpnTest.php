<?php

require __DIR__.'/../vendor/autoload.php';


class RpnTest extends PHPUnit_Framework_TestCase
{

    public function testPostfix()
    {

        $expression1 = "3 11 +"; //14
        $expression2 = "3 11 5 + -"; //-13
        $expression3 = "3 11 + 5 -"; //9
        $expression4 = "2 3 11 + 5 -*"; //18
        $expression5 = "9 5 3 + 2 4 ^ - +"; //1
        
        $rpn = new RPN\Rpn();
        $this->assertEquals(14,$rpn->calculate($expression1));
        $this->assertEquals(-13,$rpn->calculate($expression2));
        $this->assertEquals(9,$rpn->calculate($expression3));
        $this->assertEquals(18,$rpn->calculate($expression4));
        $this->assertEquals(1,$rpn->calculate($expression5));
    }
}
