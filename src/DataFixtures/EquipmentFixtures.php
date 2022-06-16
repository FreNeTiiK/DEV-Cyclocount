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
        $equipment->setActivityType($this->getReference('bike'));
        $equipment->setUserLink($this->getReference('simon'));
        $this->addReference('mavicbike', $equipment);
        $manager->persist($equipment);

        $equipment = new Equipment();
        $equipment->setName('MavicShooes');
        $equipment->setActivityType($this->getReference('running'));
        $equipment->setUserLink($this->getReference('simon'));
        $this->addReference('mavicshoes', $equipment);
        $manager->persist($equipment);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return array(
            ActivityTypeFixtures::class,
            UserFixtures::class
        );
    }
}
