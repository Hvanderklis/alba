<?php

namespace AlbaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;
class WebsiteController extends Controller
{
     /**
     * @Route("/contact", name="mail")
     */
    public function contacAction(Request $request)
    {
        if($request->getMethod() == "POST") {

            $Subject = $request->get("Subject");
            $email = $request->get("Email");
            $message = $request->get("message");

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

        }
        return $this->render("@Alba/mail.html.twig");
    }
}