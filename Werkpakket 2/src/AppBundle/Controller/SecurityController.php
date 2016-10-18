<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller {

    /**
     * @Route("/login", name="loginroute")
     */
    public function loginAction(Request $request) {
        return $this->render('default/login.html.twig');
    }

    /**
     * @Route("/login_check", name="checkroute")
     */
    public function loginCheckAction() {
        // NB hier geen code: het framework voorziet de controles/acties
    }

    /**
     * @Route("/quit", name="quitroute")
     */
    public function quitAction(Request $request) {
        // NB hier geen code: het framework voorziet de acties
    }

}
