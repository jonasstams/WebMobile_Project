<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

require_once (__DIR__ . '/RestCurl.php');

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
        $customers = RestCurl::get('www.jonasstams.be/api/public/customers');
        $customers_JSON = $customers['data'];
        return $this->render('AppBundle:Coach:customer.html.twig', ["customers" => $customers_JSON]);
    }

    /**
     * @Route("/coach/customer/reports/{id}", name="coach_customer_report_overview")
     */
    public function customerReportOverviewAction($id)
    {
        $reports = RestCurl::get('www.jonasstams.be/api/public/reports/' . $id);
        $customer = RestCurl::get('www.jonasstams.be/api/public/customers/' . $id);
        $reports_JSON = $reports['data'];
        $customer_JSON = $customer['data'];
        return $this->render('AppBundle:Coach:customer.report.overview.html.twig', ["reports" => $reports_JSON, "customer" => $customer_JSON, "id" => $id]);
    }

    /**
     * @Route("/coach/customer/habits/{id}", name="coach_customer_habits_overview")
     */
    public function customerHabitsOverviewAction($id)
    {
        $customer = RestCurl::get('www.jonasstams.be/api/public/customers/' . $id);
        $customer_JSON = $customer['data'];
        return $this->render('AppBundle:Coach:customer.habits.overview.html.twig', ["customer" => $customer_JSON]);
    }

    /**
     * @Route("/coach/customerUpdated", name="update_habits")
     */
    public function updateHabitsAction()
    {
        $request = Request::createFromGlobals();

        $id = $request->get('id');
        $params = array(
            "habit1"=> $request->get('habit1'),
            "habit2"=> $request->get('habit2'),
            "habit3"=> $request->get('habit3'),
        );

        $response = RestCurl::put('www.jonasstams.be/api/public/customers/' . $id, $params);
        $customers = RestCurl::get('www.jonasstams.be/api/public/customers');
        $response_JSON = $response['status'];
        $customers_JSON = $customers['data'];
        return $this->render('AppBundle:Coach:customer.html.twig', ["response" => $response_JSON, "customers" => $customers_JSON]);
    }
}

