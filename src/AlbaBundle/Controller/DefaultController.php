<?php

namespace AlbaBundle\Controller;

use AlbaBundle\Entity\Kamer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * KamerReserveren controller.
 *
 * @Route("/")
 */

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('AlbaBundle:Default:index.html.twig');
    }

    /**
     * Lists all kamer entities.
     *
     * @Route("/kamers", name="kamer_reserveren")
     */
    public function kamerAction()
    {
        $em = $this->getDoctrine()->getManager();

        $kamers = $em->getRepository('AlbaBundle:Kamer')->findAll();

        return $this->render('AlbaBundle:kamer:kamerreserveren.html.twig', array(
            'kamers' => $kamers,
        ));
    }
    /**
     * Finds and displays a kamer entity.
     *
     * @Route("/kamers/{id}", name="kamer_reserveren_show")
     *
     */
    public function showKamerAction(Kamer $kamer)

    {

        return $this->render('AlbaBundle:kamer:kamerreserverenshow.html.twig', array(
            'kamer' => $kamer,
        ));
    }
}