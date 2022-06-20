<?php

namespace App\Command\User;

use App\Entity\User;
use App\Enum\Gender;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:user:create',
    description: 'Creates a new user.'
)]
final class CreateUserCommand extends Command
{
    private const DEFAULT_ROLES = ['ROLE_USER'];
    private const DEFAULT_NAME = 'Admin';
    private const DEFAULT_PASSWORD = 'root';

    public function __construct(
        private readonly UserPasswordHasherInterface $hasher,
        private readonly EntityManagerInterface $entityManager
    ) {
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $user = new User();
        $user->setRoles($input->getOption('roles') ?? self::DEFAULT_ROLES)
            ->setEmail($input->getArgument('email'))
            ->setFirstName($io->ask('firstName', self::DEFAULT_NAME))
            ->setLastName($io->ask('lastName', self::DEFAULT_NAME))
            ->setGenre(Gender::from($io->ask('gender', Gender::Men->value)))
            ->setPassword($this->hasher->hashPassword($user, $io->askHidden('password') ?? self::DEFAULT_PASSWORD))
        ;
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this->addArgument('email', InputArgument::REQUIRED, 'The email address.')
            ->addOption(
                'roles',
                'r',
                InputOption::VALUE_IS_ARRAY | InputArgument::OPTIONAL,
                'roles of the user',
                self::DEFAULT_ROLES
            )
        ;
    }
}
