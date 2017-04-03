<?php
/**
 * Created by PhpStorm.
 * User: Henk van der Klis
 * Date: 4/3/2017
 * Time: 15:19
 */

namespace AlbaBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class WebsiteController extends Controller
{
    /**
     * @Route("/sightseeing")
     */
    public function sightseeingAction()
    {
        return $this->render("@Alba/sightseeing.html.twig");
    }
}