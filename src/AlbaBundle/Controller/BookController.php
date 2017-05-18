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
    public function stepOneAction(Request $request){
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();

        $em = $this->getDoctrine()->getManager();
        $reservationRepository = $em->getRepository('AlbaBundle:Reservering');
        $roomRepository = $em->getRepository('AlbaBundle:Kamer');

        $amountRooms = $roomRepository->findAll();
        $travelingCompanionsAmount = count($amountRooms) * 2;

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

            if (empty($checkDates)){
                $kamers = $roomRepository->findAll();
            } else {
                $kamerIds = $checkDates;
                $kamers = $roomRepository->createQueryBuilder('k')
                    ->innerJoin('k.reservering', 'r')
                    ->where('k.id != :kamerId')
                    ->setParameter('kamerId', $kamerIds)
                    ->getQuery()
                    ->getResult();
            }

            $step1 = array('step1' => array(
                'arrival' => $arrival,
                'departure' => $department,
                'traveling-companions' => $travelingCompanions,
                'kamers' => $kamers
            ));

            $session->set('reserveren', $step1);

            return $this->redirect( $this->generateUrl('bookStepTwo') );
        }

        return $this->render('@Alba/web_reserveren/stepOne.html.twig', [
            'amountTravel' => $travelingCompanionsAmount
        ]);
    }

    /**
     * Step two
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/steptwo", name="bookStepTwo")
     */
    public function stepTwoAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $roomRepository = $em->getRepository('AlbaBundle:Kamer');
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();

//        $res = $session->get('reserveren', array());
        $res = $session->get('reserveren');


        $kamers = $this->get('session')->get('reserveren')['step1']['kamers'];
        $test = count($kamers) + 1;

        $kamer = array();

        if($request->getMethod() == "POST") {
            for($x = 1; $x < $test; $x ++) {
                $cijfer = (string)$x;
                $kamer[$x] = $request->get($cijfer);

                $roomId = intval($kamer[$x]);
                $kamer[$x] = $roomRepository->find($roomId);

                if ($kamer[$x] == null){
                    unset($kamer[$x]);
                };
            }

            $record = array('step1' => $res['step1'], 'step2' => $kamer);

            $session->set('reserveren', $record);

            return $this->redirect( $this->generateUrl('bookStepThree') );
        }

        return $this->render('@Alba/web_reserveren/stepTwo.html.twig', [
            'kamers' => $kamers,
        ]);
    }

    /**
     * Step Three
     *
     * @Route("/stepthree", name="bookStepThree")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function stepThreeAction(Request $request){
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();

        $res = $session->get('reserveren');
        dump($res);

        if ($request->getMethod() == 'POST'){
            $firstName = $request->get("firstName");
            $insertion = $request->get("insertion");
            $lastName = $request->get("lastName");
            $birthday = $request->get("birthday");
            $gender = $request->get("gender");
            $city = $request->get("city");
            $language = $request->get("language");
            $email = $request->get("email");
            $tel = $request->get("tel");

            $step3 = array(
                'firstName' => $firstName,
                'insertion' => $insertion,
                'lastName' => $lastName,
                'birthday' => $birthday,
                'gender' => $gender,
                'city' => $city,
                'language' => $language,
                'email' => $email,
                'phone' => $tel
            );

            $record = array('step1' => $res['step1'], 'step2' =>$res['step2'], 'step3' => $step3 );

            $session->set('reserveren', $record);

            return $this->redirect( $this->generateUrl('bookStepFour') );
        }

        return $this->render('@Alba/web_reserveren/stepThree.html.twig');
    }

    /**
     * @Route("/stepfour", name="bookStepFour")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function stepFourAction(Request $request){
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();

        $res = $session->get('reserveren');
        dump($res);

        $travelCompanios = (intval($res['step1']['traveling-companions']));

        $step4 = [];

        if ($request->getMethod() == 'POST'){
            for ($x = 1; $x <= $travelCompanios; $x++){

            }
        }

        return $this->render('@Alba/web_reserveren/stepFour.html.twig', [
            'travelCompanios' => $travelCompanios
        ]);
    }
}