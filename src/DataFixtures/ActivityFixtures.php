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
        $activity->setArrivalTime(new \DateTime('14:00:00'));
        $activity->setDepartureTime(new \DateTime('12:05:22'));
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
        $activity->setArrivalTime(new \DateTime('18:00:00'));
        $activity->setDepartureTime(new \DateTime('14:30:00'));
        $activity->setSpeedAverage(22.00);
        $activity->setSpeedMax(42.00);
        $activity->setHeightDifference(350);
        $activity->setPowerAverage(70);
        $activity->setCaloriesConsumed(950);
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
