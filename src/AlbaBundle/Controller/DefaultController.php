<?php

namespace AlbaBundle\Controller;

use AlbaBundle\Entity\Gast;
use AlbaBundle\Entity\Kamer;
use AlbaBundle\Entity\Klant;
use AlbaBundle\Entity\Reservering;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * KamerReserveren controller.
 *
 * @Route("/")
 */
class DefaultController extends Controller
{
    /**
     * Homepage
     *
     * @Route("/"), name="homepage"
     */
    public function indexAction()
    {
        return $this->render('AlbaBundle:Default:index.html.twig');
    }

    /**
     * Lists all kamer entities.
     *
     * @Route("/kamers", name="kamer_reserveren")
     */
    public function kamerAction(){

        $em = $this->getDoctrine()->getManager();

        $kamerRepo = $em->getRepository('AlbaBundle:Kamer')->findAll();

        $kamerafbeeldingRepo = $em->getRepository('AlbaBundle:KamerAfbeelding')->findAll();

        return $this->render('AlbaBundle:kamer:booking.html.twig', array(
            'kamer' => $kamerRepo,
            'kamerafbeelding' => $kamerafbeeldingRepo,
        ));
    }

    /**
     * Finds and displays a kamer entity.
     *
//     * @Route("/kamers/{id}", name="kamer_show")
     * @Route("/kamers/{id}", name="kamer_reserveren_show")
     */
    public function showKamerAction(Kamer $kamer, Request $request){
        $em = $this->getDoctrine()->getManager();
        $roomRepository = $em->getRepository('AlbaBundle:Kamer');
        $rooms = $roomRepository->findBy(['id' => $kamer->getId()]);

        $kamerAfbeeldingRepo = $em->getRepository('AlbaBundle:KamerAfbeelding');
        $kamerafbeeldingen = $kamerAfbeeldingRepo->createQueryBuilder('ka')
            ->innerJoin('ka.kamer', 'k')
            ->where('k.id = :kamerId')
            ->setParameter('kamerId', $rooms)
            ->getQuery()
            ->getResult();

        return $this->render('AlbaBundle:Kamer:bookingshow.html.twig', array(
            'kamer' => $kamer,
            'kamerafbeelding' => $kamerafbeeldingen,
        ));
    }

    /**
     * Sightseeing
     *
     * @Route("/sightseeing", name="sightseeing")
     */
    public function sightseeingAction(){
        return $this->render("@Alba/sightseeing.html.twig");
    }

    /**
     * About
     *
     * @Route("/about", name="about")
     */
    public function aboutAction(){
        return $this->render("@Alba/about.html.twig");
    }

    /**
     * Disclaimer
     *
     * @Route("/disclaimer", name="disclaimer")
     */
    public function disclaimerAction(){
        return $this->render("@Alba/disclaimer.html.twig");
    }

    /**
     * Contact
     *
     * @Route("/contact", name="mail")
     */
    public function contacAction(Request $request){
        if($request->getMethod() == "POST") {
            $Subject = $request->get("Subject");
            $email = $request->get("Email");
            $message = $request->get("message");
            $mailer = $this->container->get('mailer');
            $transport = \Swift_SmtpTransport::newInstance('smtp.mailtrap.io', 465, 'ssl')
                ->setUsername('6b85cd05068089')
                ->setPassword('10aaf099663b37');
            $mailer = \Swift_Mailer::newInstance($transport);
            $message = \Swift_Message::newInstance('Test')
                ->setSubject($Subject)
                ->setFrom($email)
                ->setTo('contact@alba.com')
                ->setBody($message);
            $this->get('mailer')->send($message);
        }
        return $this->render("@Alba/mail.html.twig");
    }

    /**
     * Creates a new klant entity.
     *
     * @Route("/reserveren2", name="reserveren2")
     */
    public function reserveren2Action(Request $request){

        // get the cart from  the session
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();
        // $cart = $session->set('cart', '');
        $session->get('reserveren');

        $criteria = $session->get('reserveren');
        dump($criteria);

        return $this->render("@Alba/Reservation/reserverenindex2.html.twig");
    }


