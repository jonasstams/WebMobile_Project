<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Customer;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\View as ViewAnnotation;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Context\Context;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class CustomerController extends FOSRestController
{
    /**
     * @Route("customer/add")
     */

    //http://localhost:8000/customer/add?firstname=Jonas&lastname=Stams&habit1=Niet%20Roken&habit2=drinken&habit3=wandelen
    public function addAction(Request $request)
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $jsonContent = $request->getContent();

        $customer = $serializer->deserialize($jsonContent, 'AppBundle\Entity\Customer', 'json');

        $em = $this->getDoctrine()->getManager();
        $em->persist($customer);
        $em->flush();

        return new Response('', Response::HTTP_OK);

    }


    /**
     * @Route("customer/find/{id}", name="find_by_id",requirements={"id": "\d+"})
     */
    public function findAction($id)
    {
        if (isset($id) && is_numeric($id)) {
            $customer = $this->getDoctrine()->getRepository('AppBundle:Customer')->find($id);
            if ($customer != null) {

                $encoders = array(new XmlEncoder(), new JsonEncoder());
                $normalizers = array(new ObjectNormalizer());
                $serializer = new Serializer($normalizers, $encoders);

                $jsonContent = $serializer->serialize($customer, 'json');

                $response = new Response(
                    $jsonContent,
                    Response::HTTP_OK,
                    array('content-type' => 'application/json'));

                return $response;
            } else {
                $response = new Response(
                    'customer not found with id: ' . $id,
                    Response::HTTP_NOT_FOUND,
                    array('content-type' => 'application/json'));
                return $response;
            }
        } else {
            $response = new Response(
                'customer not found with id: ' . $id,
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'application/json'));
            return $response;
        }
    }

    /**
     * @Route("customer/all")
     */
    public function getCustomersAction()
    {
        $allCustomers = $this->getDoctrine()->getRepository('AppBundle:Customer')->findAll();

        if ($allCustomers != null) {
            $encoders = array(new XmlEncoder(), new JsonEncoder());
            $normalizers = array(new ObjectNormalizer());
            $serializer = new Serializer($normalizers, $encoders);

            $jsonContent = $serializer->serialize($allCustomers, 'json');

            $response = new Response(
                $jsonContent,
                Response::HTTP_OK,
                array('content-type' => 'application/json'));


            return $response;
        } else {
            $response = new Response(
                '',
                Response::HTTP_NOT_FOUND,
                array('content-type' => 'application/json'));
            return $response;
        }

    }

    /**
     * @Route("customer/remove/{id}")
     */
    public function removeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $customer = $this->getDoctrine()->getRepository('AppBundle:Customer')->find($id);
        $em->remove($customer);
        $em->flush();

        $response = new Response(
            '',
            Response::HTTP_OK,
            array('content-type' => 'application/json'));
        return $response;
    }

    /**
     * @Route("customer/edit/{id}")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $customer = $this->getDoctrine()->getRepository('AppBundle:Customer')->find($id);

        if (!$customer) {
            throw $this->createNotFoundException('No customer found for id ' . $id);
        }

        $customer->setFirstName("Pietje");
        $em->flush();


        $view = $this->view(200)
            ->setTemplate("AppBundle:Customer:edit.html.twig");
        return $this->handleView($view);
    }

}
