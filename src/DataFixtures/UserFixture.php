<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\Scope;
use App\Entity\Structure;
use App\Entity\User;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use LogicException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserFixture extends Fixture
{
    const DEFAULT_PASSWORD = 'password';

    public function __construct(private string $projectDir, private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $file = fopen(sprintf('%s/resources/fixtures/users-fixture.csv', $this->projectDir), 'r');
        $index = 0;
        while ($row = fgetcsv($file, 1000)) {
            $index++;
            if ($index === 1) {
                continue;
            }

            [$code, $structureCode, $role, $structureCode2, $role2] = $row;
            if ($row[0] != null) {
                $genre = $faker->boolean() ? 'H' : 'F';
                $firstName = $faker->firstName;
                $lastName = $faker->lastName;
                $email = $faker->email();
                $user = new User();
                $user->setUuid($code);
                $user->setEmail($email);
                $user->setFirstName($firstName);
                $user->setLastName($lastName);
                $user->setGenre($genre);
                $user->setPassword($this->passwordHasher->hashPassword(
                    $user,
                    self::DEFAULT_PASSWORD
                ));
                $manager->persist($user);


                $structure = $this->getReference(sprintf('structure-%s', $structureCode));
                if (!$structure instanceof Structure) {
                    throw new LogicException();
                }

                $role = $this->getReference(sprintf('role-%s', $role));
                if (!$role instanceof Role) {
                    throw new LogicException();
                }

                $scope = new Scope();
                $scope->setUser($user);
                $scope->setStructure($structure);
                $scope->setCreatedAt(new \DateTime('now'));
                $scope->setRole($role);
                $manager->persist($scope);

                if (!empty($structureCode2)) {
                    $structure2 = $this->getReference(sprintf('structure-%s', $structureCode));
                    if (!$structure2 instanceof Structure) {
                        throw new LogicException();
                    }

                    $role2 = $this->getReference(sprintf('role-%s', $role2));
                    if (!$role2 instanceof Role) {
                        throw new LogicException();
                    }

                }
            }
        }

        $userAdmin = new User();
        $userAdmin->setUuid('00000000');
        $userAdmin->setEmail('admin@gmail.com');
        $userAdmin->setFirstName('Mehdi');
        $userAdmin->setLastName('Laribi');
        $userAdmin->setGenre('H');
        $userAdmin = $userAdmin->setRoles(["ROLE_ADMIN"]);
        $userAdmin = $userAdmin->setPassword($this->passwordHasher->hashPassword($user, 'test'));
        $manager->persist($userAdmin);

        $manager->flush();
    }
}
