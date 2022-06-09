<?php

namespace App\EventFixture;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\TypeEvent;

class EventFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i < 5; $i++) {
            $nb = random_int(0, 13);
            /** @var TypeEvent $typeEvent */
            $typeEvent = $this->getReference('type_event_' . $nb);
            $event = new Event();
            $event->setTitle('Réunion des chefs  ');
            $event->setDateStart(new \DateTime());
            $event->setDateEnd(new \DateTime('+7days'));
            $event->setDescription('Réunion de 2h');
            $event->setTypeEvent($typeEvent);
            $event->setActive(true);
            $manager->persist($event);
        }

        $manager->flush();

    }

}

