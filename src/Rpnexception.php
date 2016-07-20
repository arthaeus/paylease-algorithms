<?php

namespace RPN;

class Rpnexception extends Exception
{
	/**
	 * @var string|null
	 */
	protected $expression = null;

	/**
	 * @var int|null
	 */
	protected $offset = null;

	/**
	 *
	 * @param  string       $message
	 * @param  string|null  $expression
	 * @param  int|null     $offset
	 */
	public function __construct($message, $expression = null, $offset = null)
	{
		parent::__construct($message);
		$this->expression  = $expression;
		$this->offset      = $offset;
	}

	/**
	 * @return string|null
	 */
	public final function getExpression()
	{
		return $this->expression;
	}

	/**
	 * @return int|null
	 */
	public final function getOffset()
	{
		return $this->offset;
	}


}
