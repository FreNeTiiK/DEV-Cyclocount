<?php

namespace App\DataFixtures;

use App\Entity\TypeObjective;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeObjectiveFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $typeObj = new TypeObjective();
        $typeObj->setName('Kilomètres');
        $this->addReference('km', $typeObj);
        $manager->persist($typeObj);

        $typeObj = new TypeObjective();
        $typeObj->setName('Durée');
        $this->addReference('duration', $typeObj);
        $manager->persist($typeObj);

        $typeObj = new TypeObjective();
        $typeObj->setName('Vitesse');
        $this->addReference('vit', $typeObj);
        $manager->persist($typeObj);

        $manager->flush();

    }
}
