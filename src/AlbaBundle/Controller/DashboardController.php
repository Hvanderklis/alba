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
        return $this->render('@Alba/Reservation/show.html.twig');
    }
}