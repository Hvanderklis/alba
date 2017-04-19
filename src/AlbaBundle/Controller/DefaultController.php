<?php

namespace AlbaBundle\Controller;

use AlbaBundle\Entity\Kamer;
use AlbaBundle\Entity\KamerAfbeelding;
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
    public function showKamerAction(Kamer $kamer, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $kamerRepo = $em->getRepository('AlbaBundle:Kamer');
        $kamers = $kamerRepo->findBy(['id' => $kamer->getId()]);

        $kamerAfbeeldingRepo = $em->getRepository('AlbaBundle:KamerAfbeelding');
        $kamerAfbeeldingen = $kamerAfbeeldingRepo->createQueryBuilder('kafbeelding')
            ->innerJoin('kafbeelding.kamer', 'k')
            ->where('k.id = :kamerId')
            ->setParameter('kamerId', $kamers)
            ->getQuery()
            ->getResult();

        dump($kamers);
        return $this->render('AlbaBundle:kamer:kamerreserverenshow.html.twig', array(
            'kamerAfbeeldingen' => $kamerAfbeeldingen,
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
     * @Route("/reserveren", name="reserveren")
     * @Method({"GET", "POST"})
     */
    public function reserverenAction(Request $request)
    {
        $klant = new Klant();
        $form = $this->createForm('AlbaBundle\Form\KlantType', $klant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($klant);
            $em->flush($klant);
            return $this->redirectToRoute('customer_show', array('id' => $klant->getId()));
        }

        return $this->render('AlbaBundle:Reservation:reserveren.html.twig', array(
            'klant' => $klant,
            'form' => $form->createView(),
        ));
    }
}