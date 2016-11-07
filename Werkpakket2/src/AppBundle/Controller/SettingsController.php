<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Form\ChangePasswordType;
use AppBundle\Form\Model\ChangePassword;
use AppBundle\Entity\User;


class SettingsController extends Controller
{
    /**
     * @Route("/settings", name="settings_route")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Settings:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/changePassword", name="password_change")
     */
    public function changePasswordAction(Request $request)
    { $user = $this->get('security.token_storage')->getToken()->getUser();

        $changePasswordModel = new ChangePassword();
        $form = $this->createForm(ChangePasswordType::class, $changePasswordModel);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($changePasswordModel->getNewPassword());
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('password_change', array('id' => $user->getId()));
            /* return $this->render('AppBundle:Settings:change_Password.html.twig', array(
                 'form' => $form->createView(),
             )); }*/
        }
        return $this->render('AppBundle:Settings:change_password.html.twig', array(
            'form' => $form->createView(),
        ));

    }

}
