<?php

namespace AlbaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class ReservationController
 * @package AlbaBundle\Controller
 * @Route("dashboard/reservation")
 */
class ReservationController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="reservationIndex")
     */
    public function IndexAction(){
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("AlbaBundle:Kamer");
        return $this->render("AlbaBundle:Reservation:index.html.twig", [

        ]);
    }
}