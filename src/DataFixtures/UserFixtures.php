<?php

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    public function __construct(
        private UserPasswordHasherInterface $hasher
    ){}
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for($i=0; $i < 10; $i++){
            $user = new User();
            $user->setEmail($faker->email())
                ->setLastName($faker->lastName())
                ->setFirstName($faker->firstName())
                ->setPassword(
                    $this->hasher->hashPassword($user, 'password')
                );
                 
            $manager->persist($user);
            
        }

        $manager->flush();
    }
}
