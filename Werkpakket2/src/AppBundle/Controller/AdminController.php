<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends Controller {

    /**
     * @Route("/admin/" , name="admin_route")
     */
    public function indexAction() {
        return $this->render('AppBundle:Admin:index.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/admin/customer", name="admin_customer_overview")
     */
    public function customerAction() {
        $customers = RestCurl::get('www.jonasstams.be/api/public/customers');
        $customers_JSON = $customers['data'];
        return $this->render('AppBundle:Coach:customer.html.twig', ["customers" => $customers_JSON]);
    }






}
