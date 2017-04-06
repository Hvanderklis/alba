<?php

namespace AlbaBundle\Controller;

use AlbaBundle\Entity\KamerPrijs;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Kamerprij controller.
 *
 * @Route("adminpanel/kamerprijs")
 */
class KamerPrijsController extends Controller
{
    /**
     * Lists all kamerPrij entities.
     *
     * @Route("/", name="kamerprijs_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $kamerPrijs = $em->getRepository('AlbaBundle:KamerPrijs')->findAll();

        return $this->render('AlbaBundle:kamerprijs:index.html.twig', array(
            'kamerPrijs' => $kamerPrijs,
        ));
    }

    /**
     * Creates a new kamerPrij entity.
     *
     * @Route("/new", name="kamerprijs_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $kamerPrijs = new Kamerprijs();
        $form = $this->createForm('AlbaBundle\Form\KamerPrijsType', $kamerPrijs);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($kamerPrijs);
            $em->flush($kamerPrijs);

            return $this->redirectToRoute('kamerprijs_show', array('id' => $kamerPrijs->getId()));
        }

        return $this->render('AlbaBundle:kamerprijs:new.html.twig', array(
            'kamerPrijs' => $kamerPrijs,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a kamerPrij entity.
     *
     * @Route("/{id}", name="kamerprijs_show")
     * @Method("GET")
     */
    public function showAction(KamerPrijs $kamerPrijs)
    {
        $deleteForm = $this->createDeleteForm($kamerPrijs);

        return $this->render('AlbaBundle:kamerprijs:show.html.twig', array(
            'kamerPrijs' => $kamerPrijs,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing kamerPrij entity.
     *
     * @Route("/{id}/edit", name="kamerprijs_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, KamerPrijs $kamerPrijs)
    {
        $deleteForm = $this->createDeleteForm($kamerPrijs);
        $editForm = $this->createForm('AlbaBundle\Form\KamerPrijsType', $kamerPrijs);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('kamerprijs_edit', array('id' => $kamerPrijs->getId()));
        }

        return $this->render('AlbaBundle:kamerprijs:edit.html.twig', array(
            'kamerPrijs' => $kamerPrijs,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a kamerPrij entity.
     *
     * @Route("/{id}", name="kamerprijs_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, KamerPrijs $kamerPrijs)
    {
        $form = $this->createDeleteForm($kamerPrijs);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($kamerPrijs);
            $em->flush();
        }

        return $this->redirectToRoute('kamerprijs_index');
    }

    /**
     * Creates a form to delete a kamerPrij entity.
     *
     * @param KamerPrijs $kamerPrij The kamerPrij entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(KamerPrijs $kamerPrijs)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('kamerprijs_delete', array('id' => $kamerPrijs->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
