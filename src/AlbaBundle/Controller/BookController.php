<?php

namespace AlbaBundle\Controller;

use AlbaBundle\Entity\Extra;
use AlbaBundle\Entity\Gast;
use AlbaBundle\Entity\Klant;
use AlbaBundle\Entity\Reservering;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Session\SessionAuthenticationStrategy;

/**
 * Class BookController
 * @package AlbaBundle\Controller
 * @Route("/reservation")
 */
class BookController extends Controller
{
    /**
     * Step 1 - Arrival, Departure and amount travelCompanions
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/stepone", name="bookStepOne")
     */
    public function stepOneAction(Request $request){
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();
        $res = $session->get('reserveren');
        dump($res);

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
     * Step 2 - Choose rooms
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/steptwo", name="bookStepTwo")
     */
    public function stepTwoAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $roomRepository = $em->getRepository('AlbaBundle:Kamer');
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();

        $res = $session->get('reserveren');
        dump($res);

        $round = round(intval($this->get('session')->get('reserveren')['step1']['traveling-companions']) + 1 / 2);
        dump($round);

        $kamers = $this->get('session')->get('reserveren')['step1']['kamers'];
        $test = count($kamers) + 1;

        $kamer = array();
        if($request->getMethod() == "POST" && $request->get('next')) {
            for($x = 1; $x < $test; $x ++) {
                $cijfer = (string)$x;
                $kamer[$x] = $request->get($cijfer);

                $roomId = intval($kamer[$x]);
                $kamer[$x] = $roomRepository->find($roomId);

                if ($kamer[$x] == null){
                    unset($kamer[$x]);
                };
            }

            $amountRooms = count($kamer);
            $people = intval($this->get('session')->get('reserveren')['step1']['traveling-companions']) + 1;

            if ($people >= $amountRooms){
                $record = array('step1' => $res['step1'], 'step2' => $kamer);

                $session->set('reserveren', $record);

                return $this->redirect( $this->generateUrl('bookStepThree') );
            } else {
                $this->addFlash(
                    'notice',
                    'You can book only ' . $people . ' room(s)!'
                );
            }
        }
        if ($request->getMethod() == "POST" && $request->get('previous')){
            $session->set('reserveren', null);
            return $this->redirectToRoute('bookStepOne');
        }

        return $this->render('@Alba/web_reserveren/stepTwo.html.twig', [
            'kamers' => $kamers,
        ]);
    }

