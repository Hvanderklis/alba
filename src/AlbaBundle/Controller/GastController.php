<?php

namespace AlbaBundle\Controller;

use AlbaBundle\Entity\Gast;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Gast controller.
 *
 * @Route("adminpanel/guest")
 */
class GastController extends Controller
{
    /**
     * Lists all gast entities.
     *
     * @Route("/", name="guest_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $gasts = $em->getRepository('AlbaBundle:Gast')->findAll();

        return $this->render('AlbaBundle:Guest:index.html.twig', array(
            'gasts' => $gasts,
        ));
    }

    /**
     * Creates a new gast entity.
     *
     * @Route("/new", name="guest_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $gast = new Gast();
        $form = $this->createForm('AlbaBundle\Form\GastType', $gast);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($gast);
            $em->flush($gast);

            return $this->redirectToRoute('guest_show', array('id' => $gast->getId()));
        }

        return $this->render('AlbaBundle:Guest:new.html.twig', array(
            'gast' => $gast,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a gast entity.
     *
     * @Route("/{id}", name="guest_show")
     * @Method("GET")
     */
    public function showAction(Gast $gast)
    {
        $deleteForm = $this->createDeleteForm($gast);

        return $this->render('AlbaBundle:Guest:show.html.twig', array(
            'gast' => $gast,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing gast entity.
     *
     * @Route("/{id}/edit", name="guest_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Gast $gast)
    {
        $deleteForm = $this->createDeleteForm($gast);
        $editForm = $this->createForm('AlbaBundle\Form\GastType', $gast);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('guest_edit', array('id' => $gast->getId()));
        }

        return $this->render('AlbaBundle:Guest:edit.html.twig', array(
            'gast' => $gast,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a gast entity.
     *
     * @Route("/{id}", name="guest_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Gast $gast)
    {
        $form = $this->createDeleteForm($gast);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($gast);
            $em->flush();
        }

        return $this->redirectToRoute('guest_index');
    }

    /**
     * Creates a form to delete a gast entity.
     *
     * @param Gast $gast The gast entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Gast $gast)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('guest_delete', array('id' => $gast->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
