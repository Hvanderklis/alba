<?php

namespace AlbaBundle\Controller;

use AlbaBundle\Entity\Klant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class CustomerController
 * @package AlbaBundle\Controller
 * @Route("/dashboard/customer")
 */
class CustomerController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="klantenIndex")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repositoryCustomers = $em->getRepository("AlbaBundle:Klant");
        $customers = $repositoryCustomers->findAll();

        return $this->render("AlbaBundle:Customers:index.html.twig", [
            "customers" => $customers
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{id}", name="klantenShow")
     */
    public function ShowAction(Klant $customers){
        return $this->render("@Alba/Customers/show.html.twig", [
            'customers' => $customers
        ]);
    }
}