    /**
     * Step 3 Customer details
     *
     * @Route("/stepthree", name="bookStepThree")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function stepThreeAction(Request $request){
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();

        $res = $session->get('reserveren');

        $arrival = $res['step1']['arrival'];
        $departure = $res['step1']['departure'];
        $people = intval($res['step1']['traveling-companions']) + 1;
        $kamers = $res['step2'];
        $kamers = array_values($kamers);

        $sumRoom = [];
        for ($x = 0; $x < count($kamers); $x++){
            $sumRoom[$x] = $kamers[$x]->getPrijs();
        }

        $sum = 0;
        foreach($sumRoom as $key=>$value) {
            $sum+= $value;
        }

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
            $note = $request->get('note');

            $step3 = array(
                'firstName' => $firstName,
                'insertion' => $insertion,
                'lastName' => $lastName,
                'birthday' => $birthday,
                'gender' => $gender,
                'city' => $city,
                'language' => $language,
                'email' => $email,
                'phone' => $tel,
                'note' => $note
            );

            $travelCompanions = intval($res['step1']['traveling-companions']);
            dump($travelCompanions);

            $record = array('step1' => $res['step1'], 'step2' =>$res['step2'], 'step3' => $step3 );

            $session->set('reserveren', $record);

           return $this->redirect( $this->generateUrl('bookStepFour') );
        }

        return $this->render('@Alba/web_reserveren/stepThree.html.twig', [
            'arrival' => $arrival,
            'departure' => $departure,
            'people' => $people,
            'kamers' => $kamers,
            'sum' => $sum,
        ]);
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

        //arrival, departure and amount persons
        $arrival = $res['step1']['arrival'];
        $departure = $res['step1']['departure'];
        $people = intval($res['step1']['traveling-companions']) + 1;

        //kamers and total
        $kamers = $res['step2'];
        $kamers = array_values($kamers);

        $sumRoom = [];
        for ($x = 0; $x < count($kamers); $x++){
            $sumRoom[$x] = $kamers[$x]->getPrijs();
        }

        $sum = 0;
        foreach($sumRoom as $key=>$value) {
            $sum+= $value;
        }

        //customer details
        $firstNameCustomer = $res['step3']['firstName'];
        $insertionCustomer = $res['step3']['insertion'];
        $lastNameCustomer = $res['step3']['lastName'];
        $emailCustomer = $res['step3']['email'];
        $phoneCustomer = $res['step3']['phone'];

        //step 4 time
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

            return $this->redirect( $this->generateUrl('bookStepFive') );
        }

        return $this->render('@Alba/web_reserveren/stepFour.html.twig', [
            'travelCompanios' => $travelCompanios,
            'arrival' => $arrival,
            'departure' => $departure,
            'people' => $people,
            'kamers' => $kamers,
            'sum' => $sum,
            'firstName' => $firstNameCustomer,
            'lastName' => $lastNameCustomer,
            'insertion' => $insertionCustomer,
            'email' => $emailCustomer,
            'phone' => $phoneCustomer,
        ]);
    }

    /**
     * Step 5
     *
     * @Route("/stepfive", name="bookStepFive")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function stepFiveAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $extraRepository = $em->getRepository('AlbaBundle:Extra');
        $findall = $extraRepository->findAll();

        $session = $this->get('request_stack')->getCurrentRequest()->getSession();

        $res = $session->get('reserveren');

        //arrival, departure and amount persons
        $arrival = $res['step1']['arrival'];
        $departure = $res['step1']['departure'];
        $people = intval($res['step1']['traveling-companions']) + 1;

        //kamers and total
        $kamers = $res['step2'];
        $kamers = array_values($kamers);

        $sumRoom = [];
        for ($x = 0; $x < count($kamers); $x++){
            $sumRoom[$x] = $kamers[$x]->getPrijs();
        }

        $sum = 0;
        foreach($sumRoom as $key=>$value) {
            $sum+= $value;
        }

        //customer details
        $firstNameCustomer = $res['step3']['firstName'];
        $insertionCustomer = $res['step3']['insertion'];
        $lastNameCustomer = $res['step3']['lastName'];
        $emailCustomer = $res['step3']['email'];
        $phoneCustomer = $res['step3']['phone'];
        $note = $res['step3']['note'];

        //extra time
        $test = count($findall) + 1;

        $extra = array();

        if($request->getMethod() == "POST") {
            for($x = 1; $x < $test; $x ++) {
                $cijfer = (string)$x;
                $extra[$x] = $request->get($cijfer);

                $extraId = intval($extra[$x]);
                $extra[$x] = $extraRepository->find($extraId);
                dump($extra[$x]);
                if ($extra[$x] == null){
                    unset($extra[$x]);
                };
            }

            dump($extra);
            $record = array('step1' => $res['step1'], 'step2' => $res['step2'], 'step3' => $res['step3'], 'step4' => $res['step4'], 'step5' => $extra);

            $session->set('reserveren', $record);

            return $this->redirect($this->generateUrl('bookStepSix'));

        }

        return $this->render('@Alba/web_reserveren/stepFive.html.twig', array(
            'findall' => $findall,
            'arrival' => $arrival,
            'departure' => $departure,
            'people' => $people,
            'kamers' => $kamers,
            'sum' => $sum,
            'firstName' => $firstNameCustomer,
            'lastName' => $lastNameCustomer,
            'insertion' => $insertionCustomer,
            'email' => $emailCustomer,
            'phone' => $phoneCustomer,
            'note' => $note,
        ));
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
        $extraRepo = $em->getRepository('AlbaBundle:Extra');
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();

        $res = $session->get('reserveren');
        dump($res);

        $arrival = $res['step1']['arrival'];
        $departure = $res['step1']['departure'];


        $kamers = [];
        for ($x = 1; $x <=count($res['step2']); $x++){
            if (isset($res['step2'][$x])){
                $test = $res['step2'][$x];
                $kamer = $test->getId();
                $kamer = $roomRepo->find($kamer);
                $kamers[$x] =$kamer;
            }
        }

        $extras = [];
        for ($x = 1; $x <=count($res['step5']); $x++){
            if (isset($res['step5'][$x])){
                $test = $res['step5'][$x];
                $extra = $test->getId();
                $extra = $extraRepo->find($extra);
                $extras[$x] =$extra;
            }
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
            'extras' => $extras,
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
        $roomRepo = $em->getRepository('AlbaBundle:Kamer');
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();
        $res = $session->get('reserveren');

        $firstName = $res['step3']['firstName'];
        $insertion = $res['step3']['insertion'];
        $lastName = $res['step3']['lastName'];
        $gender = $res['step3']['gender'];
        $city = $res['step3']['city'];
        $language = $res['step3']['language'];
        $email = $res['step3']['email'];
        $phone = $res['step3']['phone'];

        $klant = new Klant();
        $klant->setVoornaam($firstName);
        $klant->setTussenvoegsel($insertion);
        $klant->setAchternaam($lastName);
        $klant->setGeboortedatum('lol');
        $klant->setGeslacht($gender);
        $klant->setPlaats($city);
        $klant->setTaal($language);
        $klant->setEmail($email);
        $klant->setTelefoon(intval($phone));

        $em->persist($klant);

        for ($x = 1; $x <=count($res['step4']); $x++) {
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
        }

        $arrival = $res['step1']['arrival'];
        $departure = $res['step1']['departure'];

        $arrival = date_create($arrival);
        $departure = date_create($departure);


        $reservering = new Reservering();
        $reservering->setAankomst($arrival);
        $reservering->setVertek($departure);
        $reservering->setKlant($klant->getId());


        for ($x = 1; $x <=count($res['step2']); $x++){
            if (isset($res['step2'][$x])) {
                $test = $res['step2'][$x];
                $kamer = $test->getId();
                $kamer = $roomRepo->find($kamer);
                $reservering->addKamer($kamer);
                $kamer->addReservering($reservering);

                $em->persist($kamer);
                $em->persist($reservering);
            }
        }
//        $em->flush();
//        return $this->redirectToRoute('bookStepEight');
    }

    /**
     * Step 8
     *
     * @Route("/overzicht", name="bookStepEight")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function stepEightAction()
        {

            $session = $this->get('request_stack')->getCurrentRequest()->getSession();

            $res = $session->get('reserveren');

            $email = $res['step3']['email'];


            $mailer = $this->container->get('mailer');
            $transport = \Swift_SmtpTransport::newInstance('smtp.mailtrap.io', 465, 'ssl')
                ->setUsername('6b85cd05068089')
                ->setPassword('10aaf099663b37');

            $mailer = \Swift_Mailer::newInstance($transport);

            $message = \Swift_Message::newInstance('Test')
                ->setSubject('Summary')
                ->setFrom('info@alba.com')
                ->setTo($email)
                ->setBody('Hallo');
            $this->get('mailer')->send($message);

            return $this->render("@Alba/mail.html.twig");
        }
}