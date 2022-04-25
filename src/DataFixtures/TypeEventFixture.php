<?php

namespace App\DataFixtures;

use App\Entity\TypeEvent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use LogicException;

class TypeEventFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $typeEvent1 = new TypeEvent();
        $typeEvent1->setName('Formation');
        $manager->persist($typeEvent1);
        $this->addReference('type_event0',$typeEvent1);

        $manager->flush();
    }
}
