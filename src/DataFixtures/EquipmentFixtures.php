<?php

namespace App\DataFixtures;

use App\Entity\Equipment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EquipmentFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $equipment = new Equipment();
        $equipment->setName('MavicBike');
        $equipment->setUserLink($this->getReference('Simon'));
        $manager->persist($equipment);

        $equipment = new Equipment();
        $equipment->setName('MavicShooes');
        $equipment->setUserLink($this->getReference('Simon'));
        $manager->persist($equipment);

        $manager->flush();

    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class
        );
    }
}
