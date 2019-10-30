<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

use App\Entity\User;

class AppFixtures extends Fixture
{
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);

        $manager->flush();
    }

    public function loadUsers(ObjectManager $manager){
        for($i =1; $i<10; $i++){
            $user = new User();
            $user->setFirstName($this->faker->text());
            $user->setEmail($this->faker->text(180));
            $user->setPassword($this->faker->text());

            $manager->persist($user);
        }
        $manager->flush();
    }
}