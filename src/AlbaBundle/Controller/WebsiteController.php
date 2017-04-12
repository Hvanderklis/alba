<?php

namespace AlbaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class WebsiteController extends Controller
{
    /**
     * @Route("/contact")
     */
    public function contacAction()
    {
        return $this->render("@Alba/contact.html.twig");
    }

    /**
     * @Route("/rooms")
     */
    public function roomReservationAction(){

        return $this->render('@Alba/Website/reservationIndex.html.twig');
    }
}