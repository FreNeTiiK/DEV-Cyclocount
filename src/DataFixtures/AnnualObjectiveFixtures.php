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
        $annualObj->setTypeObjective($this->getReference('km'));
        $annualObj->setUserLink($this->getReference('simon'));
        $manager->persist($annualObj);

        $annualObj = new AnnualObjective();
        $annualObj->setName('Vitesse Moyenne annuelle');
        $annualObj->setQuantity(27);
        $annualObj->setActivityType($this->getReference('velo'));
        $annualObj->setTypeObjective($this->getReference('vit'));
        $annualObj->setUserLink($this->getReference('simon'));
        $manager->persist($annualObj);

        $annualObj = new AnnualObjective();
        $annualObj->setName('Temps annuel');
        $annualObj->setQuantity(500);
        $annualObj->setActivityType($this->getReference('velo'));
        $annualObj->setTypeObjective($this->getReference('duration'));
        $annualObj->setUserLink($this->getReference('simon'));
        $manager->persist($annualObj);

        $annualObj = new AnnualObjective();
        $annualObj->setName('Denivelé annuel');
        $annualObj->setQuantity(500);
        $annualObj->setActivityType($this->getReference('velo'));
        $annualObj->setTypeObjective($this->getReference('denivele'));
        $annualObj->setUserLink($this->getReference('simon'));
        $manager->persist($annualObj);

        $annualObj = new AnnualObjective();
        $annualObj->setName('Nombres de sorties annuelles');
        $annualObj->setQuantity(100);
        $annualObj->setActivityType($this->getReference('velo'));
        $annualObj->setTypeObjective($this->getReference('sorties'));
        $annualObj->setUserLink($this->getReference('simon'));
        $manager->persist($annualObj);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return array(
            UserFixtures::class,
            ActivityTypeFixtures::class,
            TypeObjectiveFixtures::class
        );
    }
}
