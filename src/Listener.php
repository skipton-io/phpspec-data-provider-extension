<?php

namespace Kanel\PhpSpec\DataProvider;

use PhpSpec\Event\SpecificationEvent;
use PhpSpec\Loader\Node\ExampleNode;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class Listener implements EventSubscriberInterface {

	public static function getSubscribedEvents()
	{
		return [
			'beforeSpecification' => ['beforeSpecification'],
		];
	}

	public function beforeSpecification(SpecificationEvent $event) {

		$examplesToAdd  = [];
		$parser = new Parser();

		foreach ($event->getSpecification()->getExamples() as $example) {
			$dataProviderMethod = $parser->getDataProvider($example->getFunctionReflection());
			if (null !== $dataProviderMethod) {
				if (!$example->getSpecification()->getClassReflection()->hasMethod($dataProviderMethod)) {
					return false;
				}
				$subject = $example->getSpecification()->getClassReflection()->newInstance();
				$provided_data = $example->getSpecification()->getClassReflection()->getMethod($dataProviderMethod)->invoke($subject);
				if (is_array($provided_data)) {
					foreach ($provided_data as $i => $data_row) {
						$examplesToAdd[] = new ExampleNode($i+1 . ') ' . $example->getTitle(), $example->getFunctionReflection());
					}
				}
			}
		}

		if (!empty($examplesToAdd)) {
			// Add the examples except for the first one that was already added by phpspec
			for ($i = 1; $i < count($examplesToAdd); $i++) {
				$event->getSpecification()->addExample($examplesToAdd[$i]);
			}
		}
	}
}
