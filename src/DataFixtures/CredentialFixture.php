<?php

namespace App\DataFixtures;

use App\Entity\Credential;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Role;
use App\Entity\Feature;


class CredentialFixture extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $credential = new Credential();
        $credential->setRole($this->getReference('role-C-SG'));
        $credential->setFeature($this->getReference('feature_1'));
        $manager->persist($credential);
        $manager->flush();

        $credential = new Credential();
        $credential->setRole($this->getReference('role-ACCOCO-Comp.'));
        $credential->setFeature($this->getReference('feature_2'));
        $manager->persist($credential);
        $manager->flush();

        $credential = new Credential();
        $credential->setRole($this->getReference('role-RF-FA'));
        $credential->setFeature($this->getReference('feature_3'));
        $manager->persist($credential);
        $manager->flush();

    }

    public function getDependencies()
    {
        return array(
            FeatureFixture::class,
            RoleFixture::class,
        );
    }
}
