<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends Controller
{
    /**
     * @Route("/admin/" , name="admin_route")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Admin:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/admin/customer", name="admin_customer_overview")
     */
    public function customerAction()
    {
        $customers = $this->get('api')->customerOverview();
        return $this->render('AppBundle:Admin:customer.html.twig', ["customers" => $customers, "rowAmount" => count($customers)]);

    }

    /**
     * @Route("/admin/settings", name="admin_settings")
     */
    public function settingsAction()
    {
        return $this->render('AppBundle:Admin:settings.html.twig');

    }

}
