<?php
/**
 * Created by PhpStorm.
 * User: Henk van der Klis
 * Date: 4/5/2017
 * Time: 14:51
 */

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
}