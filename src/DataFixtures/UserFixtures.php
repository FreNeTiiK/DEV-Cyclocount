<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('Simon');
        $plainPassword = $user->getUserIdentifier();
        $encoded = $this->encoder->hashPassword($user,$plainPassword);
        $user->setPassword($encoded);
        $user->setAddress("6 rue de Feuillères, 80200, Herbécourt");
        $user->setBirthday(new \DateTime('12/01/2000'));

        $this->addReference($user->getUserIdentifier(),$user);
        $manager->persist($user);

        $manager->flush();

    }
}
