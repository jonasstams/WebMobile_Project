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
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('default/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
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
