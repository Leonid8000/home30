<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


use App\Entity\User;

class QuestionFixtures implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [
//            AnswerFixture::class,
        ];
    }
}