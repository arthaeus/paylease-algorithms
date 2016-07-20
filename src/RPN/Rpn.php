<?php

namespace Algorithm\RPN;

use Algorithm\Rpnexception as Rpnexception;
use Algorithm\IAlgorithm as IAlgorithm;

/**
 * Reverse Polish Notation Calculator
 *
 * @created  2012-11-10
 * @since    PHP >= 5.3.0
 * @link     https://en.wikipedia.org/wiki/Reverse_Polish_notation
 * @link     https://ru.wikipedia.org/wiki/Обратная_польская_запись
 * @license  http://creativecommons.org/licenses/by-sa/3.0/
 * @author   https://github.com/rin-nas
 * @charset  UTF-8
 * @version  1.0.0
*/
class Rpn implements IAlgorithm
{

	function __construnct()
	{
	}


	/**
	 * Вычисляет и возвращает итоговое значение для выражения
	 * В случае ошибки кидает исключение
	 *
	 * @param   string  $expression  Выражение для вычисления
	 * @return  int|string
	 * @throw   Rpnexception
	 */
	function calculate( \stdClass $expressionClass )
    {
        $expression = trim($expressionClass->expression);
		preg_match_all('~
						(?>	#operands
							(-? \d+ (?>\.\d*)? (?>[eE][+\-]?+\d+)?)  #1 digit

							#statements
							| [+\-−*×/÷\^√]  #various arithmetic
							| sqrt
							| pow
						)
						~sxuSX', $expression, $m, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
		if (empty($m)) throw new Rpnexception('Expression is empty', $expression);

		$stack = array();
		foreach ($m as $i => $a)
		{
			$is_operand = isset($a[1]);

			if ($is_operand)
			{
				list ($operand, $offset) = $a[0];
				array_push($stack, $operand);
				continue;
			}

			list ($statement, $offset) = $a[0];
			$c = count($stack);

			if ($c < 1) throw new Rpnexception('Failed apply a statement "' . $statement . '" at offset ' . $offset . ', stack count = ' . $c, $expression, $offset);

			$index = $c - 1;
			if ($statement === '√' || $statement === 'sqrt')
			{
				$stack[$index] = sqrt($stack[$index]);
				continue;
			}

			if ($c < 2) throw new Rpnexception('Failed apply two argument statement "' . $statement . '" at offset ' . $offset . ', stack count = ' . $c, $expression, $offset);

			$index = $c - 2;
			$operand = array_pop($stack);
			if ($statement === '*' || $statement === '×')		$stack[$index] *= $operand;
			elseif ($statement === '/' || $statement === '÷')	$stack[$index] /= $operand;
			elseif ($statement === '+')							$stack[$index] += $operand;
			elseif ($statement === '-' || $statement === '−')	$stack[$index] -= $operand;
			elseif ($statement === '^' || $statement === 'pow')	$stack[$index] = pow($stack[$index], $operand);
			else throw new Rpnexception('Undefined handler for statement "' . $statement . '"', $expression, $offset);
		}
		$result = array_pop($stack);
		$c = count($stack);
		if ($c > 0) throw new Rpnexception('Failed apply an operand "' . $operand . '" at offset ' . $offset . ', stack count = ' . $c, $expression, $offset);
		return $result;
	}
}
