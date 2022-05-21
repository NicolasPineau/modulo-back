<?php

namespace App\DataFixtures;

use App\Entity\TypeEvent;

final class TypeEventFixture extends GeneratedFixture
{
    public const REFERENCE_NAME = TypeEvent::class;
    public const MAX_COUNT = 50;

    protected function generate(): TypeEvent
    {
        return (new TypeEvent())->setName($this->faker->name());
    }
}
