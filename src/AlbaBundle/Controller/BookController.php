<?php

namespace AlbaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BookController
 * @package AlbaBundle\Controller
 * @Route("/reservation")
 */
class BookController extends Controller
{
    /**
     * Step One
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/stepone", name="bookStepOne")
     */
    public function reserverenAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $reservationRepository = $em->getRepository('AlbaBundle:Reservering');
        $roomRepository = $em->getRepository('AlbaBundle:Kamer');

        if($request->getMethod() == "POST") {
            $arrival = $request->get('arrival');
            $department = $request->get('departure');
            $travelingCompanions = $request->get('traveling-companions');

            $checkDates = $reservationRepository->createQueryBuilder('reservering')
                ->select('reservering.id')
                ->where('reservering.vertek BETWEEN :arrival AND :departure')
                ->andWhere('reservering.vertek BETWEEN :arrival AND :departure')
                ->setParameter('arrival', $arrival)
                ->setParameter('departure', $department)
                ->getQuery()
                ->getResult();

            dump($checkDates);

            if ($checkDates != null){
                $kamerId = $checkDates;
                $kamers = $roomRepository->createQueryBuilder('k')
                    ->innerJoin('k.reservering', 'r')
                    ->where('k.id != :kamerId')
                    ->setParameter('kamerId', $kamerId)
                    ->getQuery()
                    ->getResult();
                dump($kamers);
                dump(count($kamers));
                dump(count($kamers) * 2);

                if (count($kamers) * 2 < $travelingCompanions){
                    dump('meh');
                } else {
                    dump('yeah');
                }
            }







//            $session = $this->get('request_stack')->getCurrentRequest()->getSession();
////            // $cart = $session->set('cart', '');
//            $session->set('reserveren', array('arrival' => $arrival));

//            dump($session);
        }

        return $this->render('@Alba/web_reserveren/stepOne.html.twig');
//            $Firstname = $request->get("Firstname");
//            $Insertion = $request->get("Insertion");
//            $Lastname = $request->get("Lastname");
//            $Birthdate = $request->get("Birthdate");
//            $Gender = $request->get("Gender");
//            $City = $request->get("City");
//            $Language = $request->get("Language");
//            $Email = $request->get("Email");
//            $Tel = $request->get("Tel");
//            $GuestFirstname = $request->get("GuestFirstname");
//            $GuestInsertion = $request->get("GuestInsertion");
//            $GuestLastname = $request->get("GuestLastname");

//            // get the cart from  the session
//            $session = $this->get('request_stack')->getCurrentRequest()->getSession();
//            // $cart = $session->set('cart', '');
//            $session->set('reserveren', array('Firstname' => $Firstname,
//                'Insertion' => $Insertion,
//                'Lastname' => $Lastname,
//                'Birthdate' => $Birthdate,
//                'Gender' => $Gender,
//                'City' => $City,
//                'Language' => $Language,
//                'Email' => $Email,
//                'Tel' => $Tel,
//                'GuestFirstname' => $GuestFirstname,
//                'GuestInsertion' => $GuestInsertion,
//                'GuestLastname' => $GuestLastname,
//            ));
//            $criteria = $session->get('reserveren');
//            dump($criteria);
//
//            $em = $this->getDoctrine()->getManager();
//
//            $kamers = $em->getRepository('AlbaBundle:Kamer')->findAll();
//
//            return $this->render('AlbaBundle:kamer:booking.html.twig', array(
//                'kamers' => $kamers,
//            ));
//        }
//        return $this->render('@Alba/web_reserveren/form.html.twig');
    }
}