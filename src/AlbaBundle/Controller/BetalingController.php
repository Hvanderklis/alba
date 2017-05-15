<?php

namespace AlbaBundle\Controller;

use AlbaBundle\Entity\Betaling;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Betaling controller.
 *
 * @Route("adminpanel/payment")
 */
class BetalingController extends Controller
{
    /**
     * Lists all betaling entities.
     *
     * @Route("/", name="betaling_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $betalings = $em->getRepository('AlbaBundle:Betaling')->findAll();

        return $this->render('@Alba/betaling/index.html.twig', array(
            'betalings' => $betalings,
        ));
    }

    /**
     * Creates a new betaling entity.
     *
     * @Route("/new", name="betaling_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $betaling = new Betaling();
        $form = $this->createForm('AlbaBundle\Form\BetalingType', $betaling);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($betaling);
            $em->flush($betaling);

            return $this->redirectToRoute('betaling_show', array('id' => $betaling->getId()));
        }

        return $this->render('@Alba/betaling/new.html.twig', array(
            'betaling' => $betaling,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a betaling entity.
     *
     * @Route("/{id}", name="betaling_show")
     * @Method("GET")
     */
    public function showAction(Betaling $betaling)
    {
        $deleteForm = $this->createDeleteForm($betaling);

        return $this->render('@Alba/betaling/show.html.twig', array(
            'betaling' => $betaling,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing betaling entity.
     *
     * @Route("/{id}/edit", name="betaling_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Betaling $betaling)
    {
        $deleteForm = $this->createDeleteForm($betaling);
        $editForm = $this->createForm('AlbaBundle\Form\BetalingType', $betaling);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('betaling_edit', array('id' => $betaling->getId()));
        }

        return $this->render('@Alba/betaling/edit.html.twig', array(
            'betaling' => $betaling,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a betaling entity.
     *
     * @Route("/{id}", name="betaling_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Betaling $betaling)
    {
        $form = $this->createDeleteForm($betaling);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($betaling);
            $em->flush();
        }

        return $this->redirectToRoute('betaling_index');
    }

    /**
     * Creates a form to delete a betaling entity.
     *
     * @param Betaling $betaling The betaling entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Betaling $betaling)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('betaling_delete', array('id' => $betaling->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
