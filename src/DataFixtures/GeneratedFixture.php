<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Style\SymfonyStyle;

abstract class GeneratedFixture extends Fixture
{
    public const MAX_COUNT = 0;
    public const REFERENCE_NAME = '';

    protected readonly Generator $faker;
    private readonly SymfonyStyle $io;

    public function __construct(string $locale)
    {
        $this->io = new SymfonyStyle(new StringInput(''), new ConsoleOutput());
        $this->faker = Factory::create($locale);
    }

    final public function load(ObjectManager $manager): void
    {
        $this->io->info('Generating '.static::class.'...');
        $this->io->progressStart(static::MAX_COUNT);
        foreach (range(1, static::MAX_COUNT) as $ind) {
            $this->io->progressAdvance();
            $entity = $this->generate();
            $this->addReference(static::REFERENCE_NAME.'::'.$ind, $entity);
            $manager->persist($entity);
            $manager->flush();
        }
        $this->io->progressFinish();
    }

    final public function getRandomRef(string $fixture): object
    {
        return $this->getReference($fixture::REFERENCE_NAME.'::'.$this->faker->numberBetween(1, $fixture::MAX_COUNT));
    }

    abstract protected function generate(): object;
}
