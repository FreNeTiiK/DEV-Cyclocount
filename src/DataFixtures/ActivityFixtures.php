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
        $activity->setUserLink($this->getReference('Simon'));
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
        $activity->setUserLink($this->getReference('Simon'));
        $manager->persist($activity);


        $manager->flush();

    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class
        );
    }
}