<?php

namespace App\Controller;

use App\Business\AnnualObjectiveBusiness;
use App\Entity\AnnualObjective;
use App\Entity\RequestBody\NewAnnualObjective;
use App\Entity\RequestBody\UpdateAnnualObjective;
use App\Entity\User;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/api/annualObjectives")
 */
class AnnualObjectiveController extends AbstractFOSRestController
{
    /**
     * @Route("", methods={"GET"})
     */
    public function getAnnualObjectives(AnnualObjectiveBusiness $annualObjectiveBusiness): Response
    {
        $annualObjectives = $annualObjectiveBusiness->getAnnualObjectives();

        $view = $this->view($annualObjectives);
        return $this->handleView($view);
    }

    /**
     * @Route("/{user}", methods={"GET"})
     */
    public function getAnnualObjectivesByUser(
        AnnualObjectiveBusiness $annualObjectiveBusiness,
        User $user
    ): Response
    {
        $annualObjectives = $annualObjectiveBusiness->getAnnualObjectivesByUser($user);

        $view = $this->view($annualObjectives);
        return $this->handleView($view);
    }

    /**
     * @Route("", methods={"POST"})
     * @ParamConverter("newAnnualObjective", class="App\Entity\RequestBody\NewAnnualObjective", converter="fos_rest.request_body")
     */
    public function addAnnualObjective(
        AnnualObjectiveBusiness $annualObjectiveBusiness,
        NewAnnualObjective $newAnnualObjective
    ): Response
    {
        $annualObjective = $annualObjectiveBusiness->addAnnualObjective($newAnnualObjective);

        $view = $this->view($annualObjective);
        return $this->handleView($view);
    }

    /**
     * @Route("/{annualObjective}", methods={"PUT"})
     * @ParamConverter("updateAnnualObjective", class="App\Entity\RequestBody\UpdateAnnualObjective", converter="fos_rest.request_body")
     */
    public function updateAnnualObjective(
        AnnualObjectiveBusiness $annualObjectiveBusiness,
        AnnualObjective $annualObjective,
        UpdateAnnualObjective $updateAnnualObjective
    ): Response
    {
        $annualObjective = $annualObjectiveBusiness->updateAnnualObjective($annualObjective, $updateAnnualObjective);

        $view = $this->view($annualObjective);
        return $this->handleView($view);
    }

    /**
     * @Route("/{annualObjective}", methods={"DELETE"})
     */
    public function delAnnualObjective(
        AnnualObjectiveBusiness $annualObjectiveBusiness,
        AnnualObjective $annualObjective
    ): Response
    {
        $annualObjectiveBusiness->delAnnualObjective($annualObjective);

        $view = $this->view();
        return $this->handleView($view);
    }
}