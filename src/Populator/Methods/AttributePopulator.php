<?php

namespace Ck\Laravel\Alice\Populator\Methods;

use Illuminate\Database\Eloquent\Model;
use Nelmio\Alice\Fixtures\Fixture;
use Nelmio\Alice\Instances\Populator\Methods\MethodInterface;

class AttributePopulator implements MethodInterface
{
    public function canSet(Fixture $fixture, $object, $property, $value)
    {
        return $object instanceof Model;
    }

    /**
     * Sets the property to the value on the object described by the given fixture.
     *
     * @param Fixture $fixture
     * @param mixed $object
     * @param string $property
     * @param mixed $value
     */
    public function set(Fixture $fixture, $object, $property, $value)
    {
        $object->setAttribute($property, $value);
    }
}
