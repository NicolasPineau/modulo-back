<?php

namespace App\DataFixtures;

use App\Entity\AgeSection;

final class AgeSectionFixture extends GeneratedFixture
{
    public const REFERENCE_NAME = AgeSection::class;
    public const MAX_COUNT = 10;

    protected function generate(): AgeSection
    {
        return (new AgeSection())
            ->setName($this->faker->name())
            ->setCode($this->faker->unique()->randomLetter())
            ->setColor($this->faker->hexColor())
        ;

    }
}
