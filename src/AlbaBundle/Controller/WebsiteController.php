<?php

namespace AlbaBundle\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use AlbaBundle\Entity\Klant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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

        return $this->render("@Alba/mail.html.twig");
    }

}