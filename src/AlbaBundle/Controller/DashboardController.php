<?php

namespace AlbaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DashboardController
 * @package AlbaBundle\Controller
 * @Route("/dashboard")
 */
class DashboardController extends Controller
{
    /**
     * @Route("/", name="mainDashboard")
     * @Security("has_role('ROLE_USER')")
     */
    public function IndexAction(){
        return $this->render('AlbaBundle:Default:DashboardIndex.html.twig', [

        ]);
    }

    /**
     * @Route("/faq", name="faq")
     */
    public function FAQAction(){
        return $this->render("AlbaBundle:Default:FAQ.html.twig", [

        ]);
    }
}