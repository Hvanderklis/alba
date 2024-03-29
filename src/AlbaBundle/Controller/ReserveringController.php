<?php

namespace AlbaBundle\Controller;

use AlbaBundle\Entity\Reservering;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Reservering controller.
 *
 * @Route("adminpanel/reservation")
 * @Security("has_role('ROLE_USER')")
 */
class ReserveringController extends Controller
{
    /**
     * Lists all reservering entities.
     *
     * @Route("/", name="reservering_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reserverings = $em->getRepository('AlbaBundle:Reservering')->findAll();

        return $this->render('@Alba/Reservation/index.html.twig', array(
            'reservations' => $reserverings,
        ));
    }

    /**
     * Creates a new reservering entity.
     *
     * @Route("/new", name="reservering_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $reservering = new Reservering();
        $form = $this->createForm('AlbaBundle\Form\ReserveringType', $reservering);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservering);
            $em->flush($reservering);

            return $this->redirectToRoute('reservering_show', array('id' => $reservering->getId()));
        }

        return $this->render('AlbaBundle:Reservation:new.html.twig', array(
            'reservering' => $reservering,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reservering entity.
     *
     * @Route("/{id}", name="reservering_show")
     * @Method("GET")
     */
    public function showAction(Reservering $reservering, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($reservering);

        $customerRepository = $em->getRepository('AlbaBundle:Klant');
        $customers = $customerRepository->findBy(['id' => $reservering->getKlant()]);

        $reserId = $reservering->getId();
        $kamerRepo = $em->getRepository('AlbaBundle:Kamer');
        $kamers = $kamerRepo->createQueryBuilder('k')
            ->innerJoin('k.reservering', 'r')
            ->where('r.id = :reserveringId')
            ->setParameter('reserveringId', $reserId)
            ->getQuery()
            ->getResult();

        $reserId = $reservering->getId();
        $extraRepo = $em->getRepository('AlbaBundle:Extra');
        $extras = $extraRepo->createQueryBuilder('e')
            ->innerJoin('e.reservering', 'r')
            ->where('r.id = :reserveringId')
            ->setParameter('reserveringId', $reserId)
            ->getQuery()
            ->getResult();

        $reserId = $reservering->getId();
        $gastRepo = $em->getRepository('AlbaBundle:Gast');
        $gasten = $gastRepo->createQueryBuilder('g')
            ->innerJoin('g.reservering', 'r')
            ->where('r.id = :reserveringId')
            ->setParameter('reserveringId', $reserId)
            ->getQuery()
            ->getResult();


        return $this->render('AlbaBundle:Reservation:show.html.twig', array(
            'reservation' => $reservering,
            'delete_form' => $deleteForm->createView(),
            'customers' => $customers,
            'rooms' => $kamers,
            'extras' => $extras,
            'guests' => $gasten,
        ));
    }


    /**
     * Displays a form to edit an existing reservering entity.
     *
     * @Route("/{id}/edit", name="reservering_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Reservering $reservering)
    {
        $deleteForm = $this->createDeleteForm($reservering);
        $editForm = $this->createForm('AlbaBundle\Form\ReserveringType', $reservering);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservering_show', array('id' => $reservering->getId()));
        }

        return $this->render('AlbaBundle:Reservation:edit.html.twig', array(
            'reservering' => $reservering,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reservering entity.
     *
     * @Route("/{id}", name="reservering_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Reservering $reservering)
    {
        $form = $this->createDeleteForm($reservering);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->remove($reservering);
            $em->flush();
        }

        return $this->redirectToRoute('reservering_index');
    }

    /**
     * Creates a form to delete a reservering entity.
     *
     * @param Reservering $reservering The reservering entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reservering $reservering)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reservering_delete', array('id' => $reservering->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
