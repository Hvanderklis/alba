<?php

namespace AlbaBundle\Controller;

use AlbaBundle\Entity\Seizoen;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Seizoen controller.
 *
 * @Route("adminpanel/season")
 * @Security("has_role('ROLE_USER')")
 */
class SeizoenController extends Controller
{
    /**
     * Lists all seizoen entities.
     *
     * @Route("/", name="seizoen_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $seizoens = $em->getRepository('AlbaBundle:Seizoen')->findAll();

        return $this->render('AlbaBundle:seizoen:index.html.twig', array(
            'seizoens' => $seizoens,
        ));
    }

    /**
     * Creates a new seizoen entity.
     *
     * @Route("/new", name="seizoen_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $seizoen = new Seizoen();
        $form = $this->createForm('AlbaBundle\Form\SeizoenType', $seizoen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($seizoen);
            $em->flush($seizoen);

            return $this->redirectToRoute('seizoen_show', array('id' => $seizoen->getId()));
        }

        return $this->render('AlbaBundle:seizoen:new.html.twig', array(
            'seizoen' => $seizoen,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a seizoen entity.
     *
     * @Route("/{id}", name="seizoen_show")
     * @Method("GET")
     */
    public function showAction(Seizoen $seizoen)
    {
        $deleteForm = $this->createDeleteForm($seizoen);

        return $this->render('AlbaBundle:seizoen:show.html.twig', array(
            'seizoen' => $seizoen,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing seizoen entity.
     *
     * @Route("/{id}/edit", name="seizoen_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Seizoen $seizoen)
    {
        $deleteForm = $this->createDeleteForm($seizoen);
        $editForm = $this->createForm('AlbaBundle\Form\SeizoenType', $seizoen);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('seizoen_edit', array('id' => $seizoen->getId()));
        }

        return $this->render('AlbaBundle:seizoen:show.html.twig', array(
            'seizoen' => $seizoen,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a seizoen entity.
     *
     * @Route("/{id}", name="seizoen_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Seizoen $seizoen)
    {
        $form = $this->createDeleteForm($seizoen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($seizoen);
            $em->flush();
        }

        return $this->redirectToRoute('seizoen_index');
    }

    /**
     * Creates a form to delete a seizoen entity.
     *
     * @param Seizoen $seizoen The seizoen entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Seizoen $seizoen)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('seizoen_delete', array('id' => $seizoen->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