    /**
     * @Route("booking", name="booking")
     */
    public function bookingAction(Request $request){

        // get the cart from  the session
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();
       $session->get('reserveren');

        $Firstname = $this->get('session')->get('reserveren')['Firstname'];
        $Insertion = $this->get('session')->get('reserveren')['Insertion'];
        $Lastname = $this->get('session')->get('reserveren')['Lastname'];
        $Birthdate = $this->get('session')->get('reserveren')['Birthdate'];
        $Gender = $this->get('session')->get('reserveren')['Gender'];
        $City = $this->get('session')->get('reserveren')['City'];
        $Language = $this->get('session')->get('reserveren')['Language'];
        $Email = $this->get('session')->get('reserveren')['Firstname'];
        $Tel = $this->get('session')->get('reserveren')['Tel'];
        $GuestFirstname = $this->get('session')->get('reserveren')['GuestFirstname'];
        $GuestInsertion = $this->get('session')->get('reserveren')['GuestInsertion'];
        $GuestLastname = $this->get('session')->get('reserveren')['GuestLastname'];


        $klant = new Klant();

        $klant->setVoornaam($Firstname);
        $klant->setTussenvoegsel($Insertion);
        $klant->setAchternaam($Lastname);
        $klant->setGeboortedatum($Birthdate);
        $klant->setGeslacht($Gender);
        $klant->setPlaats($City);
        $klant->setTaal($Language);
        $klant->setEmail($Email);
        $klant->setTelefoon($Tel);

        $em = $this->getDoctrine()->getManager();
        $em->persist($klant);
        $em->flush($klant);

        $gast = new Gast();
        $gast->setVoornaam($GuestFirstname);
        $gast->setAchternaam($GuestLastname);
        $gast->setTussenvoegsel($GuestInsertion);
        $gast->setGeboortedatum("Not needed");
        $gast->setWoonplaats("/");
        $gast->setTaal("/");
        $gast->setKlant($klant);
        




        $em1 = $this->getDoctrine()->getManager();
        $em1->persist($gast);
        $em1->flush($gast);


        $criteria = $session->get('reserveren');
        dump($criteria);

        $reservering = new Reservering();
        $form = $this->createForm('AlbaBundle\Form\ReserveringType', $reservering);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservering);
            $em->flush($reservering);
        }

        return $this->render('AlbaBundle:Reservation:booking.html.twig', array(
            'reservering' => $reservering,
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("reservation", name="reservation")
     */
    public function newreserverenAction(Request $request)
    {


        if ($request->getMethod() == "POST") {
            $session = $this->get('request_stack')->getCurrentRequest()->getSession();
            $Firstname = $request->get("Firstname");
            $Insertion = $request->get("Insertion");
            $Lastname = $request->get("Lastname");
            $Birthdate = $request->get("Birthdate");
            $Gender = $request->get("Gender");
            $City = $request->get("City");
            $Language = $request->get("Language");
            $Email = $request->get("Email");
            $Tel = $request->get("Tel");
            $GuestFirstname = $request->get("GuestFirstname");
            $GuestInsertion = $request->get("GuestInsertion");
            $GuestLastname = $request->get("GuestLastname");


            $session->get('reserveren', array('Firstname' => $Firstname,
                'Insertion' => $Insertion,
                'Lastname' => $Lastname,
                'Birthdate' => $Birthdate,
                'Gender' => $Gender,
                'City' => $City,
                'Language' => $Language,
                'Email' => $Email,
                'Tel' => $Tel,
                'GuestFirstname' => $GuestFirstname,
                'GuestInsertion' => $GuestInsertion,
                'GuestLastname' => $GuestLastname,

            ));

            $Firstname = $this->get('session')->get('reserveren')['Firstname'];
            $Insertion = $this->get('session')->get('reserveren')['Insertion'];
            $Lastname = $this->get('session')->get('reserveren')['Lastname'];
            $Birthdate = $this->get('session')->get('reserveren')['Birthdate'];
            $Gender = $this->get('session')->get('reserveren')['Gender'];
            $City = $this->get('session')->get('reserveren')['City'];
            $Language = $this->get('session')->get('reserveren')['Language'];
            $Email = $this->get('session')->get('reserveren')['Firstname'];
            $Tel = $this->get('session')->get('reserveren')['Tel'];


            $klant = new Klant();

            $klant->setVoornaam($Firstname);
            $klant->setTussenvoegsel($Insertion);
            $klant->setAchternaam($Lastname);
            $klant->setGeboortedatum($Birthdate);
            $klant->setGeslacht($Gender);
            $klant->setPlaats($City);
            $klant->setTaal($Language);
            $klant->setEmail($Email);
            $klant->setTelefoon($Tel);


            $em = $this->getDoctrine()->getManager();
            $em->persist($klant);
            $em->flush($klant);

            $criteria = $session->get('reserveren');
            dump($criteria);

            return $this->render('AlbaBundle:kamer:booking.html.twig');
        }
    }
    /**
     * @Route("/faq")
     */

    public function FAQAction()
    {
        return $this->render('@Alba/Default/FAQ.html.twig');
    }
    /**
     * @Route("/help")
     */

    public function helpAction()
    {
        return $this->render('@Alba/help.html.twig');
    }
}