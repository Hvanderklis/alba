<?php
/**
 * Created by PhpStorm.
 * User: Henk van der Klis
<<<<<<< HEAD
 * Date: 4/5/2017
 * Time: 14:51
 */

namespace AlbaBundle\Controller;
=======
 * Date: 4/3/2017
 * Time: 15:19
 */

namespace AlbaBundle\Controller;


>>>>>>> sightseeing
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class WebsiteController extends Controller
{
    /**
<<<<<<< HEAD
     * @Route("/contact")
     */
    public function contacAction()
    {
        return $this->render("@Alba/contact.html.twig");
=======
     * @Route("/sightseeing")
     */
    public function sightseeingAction()
    {
        return $this->render("@Alba/sightseeing.html.twig");
>>>>>>> sightseeing
    }
}