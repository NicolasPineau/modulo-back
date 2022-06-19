<?php

namespace App\DataFixtures;

use App\Entity\Event;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EventFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $event = new Event();

        for ($i = 0; $i < 5; $i++) {
            $event
                ->setName("Event " . $i)
                ->setDateStart(new DateTime("now"))
                ->setDateEnd(new DateTime("+7days"))
                ->setDescription("Description event " . $i);

            $this->addReference("event_" . $i, $event);
        }

        $manager->flush();
    }
}
