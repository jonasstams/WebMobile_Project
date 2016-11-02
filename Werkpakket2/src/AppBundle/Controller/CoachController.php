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


}

