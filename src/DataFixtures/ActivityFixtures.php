<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ActivityFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $activity = new Activity();
        $activity->setTitle('The Grand Tour');
        $activity->setDescription('Tour sympatique hfozejidkpazdfjzmk');
        $activity->setArrivalTime(new \DateTime('2022-01-17 14:00:00'));
        $activity->setDepartureTime(new \DateTime('2022-01-17 12:05:22'));
        $activity->setDistance(528.00);
        $activity->setSpeedAverage(27.00);
        $activity->setSpeedMax(47.00);
        $activity->setHeightDifference(150);
        $activity->setPowerAverage(90);
        $activity->setCaloriesConsumed(450);
        $activity->setActivityType($this->getReference('velo'));
        $activity->setEquipment($this->getReference('bike'));
        $activity->setUserLink($this->getReference('simon'));
        $manager->persist($activity);

        $activity = new Activity();
        $activity->setTitle('The Petit Tour');
        $activity->setDescription('Petit Tour sympatique hfozejidkpazdfjzmk');
        $activity->setArrivalTime(new \DateTime('2022-01-21 18:00:00'));
        $activity->setDepartureTime(new \DateTime('2022-01-21 14:30:00'));
        $activity->setDistance(428.00);
        $activity->setSpeedAverage(22.00);
        $activity->setSpeedMax(42.00);
        $activity->setHeightDifference(350);
        $activity->setPowerAverage(70);
        $activity->setCaloriesConsumed(950);
        $activity->setActivityType($this->getReference('course'));
        $activity->setEquipment($this->getReference('mavic'));
        $activity->setUserLink($this->getReference('simon'));
        $manager->persist($activity);

        $activity = new Activity();
        $activity->setTitle('The Moyen Tour');
        $activity->setDescription('Moyen Tour sympatique hfozejidkpazdfjzmk');
        $activity->setArrivalTime(new \DateTime('2022-03-11 18:00:00'));
        $activity->setDepartureTime(new \DateTime('2022-03-11 14:30:00'));
        $activity->setDistance(328.00);
        $activity->setSpeedAverage(22.00);
        $activity->setSpeedMax(42.00);
        $activity->setHeightDifference(350);
        $activity->setPowerAverage(70);
        $activity->setCaloriesConsumed(950);
        $activity->setActivityType($this->getReference('course'));
        $activity->setEquipment($this->getReference('mavic'));
        $activity->setUserLink($this->getReference('simon'));
        $manager->persist($activity);

        $activity = new Activity();
        $activity->setTitle('The Giga Tour');
        $activity->setDescription('Giga Tour sympatique hfozejidkpazdfjzmk');
        $activity->setArrivalTime(new \DateTime('2022-02-11 18:00:00'));
        $activity->setDepartureTime(new \DateTime('2022-02-11 14:30:00'));
        $activity->setDistance(228.00);
        $activity->setSpeedAverage(22.00);
        $activity->setSpeedMax(42.00);
        $activity->setHeightDifference(350);
        $activity->setPowerAverage(70);
        $activity->setCaloriesConsumed(950);
        $activity->setActivityType($this->getReference('course'));
        $activity->setEquipment($this->getReference('mavic'));
        $activity->setUserLink($this->getReference('simon'));
        $manager->persist($activity);

        $activity = new Activity();
        $activity->setTitle('The Minuscule Tour');
        $activity->setDescription('Minuscule Tour sympatique hfozejidkpazdfjzmk');
        $activity->setArrivalTime(new \DateTime('2022-01-11 18:00:00'));
        $activity->setDepartureTime(new \DateTime('2022-01-11 14:30:00'));
        $activity->setDistance(128.00);
        $activity->setSpeedAverage(2.00);
        $activity->setSpeedMax(42.00);
        $activity->setHeightDifference(35);
        $activity->setPowerAverage(7);
        $activity->setCaloriesConsumed(95);
        $activity->setActivityType($this->getReference('course'));
        $activity->setEquipment($this->getReference('mavic'));
        $activity->setUserLink($this->getReference('simon'));
        $manager->persist($activity);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return array(
            EquipmentFixtures::class,
            ActivityTypeFixtures::class,
            UserFixtures::class
        );
    }
}
