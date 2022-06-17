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
        $this->addReference('easy', $difficulty);
        $manager->persist($difficulty);

        $difficulty = new Difficulty();
        $difficulty->setName('Normal');
        $this->addReference('normal', $difficulty);
        $manager->persist($difficulty);

        $difficulty = new Difficulty();
        $difficulty->setName('Difficile');
        $this->addReference('difficult', $difficulty);
        $manager->persist($difficulty);

        $manager->flush();
    }
}
