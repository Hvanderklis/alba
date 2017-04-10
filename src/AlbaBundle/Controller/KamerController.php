<?php

namespace AlbaBundle\Controller;

use AlbaBundle\Entity\Kamer;
use AlbaBundle\Entity\KamerAfbeelding;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Kamer controller.
 *
 * @Route("adminpanel/kamer")
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

    /**
     * @Route("/{id}/image", name="image")
     */
    public function readImage(Request $request, Kamer $kamer){
        $uploadLocation = $this->getParameter('upload_directory');

        if ($request->isMethod('POST')){
            $image = $request->files->get('image');

            $roomName = $kamer->getKamerNaam();
            $roomName = str_replace(" ", "_", $roomName);

            $roomImage = new KamerAfbeelding();

            $imageName = preg_replace('/\\.[^.\\s]{3,4}$/', '', $image->getClientOriginalName());
            $fullImageName = str_replace(" ", "_", $image->getClientOriginalName());

            $type = $fullImageName;
            $position = strpos($type, '.');
            $lenght = strlen($type);
            $typo = substr($type, $position, $lenght);
            $typo = ltrim($typo,'.');

            $roomImage->setPath("uploads/" . $roomName . "/" . $fullImageName);
            $roomImage->setName($imageName);
            $roomImage->setKamer($kamer);
            $roomImage->setType($typo);

            $roomImage->upload();

            $em = $this->getDoctrine()->getManager();

            $em->persist($roomImage);
            $em->flush();

            return $this->redirectToRoute('image', ['id' => $kamer->getId()]);
            }

        return $this->render('AlbaBundle:RoomImage:index.html.twig', [
            'kamer' => $kamer,
        ]);
    }
}
