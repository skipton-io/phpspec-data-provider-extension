<?php

namespace Kanel\PhpSpec\DataProvider;

class Parser
{
	const DATA_PROVIDER_PATTERN = '/@dataProvider ([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)/';

	public function getDataProvider(\ReflectionMethod $reflection)
	{
		$doc_comment = $reflection->getDocComment();
		if (false === $doc_comment) {
			return null;
		}

		if (0 === preg_match(self::DATA_PROVIDER_PATTERN, $doc_comment, $matches)) {
			return null;
		}

		return $matches[1];
	}
}