#PhpSpec data provider extension

![build](https://travis-ci.org/elkaadka/phpspec-data-provider-extension.svg?branch=master)


This extension allows you to create data providers for examples in specs.

It was largely inspired from [coduo/phpspec-data-provider-extension](https://github.com/coduo/phpspec-data-provider-extension) and adapted to handle phpspec 4 and default values of parameters

## Installation

```shell
composer require kanel/phpspec-data-provider-extension
```

## Usage

Enable extension in phpspec.yml file

```
extensions:
    Kanel\PhpSpec\DataProvider\Extension: ~
```

Write a spec:

```php
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

```

Write class for spec:

```php
<?php

namespace Kanel\PhpSpec\Test;

class Increment
{
        public function plusOne(int $i): int {
            return $i + 1;
        }
}
```

Run php spec

```
$ console bin/phpspec run -f pretty
```

You should get following output:

```
    Kanel\PhpSpec\Test\Increment
    

  15  ✔ should be able to increment values (129ms)
  15  ✔ 2) it should be able to increment values
  15  ✔ 3) it should be able to increment values
  15  ✔ 4) it should be able to increment values


1 specs
4 examples (4 passed)
```