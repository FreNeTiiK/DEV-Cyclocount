<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use App\Repository\ActivityTypeRepository;
use DateInterval;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ActivityFixtures extends Fixture implements DependentFixtureInterface
{
    private $activityTypeRepository;

    public function __construct(ActivityTypeRepository $activityTypeRepository)
    {
        $this->activityTypeRepository = $activityTypeRepository;
    }

    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager): void
    {
        $activityTypes = $this->activityTypeRepository->findAll();
        $titles = ['The Grand Tour', 'The Petit Tour', 'The Moyen Tour', 'The Giga Tour', 'The Minuscule Tour'];
        $difficulties = ['easy', 'normal', 'difficult'];

        foreach ($activityTypes as $activityType) {
            for($i = 0; $i < 40; $i++) {
                $from = strtotime('1 January 2021');
                $timestamp = rand($from, time());
                $start = (new DateTime())->setTimestamp($timestamp);
                $end = (new DateTime())->setTimestamp($timestamp)->add(new DateInterval('PT'.rand(0, 5).'H'.rand(0, 60).'M'.rand(0, 60).'S'));

                $activity = new Activity();
                $activity->setTitle($titles[array_rand($titles)]);
                $activity->setDescription('Description de ' . $titles[array_rand($titles)]);
                $activity->setDepartureTime($start);
                $activity->setArrivalTime($end);
                $activity->setDistance( $activityType->getCode() === 'running' ? rand(4, 50) : rand(4, 100));
                $activity->setSpeedAverage($activityType->getCode() === 'running' ? rand(10, 13) : rand(20, 30));
                $activity->setSpeedMax($activityType->getCode() === 'running' ? rand(14, 18) : rand(30, 50));
                $activity->setHeightDifference(rand(40, 400));
                $activity->setPowerAverage(rand(50, 150));
                $activity->setCaloriesConsumed(rand(150, 800));
                $activity->setActivityType($this->getReference($activityType->getCode()));
                $activity->setDifficulty($this->getReference($difficulties[array_rand($difficulties)]));
                $activity->setEquipment($this->getReference($activityType->getCode() === 'running' ? 'mavicshoes' : 'mavicbike'));
                $activity->setUserLink($this->getReference('simon'));
                $manager->persist($activity);
            }
        }

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
