<?php

namespace App\Controller;

use App\Business\AnnualObjectiveBusiness;
use App\Entity\AnnualObjective;
use App\Entity\RequestBody\NewAnnualObjective;
use FOS\RestBundle\Controller\AbstractFOSRestController;
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
    public function getAnnualObjectives(AnnualObjectiveBusiness $annualObjectiveBusiness)
    {
        $annualObjectives = $annualObjectiveBusiness->getAnnualObjectives();

        $view = $this->view($annualObjectives);
        return $this->handleView($view);
    }

    /**
     * @Route("", methods={"POST"})
     * @ParamConverter("newAnnualObjective", class="App\Entity\RequestBody\NewAnnualObjective", converter="fos_rest.request_body")
     */
    public function addAnnualObjective(AnnualObjectiveBusiness $annualObjectiveBusiness, NewAnnualObjective $newAnnualObjective)
    {
        $annualObjective = $annualObjectiveBusiness->addAnnualObjective($newAnnualObjective);

        $view = $this->view($annualObjective);
        return $this->handleView($view);
    }

    /**
     * @Route("/{annualObjective}", methods={"DELETE"})
     */
    public function delAnnualObjective(AnnualObjectiveBusiness $annualObjectiveBusiness, AnnualObjective $annualObjective)
    {
        $annualObjectiveBusiness->delAnnualObjective($annualObjective);

        $view = $this->view();
        return $this->handleView($view);
    }

}