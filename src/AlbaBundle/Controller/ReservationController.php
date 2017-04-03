<?php

namespace AlbaBundle\Controller;

use AlbaBundle\Entity\Reservering;
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
//     * @Route("/", name="reservationIndex")
     */
    public function IndexAction(){
        $em = $this->getDoctrine()->getManager();
        $repositoryReservation = $em->getRepository("AlbaBundle:Reservering");
        $reservations = $repositoryReservation->findAll();
        return $this->render("AlbaBundle:Reservation:index.html.twig", [
            "reservations" => $reservations
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{id}", name="reservationShow")
     */
    public function ShowAction(Reservering $reservering){
        return $this->render("@Alba/Reservation/show.html.twig", [
            'reservation' => $reservering
        ]);
    }
}