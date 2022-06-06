<?php

namespace App\DataFixtures;

use App\Entity\AnnualObjective;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AnnualObjectiveFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $annualObj = new AnnualObjective();
        $annualObj->setName('Km annuels');
        $annualObj->setQuantity(1500);
        $annualObj->setUserLink($this->getReference('Simon'));
        $manager->persist($annualObj);

        $annualObj = new AnnualObjective();
        $annualObj->setName('Vitesse Moyenne');
        $annualObj->setQuantity(27);
        $annualObj->setUserLink($this->getReference('Simon'));
        $manager->persist($annualObj);

        $manager->flush();

    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class
        );
    }
}
