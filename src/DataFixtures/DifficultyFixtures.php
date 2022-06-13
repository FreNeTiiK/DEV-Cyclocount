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

        $difficulty = new Difficulty();
        $difficulty->setName('Normal');
        $manager->persist($difficulty);

        $difficulty = new Difficulty();
        $difficulty->setName('Difficile');
        $manager->persist($difficulty);

        $manager->flush();
    }
}
