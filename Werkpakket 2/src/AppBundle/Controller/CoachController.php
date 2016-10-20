<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
     * @Route("/admin/customer", name="admin_customer_overview")
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
        $customer = $this->get('api')->customerByID($id);
        return $this->render('AppBundle:Coach:customer.report.overview.html.twig', ["reports" => $reports, "customer" => $customer, "id" => $id]);

    }
}
