<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CoachController extends Controller
{
    /**
     * @Route("/coach/", name="coachroute")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Coach:index.html.twig', array(
            // ...
        ));
    }

    /**
     *@Route("/coach/settings", name="coach_settings")
     */
    public function coachSettingsAction()
    {
        return $this->render('AppBundle:Coach:coach-settings.html.twig');

    }

    /**
     * @Route("/coach/customer", name="coachcustomeroverview")
     */
    public function customerAction()
    {
        $customers = $this->get('api')->customerOverview();
        return $this->render('AppBundle:Coach:customer.html.twig', ["customers" => $customers, "rowAmount" => count($customers)]);
       
    }


}
