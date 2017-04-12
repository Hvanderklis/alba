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
     * @Route("/sightseeing")
     */

    public function sightseeingAction()
    {
        return $this->render("@Alba/sightseeing.html.twig");
    }
}