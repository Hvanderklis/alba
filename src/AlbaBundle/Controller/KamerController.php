<?php

namespace AlbaBundle\Controller;

use AlbaBundle\Entity\Kamer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Kamer controller.
 *
 * @Route("adminpanel/room")
 * @Security("has_role('ROLE_USER')")
 */
class KamerController extends Controller
{
    /**
     * Lists all kamer entities.
     *
     * @Route("/", name="kamer_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $kamers = $em->getRepository('AlbaBundle:Kamer')->findAll();

        return $this->render('AlbaBundle:kamer:index.html.twig', array(
            'kamers' => $kamers,
        ));
    }

    /**
     * Creates a new kamer entity.
     *
     * @Route("/new", name="kamer_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $kamer = new Kamer();
        $form = $this->createForm('AlbaBundle\Form\KamerType', $kamer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($kamer);
            $em->flush($kamer);

            return $this->redirectToRoute('kamer_show', array('id' => $kamer->getId()));
        }

        return $this->render('AlbaBundle:kamer:new.html.twig', array(
            'kamer' => $kamer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a kamer entity.
     *
     * @Route("/{id}", name="kamer_show")
     * @Method("GET")
     */
    public function showAction(Kamer $kamer)

    {
        $deleteForm = $this->createDeleteForm($kamer);

        return $this->render('AlbaBundle:kamer:show.html.twig', array(
            'kamer' => $kamer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing kamer entity.
     *
     * @Route("/{id}/edit", name="kamer_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Kamer $kamer)
    {
        $deleteForm = $this->createDeleteForm($kamer);
        $editForm = $this->createForm('AlbaBundle\Form\KamerType', $kamer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('kamer_edit', array('id' => $kamer->getId()));
        }

        return $this->render('AlbaBundle:kamer:edit.html.twig', array(
            'kamer' => $kamer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a kamer entity.
     *
     * @Route("/{id}", name="kamer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Kamer $kamer)
    {
        $form = $this->createDeleteForm($kamer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($kamer);
            $em->flush();
        }

        return $this->redirectToRoute('kamer_index');
    }

    /**
     * Creates a form to delete a kamer entity.
     *
     * @param Kamer $kamer The kamer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Kamer $kamer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('kamer_delete', array('id' => $kamer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
