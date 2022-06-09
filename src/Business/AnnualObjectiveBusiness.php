<?php


namespace App\Business;


use App\Entity\AnnualObjective;
use App\Entity\RequestBody\NewAnnualObjective;
use App\Entity\User;
use App\Repository\AnnualObjectiveRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class AnnualObjectiveBusiness
{
    private $userRepository;
    private $annualObjectiveRepository;
    private $em;

    public function __construct
    (
        AnnualObjectiveRepository $annualObjectiveRepository,
        UserRepository $userRepository,
        EntityManagerInterface $em
    )
    {
        $this->annualObjectiveRepository = $annualObjectiveRepository;
        $this->userRepository = $userRepository;
        $this->em = $em;
    }

    public function getAnnualObjectives(): array
    {
        return $this->annualObjectiveRepository->findAll();
    }

    public function getAnnualObjectivesByUser(User $user): array
    {
        return $this->annualObjectiveRepository->findBy(['userLink' => $user]);
    }

    public function addAnnualObjective(NewAnnualObjective $newAnnualObjective): AnnualObjective
    {
        $user = $this->userRepository->find($newAnnualObjective->getUserId());
        $annualObjective = new AnnualObjective();
        $annualObjective->setName($newAnnualObjective->getName());
        $annualObjective->setQuantity($newAnnualObjective->getQuantity());
        $annualObjective->setUserLink($user);
        $this->em->persist($annualObjective);
        $this->em->flush();
        return $annualObjective;
    }

    public function delAnnualObjective(AnnualObjective $annualObjective): void
    {
        $this->em->remove($annualObjective);
        $this->em->flush();
    }
}