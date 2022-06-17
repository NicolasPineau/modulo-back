<?php

namespace App\DataFixtures;

use App\Entity\Scope;
use DateTime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

final class ScopeFixture extends GeneratedFixture implements DependentFixtureInterface
{
    public const REFERENCE_NAME = Scope::class;
    public const MAX_COUNT = 100;

    public function getDependencies(): array
    {
        return [UserFixture::class, StructureFixture::class, RoleFixture::class];
    }

    protected function generate(): Scope
    {
        return (new Scope())
            ->setStructure($this->getReference('structure-' . random_int(7000, 7007)))
            ->setRole($this->getRandomRef(RoleFixture::class))
            ->setUser($this->getRandomRef(UserFixture::class))
            ->setIsActive(true)
            ->setCreatedAt(new DateTime());
    }
}
