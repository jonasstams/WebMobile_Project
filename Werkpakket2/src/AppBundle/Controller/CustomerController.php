<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

require_once (__DIR__ . '/RestCurl.php');

class CustomerController extends Controller {

    /**
     * @Route("/customer/", name="customer_overview")
     */
    public function indexAction() {
        $customers = RestCurl::get('www.jonasstams.be/api/public/customers');
        $customers_JSON = $customers['data'];
        return $this->render('AppBundle:Customer:index.html.twig', ["customers" => $customers_JSON]);
    }

    /**
     * @Route("customer/reports/{id}", name="customer_report_overview")
     */
    public function customerReportOverviewAction($id) {
        $reports = RestCurl::get('www.jonasstams.be/api/public/reports/' . $id);
        $customer = RestCurl::get('www.jonasstams.be/api/public/customers/' . $id);
        $reports_JSON = $reports['data'];
        $customer_JSON = $customer['data'];
        return $this->render('AppBundle:Customer:customer_report_overview.html.twig', ["reports" => $reports_JSON, "customer" => $customer_JSON, "id" => $id]);
    }

    /**
     * @Route("customer/habits/{id}", name="customer_habits_overview")
     */
    public function customerHabitsOverviewAction($id) {
        $customer = RestCurl::get('www.jonasstams.be/api/public/customers/' . $id);
        $customer_JSON = $customer['data'];
        return $this->render('AppBundle:Customer:customer_habits_overview.html.twig', ["customer" => $customer_JSON]);
    }

    /**
     * @Route("/customer/customerUpdated", name="update_habits")
     */
    public function updateCustomerHabitsAction() {
        $request = Request::createFromGlobals();

        $id = $request->get('id');
        $params = array(
            "first_name" => $request->get('first_name'),
            "first_name" => $request->get('last_name'),
            "habit1" => $request->get('habit1'),
            "habit2" => $request->get('habit2'),
            "habit3" => $request->get('habit3'),
        );

        $response = RestCurl::put('www.jonasstams.be/api/public/customers/' . $id, $params);
        $customers = RestCurl::get('www.jonasstams.be/api/public/customers');
        $response_JSON = $response['status'];
        $customers_JSON = $customers['data'];
        return $this->render('AppBundle:Customer:index.html.twig', ["response" => $response_JSON, "customers" => $customers_JSON]);
    }

    /**
     * @Route("/customer/new", name="new_customer")
     */
    public function newCustomerAction() {
        return $this->render('AppBundle:Customer:create_new_customer.html.twig');
    }

    /**
     * @Route("/customer/new/create", name="create_new_customer")
     */
    public function createCustomerAction() {
        $request = Request::createFromGlobals();

        $params = array(
            "first_name" => $request->get('first_name'),
            "last_name" => $request->get('last_name'),
            "habit1" => $request->get('habit1'),
            "habit2" => $request->get('habit2'),
            "habit3" => $request->get('habit3'),
        );

        $response = RestCurl::post('www.jonasstams.be/api/public/customers', $params);
        $customers = RestCurl::get('www.jonasstams.be/api/public/customers');
        $response_JSON = $response['status'];
        $customers_JSON = $customers['data'];
        return $this->render('AppBundle:Customer:index.html.twig', ["response" => $response_JSON, "customers" => $customers_JSON]);
    }

    /**
     * @Route("/customer/customerDelete", name="customer_delete")
     */
    public function deleteCustomerAction() {
        $request = Request::createFromGlobals();

        $id = $request->get('id');
        $response = RestCurl::delete('www.jonasstams.be/api/public/customers/' . $id);
        $customers = RestCurl::get('www.jonasstams.be/api/public/customers');
        $response_JSON = $response['status'];
        $customers_JSON = $customers['data'];
        return $this->render('AppBundle:Customer:index.html.twig', ["response" => $response_JSON, "customers" => $customers_JSON]);
    }

    /**
     * @Route("/customer/pdf/{id}", name="customer_pdf")
     */
    public function toPDFAction($id) {
        // You can send the html as you want
        //$html = '<h1>Plain HTML</h1>';
        // but in this case we will render a symfony view !
        // We are in a controller and we can use renderView function which retrieves the html from a view
        // then we send that html to the user.
        $customers = RestCurl::get('www.jonasstams.be/api/public/customers/' . $id);
        $customers_JSON = $customers['data'];
        $reports = RestCurl::get('www.jonasstams.be/api/public/reports/' . $id);
        $reports_JSON = $reports['data'];
        $html = $this->renderView(
                'AppBundle:Customer:customer_report_pdfLayout.html.twig', array(
            'customer' => $customers_JSON,
            'reports' => $reports_JSON
                )
        );


        $this->returnPDFResponseFromHTML($html);
    }

    public function returnPDFResponseFromHTML($html) {
        //set_time_limit(30); uncomment this line according to your needs
        // If you are not in a controller, retrieve of some way the service container and then retrieve it
        //$pdf = $this->container->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        //if you are in a controlller use :
        $pdf = $this->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetAuthor('Three Habits');
        $pdf->SetTitle(('Your Life Style Profile'));
        $pdf->SetSubject('Status');
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('helvetica', '', 11, '', true);
        //$pdf->SetMargins(20,20,40, true);
        $pdf->AddPage();

        $filename = 'lifestyle_pdf' . date('d-m-Y_h-i-sa');

        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $pdf->Output($filename . ".pdf", 'I'); // This will output the PDF as a response directly
    }

}
