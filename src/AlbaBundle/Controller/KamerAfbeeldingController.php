<?php

namespace AlbaBundle\Controller;

use AlbaBundle\Entity\Kamer;
use AlbaBundle\Entity\KamerAfbeelding;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Kamerafbeelding controller.
 *
 * @Route("adminpanel/roomimage")
 * @Security("has_role('ROLE_USER')")
 */
class KamerAfbeeldingController extends Controller
{
    /**
     * Lists all kamerAfbeelding entities.
     *
     * @Route("/", name="kamerafbeelding_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $kamerAfbeeldings = $em->getRepository('AlbaBundle:KamerAfbeelding')->findAll();

        return $this->render('@Alba/kamerafbeelding/index.html.twig', array(
            'kamerAfbeeldings' => $kamerAfbeeldings,
        ));
    }

    /**
     * Creates a new kamerAfbeelding entity.
     *
     * @Route("/new", name="kamerafbeelding_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $kamerAfbeelding = new Kamerafbeelding();
        $form = $this->createForm('AlbaBundle\Form\KamerAfbeeldingType', $kamerAfbeelding);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $file = $kamerAfbeelding->getFile();

            $imageName = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file->getClientOriginalName());
            $fullImageName = str_replace(" ", "_", $file->getClientOriginalName());

            $kamerAfbeelding->setName($imageName);

            $type = $fullImageName;
            $position = strpos($type, '.');
            $lenght = strlen($type);
            $typo = substr($type, $position, $lenght);
            $typo = ltrim($typo,'.');
            $kamerAfbeelding->setType($typo);

            $roomId = $em->getRepository('AlbaBundle:Kamer')->find($kamerAfbeelding->getKamer());
            $roomName = $roomId->getKamerNaam();
            $roomName = str_replace(" ", "_", $roomName);
            $kamerAfbeelding->setPath("uploads/" . $roomName);

            mkdir(__DIR__ . '/../../../web/uploads/' . $roomName);
            $kamerMaps = str_replace(" ", "_", __DIR__ . '/../../../web/uploads/' . $roomName);
            $files = scandir($kamerMaps);
            $fileArray = [];
            foreach ($files as $file){
                if($file == "." || $file == ".."){
                    continue;
                }
                array_push($fileArray, "uploads/" . $roomName . "/" . $file);
            }

            $checkFile = "uploads/". $roomName . "/" . $imageName . "." . $typo;

            if (in_array($checkFile, $fileArray)){
                $this->get('session')->getFlashBag()->set('error', 'The name does already exist');
            }
            else {
                $kamerAfbeelding->upload();

                $em->persist($kamerAfbeelding);
                $em->flush($kamerAfbeelding);

                return $this->redirectToRoute('kamerafbeelding_show', array('id' => $kamerAfbeelding->getId()));
            }
        }

        return $this->render('@Alba/kamerafbeelding/new.html.twig', array(
            'kamerAfbeelding' => $kamerAfbeelding,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a kamerAfbeelding entity.
     *
     * @Route("/{id}", name="kamerafbeelding_show")
     * @Method("GET")
     */
    public function showAction(KamerAfbeelding $kamerAfbeelding)
    {
        $deleteForm = $this->createDeleteForm($kamerAfbeelding);

        $path = "/".$kamerAfbeelding->getPath()."/".$kamerAfbeelding->getName().".".$kamerAfbeelding->getType();
        dump($path);

        return $this->render('@Alba/kamerafbeelding/show.html.twig', array(
            'kamerAfbeelding' => $kamerAfbeelding,
            'delete_form' => $deleteForm->createView(),
            'path' => $path,
        ));
    }

    /**
     * Deletes a kamerAfbeelding entity.
     *
     * @Route("/{id}", name="kamerafbeelding_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, KamerAfbeelding $kamerAfbeelding)
    {
        $form = $this->createDeleteForm($kamerAfbeelding);
        $form->handleRequest($request);

        $kamerNaam = $kamerAfbeelding->getPath();
        $kamerMaps = str_replace(" ", "_", __DIR__ . '/../../../web/' . $kamerNaam);
        $files = scandir($kamerMaps);
        $fileArray = [];

        foreach ($files as $file){
            if($file == "." || $file == ".."){
                continue;
            }
            array_push($fileArray, "uploads/" . $kamerNaam . "/" . $file);
        }

        $imagePath = __DIR__ . '/../../../web/' . $kamerAfbeelding->getPath(). "/" . $kamerAfbeelding->getName() . "." . $kamerAfbeelding->getType();

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            unlink($imagePath);
            $em->remove($kamerAfbeelding);
            $em->flush();
        }
        return $this->redirectToRoute('kamerafbeelding_index');
    }

    /**
     * Creates a form to delete a kamerAfbeelding entity.
     *
     * @param KamerAfbeelding $kamerAfbeelding The kamerAfbeelding entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(KamerAfbeelding $kamerAfbeelding)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('kamerafbeelding_delete', array('id' => $kamerAfbeelding->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
