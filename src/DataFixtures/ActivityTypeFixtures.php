<?php

namespace App\DataFixtures;

use App\Entity\ActivityType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActivityTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $activityType = new ActivityType();
        $activityType->setName('Vélo');
        $this->addReference('velo', $activityType);
        $manager->persist($activityType);

        $activityType = new ActivityType();
        $activityType->setName('Course');
        $this->addReference('course', $activityType);
        $manager->persist($activityType);

        $manager->flush();
    }
}
