<?php

namespace spec\Kanel\PhpSpec\Test;

use Kanel\PhpSpec\Test\Increment;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IncrementSpec extends ObjectBehavior
{
	/**
	 * Example of a dataprovider with default values
	 * @dataProvider getTestSuite
	 */
    public function it_should_be_able_to_increment_values($input, $output = 1)
	{
		$this->plusOne($input)->shouldBe($output);
	}

	public function getTestSuite()  {
    	return [
    		[0],
    		[1, 2],
			[3, 4],
			[5, 6],
		];
	}
}
