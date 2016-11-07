<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class SecurityController extends Controller {

    /**
     * @Route("/login", name="loginroute")
     */
    public function loginAction(Request $request) {
        return $this->render('default/login.html.twig');
    }
    /**
     * @Route("/login_admin_test_route", name="login_admin")
     */
    public function adminLoginAction(Request $request) {
        $em = $this->getDoctrine();
        $repo  = $em->getRepository("AppBundle:User"); //Entity Repository
        $user = $repo->find(1);
        if (!$user) {
            throw new UsernameNotFoundException("User not found");
        } else {
            $token = new UsernamePasswordToken($user, null, "localhost", $user->getRoles());
            $this->get("security.token_storage")->setToken($token); //now the user is logged in

            //now dispatch the login event
            $event = new InteractiveLoginEvent($request, $token);
            $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);

            return $this->render('AppBundle:Admin:index.html.twig', array(
                // ...
            ));
        }
    }
  /**
     * @Route("/login_coach_test_route", name="login_coach")
     */
    public function coachLoginAction(Request $request) {
        $em = $this->getDoctrine();
        $repo  = $em->getRepository("AppBundle:User"); //Entity Repository
        $user = $repo->find(3);
        if (!$user) {
            throw new UsernameNotFoundException("User not found");
        } else {
            $token = new UsernamePasswordToken($user, null, "localhost", $user->getRoles());
            $this->get("security.token_storage")->setToken($token); //now the user is logged in

            //now dispatch the login event
            $event = new InteractiveLoginEvent($request, $token);
            $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);

            return $this->render('AppBundle:Coach:index.html.twig', array(
                // ...
            ));
        }
    }
  /**
     * @Route("/login_admin_test_customer_route", name="login_admin_customer_route")
     */
    public function customerLoginAction(Request $request) {
        $em = $this->getDoctrine();
        $repo  = $em->getRepository("AppBundle:User"); //Entity Repository
        $user = $repo->find(3);
        if (!$user) {
            throw new UsernameNotFoundException("User not found");
        } else {
            $token = new UsernamePasswordToken($user, null, "localhost", $user->getRoles());
            $this->get("security.token_storage")->setToken($token); //now the user is logged in

            //now dispatch the login event
            $event = new InteractiveLoginEvent($request, $token);
            $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);
            $customers = RestCurl::get('www.jonasstams.be/api/public/customers');
            $customers_JSON = $customers['data'];
            return $this->render('AppBundle:Customer:index.html.twig', array(
                'customers' => $this->jsonCustomer()
            ));
        }
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
   private function jsonCustomer(){
       return json_decode('[{
"id": "1",
"first_name": "Jonas",
"last_name": "Stams",
"habit1": "joggen",
"habit2": "fietsen",
"habit3": "yoga",
"profile_picture_url": "http://jonasstams.be/api/public/images/profile-pics/jonasstams.jpg",
"created_at": "2016-10-18 15:22:23",
"updated_at": "2016-11-07 11:23:13"
}]') ;
   }
}
