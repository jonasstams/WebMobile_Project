<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class CoachController extends Controller
{
    /**
     * @Route("/coach/", name="coach_route")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Coach:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/coach/customer", name="coach_customer_overview")
     */
    public function customerAction()
    {
        $customers = $this->get('api')->customerOverview();
        return $this->render('AppBundle:Coach:customer.html.twig', ["customers" => $customers, "rowAmount" => count($customers)]);
    }

    /**
     * @Route("/coach/customer/reports/{id}", name="coach_customer_report_overview")
     */
    public function customerReportOverviewAction($id)
    {
        $reports = $this->get('api')->reportsByCustomerID($id);
        $firstReport = $reports[0]; //Enkel eerste om als active div te zetten
        array_shift($reports); //Alle reports buiten de eerste
        $customer = $this->get('api')->customerByID($id);
        return $this->render('AppBundle:Coach:customer.report.overview.html.twig', ["reports" => $reports, "firstReport" => $firstReport, "customer" => $customer, "id" => $id]);
    }

    /**
     * @Route("/coach/customer/habits/{id}", name="coach_customer_habits_overview")
     */
    public function customerHabitsOverviewAction($id)
    {
        $customer = $this->get('api')->customerByID($id);
        return $this->render('AppBundle:Coach:customer.habits.overview.html.twig', ["customer" => $customer]);
    }

    /**
     * @Route("/coach/customer", name="update_habits")
     */
    public function updateHabitsAction()
    {
        return null;
    }
}

