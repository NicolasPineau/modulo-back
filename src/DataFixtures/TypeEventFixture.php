<?php

namespace App\DataFixtures;

use App\Entity\TypeEvent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeEventFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $types = [
            ['name' => "Assemblée territoriale", 'isObligated' => true],
            ["Conseil territorial", 'isObligated' => false],
            ["Conseil territorial élargi", 'isObligated' => true],
            ["Réunion équipe territoriale", 'isObligated' => false],
            ["Réunion pôle pédagogique", 'isObligated' => false],
            ["Réunion pôle adm. et financier", 'isObligated' => false],
            ["Week-end territorial", 'isObligated' => true],
            ["Conseil de groupe", 'isObligated' => true],
            ["Réunion d'unité", 'isObligated' => true],
            ["Conseil de chefs", 'isObligated' => false],
            ["Week-end d'unité", 'isObligated' => true],
            ["Réunion de groupe", 'isObligated' => false],
            ["Week-end de groupe", 'isObligated' => false],
            ["Réunion diverse", 'isObligated' => false]
        ];

        foreach ($types as $type) {
            $typeEvent1 = new TypeEvent();
            $typeEvent1
                ->setName($type['name'])
                ->setIsObligated($type['isObligated']);

            $manager->persist($typeEvent1);
            $this->addReference('type_event0', $typeEvent1);
        }

        $manager->flush();
    }
}
