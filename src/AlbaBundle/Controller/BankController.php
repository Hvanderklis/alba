<?php

namespace AlbaBundle\Controller;

use AlbaBundle\Entity\Bank;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BankController.
 * @package AlbaBundle\Controller
 * @Route("adminpanel/bank")
 * @Security("has_role('ROLE_USER')")
 */
class BankController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="bankIndex")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $banks = $em->getRepository('AlbaBundle:Bank')->findAll();

        return $this->render('AlbaBundle:Bank:index.html.twig', array(
            'banks' => $banks,
        ));
    }

    /**
     * Creates a new bank entity.
     *
     * @Route("/new", name="bank_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $bank = new Bank();
        $form = $this->createForm('AlbaBundle\Form\BankType', $bank);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bank);
            $em->flush($bank);

            return $this->redirectToRoute('bank_show', array('id' => $bank->getId()));
        }

        return $this->render('AlbaBundle:Bank:new.html.twig', array(
            'bank' => $bank,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a bank entity.
     *
     * @Route("/{id}", name="bank_show")
     * @Method("GET")
     */
    public function showAction(Bank $bank)
    {
        $deleteForm = $this->createDeleteForm($bank);

        return $this->render('AlbaBundle:Bank:show.html.twig', array(
            'bank' => $bank,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing bank entity.
     *
     * @Route("/{id}/edit", name="bank_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Bank $bank)
    {
        $deleteForm = $this->createDeleteForm($bank);
        $editForm = $this->createForm('AlbaBundle\Form\BankType', $bank);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bank_edit', array('id' => $bank->getId()));
        }

        return $this->render('AlbaBundle:Bank:edit.html.twig', array(
            'bank' => $bank,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a bank entity.
     *
     * @Route("/{id}", name="bank_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Bank $bank)
    {
        $form = $this->createDeleteForm($bank);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bank);
            $em->flush();
        }

        return $this->redirectToRoute('bankIndex');
    }

    /**
     * Creates a form to delete a bank entity.
     *
     * @param Bank $bank The bank entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Bank $bank)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bank_delete', array('id' => $bank->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
