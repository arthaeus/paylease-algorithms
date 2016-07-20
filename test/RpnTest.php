<?php

require __DIR__.'/../vendor/autoload.php';
use Algorithm\RPN\Rpn as Rpn;

class RpnTest extends PHPUnit_Framework_TestCase
{

    public function testPostfix()
    {

        $expression1 = new stdClass();
        $expression2 = new stdClass();
        $expression3 = new stdClass();
        $expression4 = new stdClass();
        $expression5 = new stdClass();

        $expression1->expression = "3 11 +"; //14
        $expression2->expression = "3 11 5 + -"; //-13
        $expression3->expression = "3 11 + 5 -"; //9
        $expression4->expression = "2 3 11 + 5 -*"; //18
        $expression5->expression = "9 5 3 + 2 4 ^ - +"; //1
        
        $rpn = new Rpn();
        $this->assertEquals(14,$rpn->calculate($expression1));
        $this->assertEquals(-13,$rpn->calculate($expression2));
        $this->assertEquals(9,$rpn->calculate($expression3));
        $this->assertEquals(18,$rpn->calculate($expression4));
        $this->assertEquals(1,$rpn->calculate($expression5));
    }
}
