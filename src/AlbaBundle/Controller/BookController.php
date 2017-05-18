<?php

namespace AlbaBundle\Controller;

use AlbaBundle\Entity\Gast;
use AlbaBundle\Entity\Klant;
use AlbaBundle\Entity\Reservering;
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
     * Step 4
     *
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
                $firstName = $request->get("firstName". $x);
                $insertion = $request->get("insertion". $x);
                $lastName = $request->get('lastName'. $x);
                $gender = $request->get('gender'. $x);
                $city = $request->get('city'. $x);
                $language = $request->get('language'. $x);

                $step4[$x]['firstName'] = $firstName;
                $step4[$x]['insertion'] = $insertion;
                $step4[$x]['lastName'] = $lastName;
                $step4[$x]['gender'] = $gender;
                $step4[$x]['city'] = $city;
                $step4[$x]['language'] = $language;
            }

            $record = array('step1' => $res['step1'], 'step2' => $res['step2'], 'step3' => $res['step3'], 'step4' => $step4);

            $session->set('reserveren', $record);

            $test = $session->get('reserveren', array());
            dump($test);

            return $this->redirect( $this->generateUrl('bookStepSix') );
        }

        return $this->render('@Alba/web_reserveren/stepFour.html.twig', [
            'travelCompanios' => $travelCompanios
        ]);
    }

    /**
     * Step 6
     *
     * @Route("/stepsix", name="bookStepSix")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function stepSixAction(){
        $em = $this->getDoctrine()->getManager();
        $roomRepo = $em->getRepository('AlbaBundle:Kamer');
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();

        $res = $session->get('reserveren');
        dump($res);

        $arrival = $res['step1']['arrival'];
        $departure = $res['step1']['departure'];

        $kamers = [];
        for ($x = 1; $x <=count($res['step2']); $x++){
            $test = $res['step2'][$x];
            $kamer = $test->getId();
            $kamer = $roomRepo->find($kamer);
            $kamers[$x] =$kamer;
        }

        $firstName = $res['step3']['firstName'];
        $insertion = $res['step3']['insertion'];
        $lastName = $res['step3']['lastName'];
        $birthday = $res['step3']['birthday'];
        $gender = $res['step3']['gender'];
        $city = $res['step3']['city'];
        $language = $res['step3']['language'];
        $email = $res['step3']['email'];
        $phone = $res['step3']['phone'];

        $gasten = [];
        for ($x = 1; $x <=count($res['step4']); $x++){
            $test2 = $res['step4'][$x];
            dump($test2);
            $gasten[$x] = $test2;
        }


        return $this->render('@Alba/web_reserveren/stepSix.html.twig', [
            'arrival' => $arrival,
            'departure' => $departure,
            'kamers' => $kamers,
            'firstName' => $firstName,
            'insertion' => $insertion,
            'lastName' => $lastName,
            'birthday' => $birthday,
            'gender' => $gender,
            'city' => $city,
            'language' => $language,
            'email' => $email,
            'phone' => $phone,
            'gasten' => $gasten,
        ]);
    }

    /**
     * Step 7
     *
     * @Route("/final", name="bookStepSix2")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function stepSix2Action()
    {
        $em = $this->getDoctrine()->getManager();
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();
        $res = $session->get('reserveren');
        dump($res);

        $firstName = $res['step3']['firstName'];
        $insertion = $res['step3']['insertion'];
        $lastName = $res['step3']['lastName'];
        $birthday = $res['step3']['birthday'];
        $gender = $res['step3']['gender'];
        $city = $res['step3']['city'];
        $language = $res['step3']['language'];
        $email = $res['step3']['email'];
        $phone = $res['step3']['phone'];

        $klant = new Klant();
        $klant->setVoornaam($firstName);
        $klant->setTussenvoegsel($insertion);
        $klant->setAchternaam($lastName);
        $klant->setGeboortedatum($birthday);
        $klant->setGeslacht($gender);
        $klant->setPlaats($city);
        $klant->setTaal($language);
        $klant->setEmail($email);
        $klant->setTelefoon($phone);

        $em->persist($klant);
        $em->flush();

        for ($x = 1; $x <=count($res['step4']); $x++){
            $test2 = $res['step4'][$x];

            $gast = new Gast();
            $gast->setVoornaam($test2['firstName']);
            $gast->setTussenvoegsel($test2['insertion']);
            $gast->setAchternaam($test2['lastName']);
            $gast->setGender('gender');
            $gast->setWoonplaats('city');
            $gast->setTaal('language');
            $gast->setKlant($klant->getId());

            $em->persist($gast);
            $em->flush();
        }

        $reservering = new Reservering();

        

        dump($reservering);

    }
}