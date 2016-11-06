<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;

class DefaultController extends Controller {

    private $customers;

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/adminpage")
     */
    public function adminAction(Request $request) {
        return $this->render('default/adminpage.html.twig');
    }

    /**
     * @Route("/coachpage")
     */
    public function coachAction(Request $request) {
        $customers = $this->get('api')->customerOverview();
        return $this->render('default/coachpage.html.twig', ["customers" => $customers, "rowAmount" => count($customers)]);
    }

    /**
     * @Route("/logout" , name="logout")
     */
    public function logoutAction(Request $request) {
        $this->get('security.token_storage')->setToken(null);
        //    $this->get('request')->getSession()->invalidate();
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/quit", name="quitroute")
     */
    public function quitAction(Request $request) {
        header("HTTP/1.1 401 Access Denied");
        header("WWW-Authenticate: " .
                "Basic realm=\"localhost:8000/\"");
        header("Content-Length: 0");
        return new Response(null, 401);
    }

    /**
     * @Route("/makeusers")
     */
    public function makeUsersAction() {
        $em = $this->getDoctrine()->getManager();
        $user = new User();
        $user->setUserName('adminTest');
        $user->setRolesString('ROLE_ADMIN ROLE_COACH');
        $password = 'a1';
        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($user, $password);
        $user->setPassword($encoded);
        $em->persist($user);
        $em->flush();
        return new Response('Created user');
    }

}
