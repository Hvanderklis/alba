<?php
/**
 * Created by PhpStorm.
 * User: Richh
 * Date: 5-4-2017
 * Time: 11:05
 */
namespace AlbaBundle\Controller;
use AlbaBundle\Entity\Kamer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class WebsiteController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/room")
     */
    public function kameraction(){
        return $this->render('AlbaBundle::kamer.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/rooms", name="RoomsIndex")
     */
    public function IndexAction(){
        $em = $this->getDoctrine()->getManager();
        $repositoryRooms = $em->getRepository("AlbaBundle:Kamer");
        $Rooms = $repositoryRooms->findAll();
        return $this->render("AlbaBundle::kamer.html.twig", [
            "Kamer" => $Rooms
        ]);
    }
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{id}", name="RoomsShow")
     */
    public function ShowAction(Kamer $kamer){
        return $this->render("@Alba/show.html.twig", [
            'Kamer' => $kamer
        ]);
    }
}