<?php

namespace AlbaBundle\Controller;

use AlbaBundle\Entity\Extra;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Extra controller.
 *
 * @Route("adminpanel/extra")
 */
class ExtraController extends Controller
{
    /**
     * Lists all extra entities.
     *
     * @Route("/", name="extra_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $extras = $em->getRepository('AlbaBundle:Extra')->findAll();

        return $this->render('AlbaBundle:Extra:index.html.twig', array(
            'extras' => $extras,
        ));
    }

    /**
     * Creates a new extra entity.
     *
     * @Route("/new", name="extra_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $extra = new Extra();
        $form = $this->createForm('AlbaBundle\Form\ExtraType', $extra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($extra);
            $em->flush($extra);

            return $this->redirectToRoute('extra_show', array('id' => $extra->getId()));
        }

        return $this->render('AlbaBundle:Extra:new.html.twig', array(
            'extra' => $extra,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a extra entity.
     *
     * @Route("/{id}", name="extra_show")
     * @Method("GET")
     */
    public function showAction(Extra $extra)
    {
        $deleteForm = $this->createDeleteForm($extra);

        return $this->render('AlbaBundle:Extra:show.html.twig', array(
            'extra' => $extra,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing extra entity.
     *
     * @Route("/{id}/edit", name="extra_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Extra $extra)
    {
        $deleteForm = $this->createDeleteForm($extra);
        $editForm = $this->createForm('AlbaBundle\Form\ExtraType', $extra);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('extra_edit', array('id' => $extra->getId()));
        }

        return $this->render('extra/edit.html.twig', array(
            'extra' => $extra,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a extra entity.
     *
     * @Route("/{id}", name="extra_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Extra $extra)
    {
        $form = $this->createDeleteForm($extra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($extra);
            $em->flush();
        }

        return $this->redirectToRoute('extra_index');
    }

    /**
     * Creates a form to delete a extra entity.
     *
     * @param Extra $extra The extra entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Extra $extra)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('extra_delete', array('id' => $extra->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
