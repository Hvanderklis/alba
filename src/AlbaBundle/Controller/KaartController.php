<?php

namespace AlbaBundle\Controller;

use AlbaBundle\Entity\Kaart;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Kaart controller.
 *
 * @Route("adminpanel/creditcard")
 * @Security("has_role('ROLE_USER')")
 */
class KaartController extends Controller
{
    /**
     * Lists all kaart entities.
     *
     * @Route("/", name="card_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $kaarts = $em->getRepository('AlbaBundle:Kaart')->findAll();

        return $this->render('AlbaBundle:Creditcard:index.html.twig', array(
            'kaarts' => $kaarts,
        ));
    }

    /**
     * Creates a new kaart entity.
     *
     * @Route("/new", name="card_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $kaart = new Kaart();
        $form = $this->createForm('AlbaBundle\Form\KaartType', $kaart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($kaart);
            $em->flush($kaart);

            return $this->redirectToRoute('card_show', array('id' => $kaart->getId()));
        }

        return $this->render('AlbaBundle:Creditcard:new.html.twig', array(
            'kaart' => $kaart,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a kaart entity.
     *
     * @Route("/{id}", name="card_show")
     * @Method("GET")
     */
    public function showAction(Kaart $kaart)
    {
        $deleteForm = $this->createDeleteForm($kaart);

        return $this->render('AlbaBundle:Creditcard:show.html.twig', array(
            'kaart' => $kaart,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing kaart entity.
     *
     * @Route("/{id}/edit", name="card_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Kaart $kaart)
    {
        $deleteForm = $this->createDeleteForm($kaart);
        $editForm = $this->createForm('AlbaBundle\Form\KaartType', $kaart);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('card_edit', array('id' => $kaart->getId()));
        }

        return $this->render('@Alba/Creditcard/edit.html.twig', array(
            'kaart' => $kaart,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a kaart entity.
     *
     * @Route("/{id}", name="card_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Kaart $kaart)
    {
        $form = $this->createDeleteForm($kaart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($kaart);
            $em->flush();
        }

        return $this->redirectToRoute('card_index');
    }

    /**
     * Creates a form to delete a kaart entity.
     *
     * @param Kaart $kaart The kaart entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Kaart $kaart)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('card_delete', array('id' => $kaart->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
