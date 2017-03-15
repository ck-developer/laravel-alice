<?php

namespace Ck\Laravel\Alice\Loader;

use Ck\Laravel\Alice\Populator\Methods\AttributePopulator;
use Nelmio\Alice\Instances\Populator\Populator;
use Nelmio\Alice\PersisterInterface;

class Loader extends \Nelmio\Alice\Fixtures\Loader
{
    public function __construct(PersisterInterface $persister, $locale, array $providers, $seed, array $parameters)
    {
        $this->manager = $persister;

        parent::__construct($locale, $providers, $seed, $parameters);

        $this->populator = new Populator(
            $this->objects,
            $this->processor,
            array(
                new AttributePopulator()
            )
        );
    }

    public function loadFromDirectory($path)
    {

    }

    public function loadFiles($fixtures)
    {
        $objects = [];

        foreach ($fixtures as $fixture) {
            if (!file_exists($fixture)) {
                throw new \InvalidArgumentException('The file could not be found: '.$fixture);
            }

            $set = $this->load($fixture);

            $objects = array_merge($objects, $set);
        }

        $this->manager->persist($objects);

        return $objects;
    }
}
