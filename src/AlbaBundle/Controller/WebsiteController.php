<?php
/**
 * Created by PhpStorm.
 * User: Henk van der Klis
 * Date: 4/5/2017
 * Time: 14:51
 */

namespace AlbaBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WebsiteController extends Controller
{
    /**
     * @Route("/contact")
     */
    public function formExampleAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('name', TextType::class)
            ->add('email', TextType::class)
            ->add('message', TextType::class)
            ->add('submit', SubmitType::class, [
                'label' => 'Submit!',
                'attr'  => [
                    'class' => 'button primary'
                ]
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $name = $form->getData()['name'];
            $email = $form->getData()['email'];
            $message = $form->getData()['message'];

            $this->sendMail($name, $email, $message);
        }

        return $this->render('@Alba/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }


    private function sendMail($body)
    {
        $mail = \Swift_Message::newInstance()
            ->setSubject('test mail')
            ->setFrom('test1@test1.com')
            ->setTo('test2@test2.com')
            ->setBody($body)
        ;

        $this->get('mailer')->send($mail);
    }
}