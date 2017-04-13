<?php
/**
 * Created by PhpStorm.
 * User: Henk van der Klis
 * Date: 4/5/2017
 * Time: 14:51
 */

namespace AlbaBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class WebsiteController extends Controller
{
    /**
     * @Route("/contact")
     */
    public function contacAction(Request $request)
    {
        return $this->render("@Alba/contact.html.twig");
    }


    /**
     * @route("/set", name="set")
     */

    public function test(Request $request)
    {
        $this->get('session')->set('shopping_cart', [
            [
                'item' => 'Playstation 4',
                'quantity' => '1',
                'price' => '300',
            ],
            [
                'item' => 'Xbox One',
                'quantity' => '1',
                'price' => '300',
            ]
        ]);


        return new Response('Done');
    }

    /**
     * @Route("/get", name="reservation_index")
     */

    public function roomReservation(Request $request)
    {
        $shopping_cart = $this->get('session')->get('shopping_cart');
        var_dump($shopping_cart);
        die();
        return new Response();
    }

}

