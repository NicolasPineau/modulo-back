<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\TypeEvent;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EventFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 5; $i++) {
            $nb = random_int(0, 13);
            /** @var TypeEvent $typeEvent */
            $typeEvent = $this->getReference('type_event_' . $nb);
            $event = new Event();
            $event->setTitle('Réunion des chefs ');
            $event->setDateStart(new DateTime());
            $event->setDateEnd(new DateTime('+7days'));
            $event->setDescription('Réunion de 2h');
            $event->setTypeEvent($typeEvent);
            $event->setIsActive(true);
            $manager->persist($event);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TypeEventFixture::class,
        ];
    }
}
