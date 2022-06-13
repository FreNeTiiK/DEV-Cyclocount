<?php

namespace App\DataFixtures;

use App\Entity\Difficulty;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DifficultyFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $difficulty = new Difficulty();
        $difficulty->setName('Facile');
        $manager->persist($difficulty);

        $difficulty2 = new Difficulty();
        $difficulty2->setName('Normal');
        $manager->persist($difficulty2);

        $difficulty3 = new Difficulty();
        $difficulty3->setName('Difficile');
        $manager->persist($difficulty3);

        $manager->flush();
    }
}
