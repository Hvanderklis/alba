<?php

namespace AlbaBundle\Controller;

use AlbaBundle\Entity\Klant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;
class WebsiteController extends Controller
{
    /**
     * @Route("/sightseeing")
     */

    public function sightseeingAction()
    {
        return $this->render("@Alba/sightseeing.html.twig");
    }

    /**
     * @Route("/faq")
     */

    public function FAQAction()
    {
        return $this->render("@Alba/Default/FAQ.html.twig");
    }

    /**
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
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/reserveren", name="reserveren")
     */



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