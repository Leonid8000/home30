<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


use App\Entity\User;

class AppFixtures extends Fixture
{
    private $faker;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->faker = Factory::create();
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
        $manager->flush();
    }
    public function loadUsers(ObjectManager $manager){

            $user = new User();
            $user->setFirstName($this->faker->text());
            $user->setEmail('leonidzp8000@ukr.net');
            $user->setRoles(['ROLE_ADMIN']);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'password'
            ));
            $manager->persist($user);

        $manager->flush();
    }

//    protected function getRandomReference(string $className) {
//        if (!isset($this->referencesIndex[$className])) {
//            $this->referencesIndex[$className] = [];
//            foreach ($this->referenceRepository->getReferences() as $key => $ref) {
//                if (strpos($key, $className.'_') === 0) {
//                    $this->referencesIndex[$className][] = $key;
//                }
//            }
//        }
//        if (empty($this->referencesIndex[$className])) {
//            throw new \Exception(sprintf('Cannot find any references for class "%s"', $className));
//        }
//        $randomReferenceKey = $this->faker->randomElement($this->referencesIndex[$className]);
//        return $this->getReference($randomReferenceKey);
//    }
}