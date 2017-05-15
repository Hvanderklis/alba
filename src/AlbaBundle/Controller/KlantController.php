<?php

namespace AlbaBundle\Controller;

use AlbaBundle\Entity\Klant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Klant controller.
 *
 * @Route("adminpanel/customer")
 */
class KlantController extends Controller
{
    /**
     * Lists all customer entities.
     *
     * @Route("/", name="customer_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $klants = $em->getRepository('AlbaBundle:Klant')->findAll();

        return $this->render('AlbaBundle:Customer:index.html.twig', array(
            'klants' => $klants,
        ));
    }

    /**
     * Creates a new klant entity.
     *
     * @Route("/new", name="customer_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $klant = new Klant();
        $form = $this->createForm('AlbaBundle\Form\KlantType', $klant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($klant);
            $em->flush($klant);
            return $this->redirectToRoute('customer_show', array('id' => $klant->getId()));
        }

        return $this->render('AlbaBundle:Customer:new.html.twig', array(
            'klant' => $klant,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a klant entity.
     *
     * @Route("/{id}", name="customer_show")
     * @Method("GET")
     */
    public function showAction(Klant $klant, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $customerRepository = $em->getRepository('AlbaBundle:KamerAfbeelding');
        $customers = $customerRepository->findBy(['id' => $klant->getId()]);

        $gastRepo = $em->getRepository('AlbaBundle:Gast');
        $gasten = $gastRepo->createQueryBuilder('g')
            ->innerJoin('g.klant', 'k')
            ->where('k.id = :klantId')
            ->setParameter('klantId', $customers)
            ->getQuery()
            ->getResult();


        $deleteForm = $this->createDeleteForm($klant);

        return $this->render('AlbaBundle:Customer:show.html.twig', array(
            'customer' => $klant,
            'guests' => $gasten,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing klant entity.
     *
     * @Route("/{id}/edit", name="customer_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Klant $klant)
    {
        $deleteForm = $this->createDeleteForm($klant);
        $editForm = $this->createForm('AlbaBundle\Form\KlantType', $klant);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('customer_edit', array('id' => $klant->getId()));
        }

        return $this->render('AlbaBundle:Customer:edit.html.twig', array(
            'klant' => $klant,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a klant entity.
     *
     * @Route("/{id}", name="customer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Klant $klant)
    {
        $form = $this->createDeleteForm($klant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($klant);
            $em->flush();
        }
        return $this->redirectToRoute('customer_index');
    }

    /**
     * Creates a form to delete a klant entity.
     * @param Klant $klant The klant entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Klant $klant)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('customer_delete', array('id' => $klant->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
