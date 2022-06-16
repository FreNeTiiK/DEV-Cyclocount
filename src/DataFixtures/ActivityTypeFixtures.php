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
        $activityType->setCode('bike');
        $this->addReference('bike', $activityType);
        $manager->persist($activityType);

        $activityType = new ActivityType();
        $activityType->setName('Running');
        $activityType->setCode('running');
        $this->addReference('running', $activityType);
        $manager->persist($activityType);

        $manager->flush();
    }
}
