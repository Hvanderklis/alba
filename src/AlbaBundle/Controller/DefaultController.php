<?php

namespace AlbaBundle\Controller;

use AlbaBundle\Entity\Kamer;
use AlbaBundle\Entity\Klant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * KamerReserveren controller.
 *
 * @Route("/")
 */

class DefaultController extends Controller
{
    /**
     * @Route("/")
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
    public function kamerAction()
    {
        $em = $this->getDoctrine()->getManager();

        $kamers = $em->getRepository('AlbaBundle:Kamer')->findAll();

        return $this->render('AlbaBundle:kamer:kamerreserveren.html.twig', array(
            'kamers' => $kamers,
        ));
    }

    /**
     * Finds and displays a kamer entity.
     *
     * @Route("/kamers/{id}", name="kamer_reserveren_show")
     *
     */
    public function showKamerAction(Kamer $kamer)

    {

        return $this->render('AlbaBundle:kamer:kamerreserverenshow.html.twig', array(
            'kamer' => $kamer,
        ));
    }

    /**
     * Sightseeing
     *
     * @Route("/sightseeing", name="sightseeing")
     */
    public function sightseeingAction()
    {
        return $this->render("@Alba/sightseeing.html.twig");
    }

    /**
     * About
     *
     * @Route("/about", name="about")
     */
    public function aboutAction()
    {
        return $this->render("@Alba/about.html.twig");
    }

    /**
     * Disclaimer
     *
     * @Route("/disclaimer", name="disclaimer")
     */
    public function disclaimerAction()
    {
        return $this->render("@Alba/disclaimer.html.twig");
    }

    /**
     * Contact
     *
     * @Route("/contact", name="mail")
     */
    public function contacAction(Request $request)
    {
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
     *
     */
    public function reserveren2Action(Request $request)
    {

        // get the cart from  the session
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();
        // $cart = $session->set('cart', '');
        $session->get('reserveren');

        $criteria = $session->get('reserveren');
        dump($criteria);


        return $this->render("@Alba/Reservation/reserverenindex2.html.twig");
    }

    /**
     * @route("/reserveren", name="reserveren")
     */
    public function reserverenAction(Request $request)
    {

        if($request->getMethod() == "POST") {
            $Firstname = $request->get("Firstname");
            $Insertion = $request->get("Insertion");
            $Lastname = $request->get("Lastname");
            $Birthdate = $request->get("Birthdate");
            $Gender = $request->get("Gender");
            $City = $request->get("City");
            $Language = $request->get("Language");
            $Email = $request->get("Email");
            $Tel = $request->get("Tel");
            $FirstnameGuest = $request->get("Guestfirstname");
            $LastnameGuest = $request->get("Guestlastname");
            $PhoneGuest = $request->get("Guestphonenumber");
            $Address = $request->get("Guestaddress");

            // get the cart from  the session
            $session = $this->get('request_stack')->getCurrentRequest()->getSession();
            // $cart = $session->set('cart', '');
            $session->set('reserveren', array('Firstname' => $Firstname,
                'Insertion' => $Insertion,
                'Lastname' => $Lastname,
                'Birthdate' => $Birthdate,
                'Gender' => $Gender,
                'City' => $City,
                'Language' => $Language,
                'Email' => $Email,
                'Tel' => $Tel,
                'Guestfirstname' => $FirstnameGuest,
                'Guestlastname' => $LastnameGuest,
                'Guestphonenumber' => $PhoneGuest,
                'Guestaddress' => $Address
            ));
            $criteria = $session->get('reserveren');
            dump($criteria);


            return $this->render("@Alba/Reservation/reserverenindex2.html.twig");
        }
            return $this->render("@Alba/Reservation/form.html.twig");
    }
}