<?php

namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

final class RoleFixture extends GeneratedFixture implements DependentFixtureInterface
{
    public const REFERENCE_NAME = Role::class;
    public const MAX_COUNT = 200;

    public function getDependencies(): array
    {
        return [AgeSectionFixture::class];
    }

    protected function generate(): Role
    {
        return (new Role())
            ->setName($this->faker->name())
            ->setCode($this->faker->randomLetter().$this->faker->randomLetter().$this->faker->randomLetter())
            ->setAgeSection($this->getRandomRef(AgeSectionFixture::class))
            ->setFeminineName($this->faker->firstNameFemale())
        ;
    }
}
