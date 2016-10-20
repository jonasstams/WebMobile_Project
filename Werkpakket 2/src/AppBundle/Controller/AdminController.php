<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends Controller
{
    /**
     * @Route("/admin/" , name="adminroute")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Admin:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/admin/settings", name="admin_settings")
     */
    public function settingsAction()
    {
        return $this->render('AppBundle:Admin:settings.html.twig');

    }

}
