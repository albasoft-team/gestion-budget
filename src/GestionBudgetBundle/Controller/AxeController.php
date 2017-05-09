<?php

namespace GestionBudgetBundle\Controller;

use GestionBudgetBundle\Entity\Axe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Axe controller.
 *
 * @Route("axe")
 */
class AxeController extends Controller
{
    /**
     * Lists all axe entities.
     *
     * @Route("/", name="axe_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $axes = $em->getRepository('GestionBudgetBundle:Axe')->findAll();

        return $this->render('axe/index.html.twig', array(
            'axes' => $axes,
        ));
    }

    /**
     * Creates a new axe entity.
     *
     * @Route("/new", name="axe_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $axe = new Axe();
        $form = $this->createForm('GestionBudgetBundle\Form\AxeType', $axe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($axe);
            $em->flush();

            return $this->redirectToRoute('axe_show', array('id' => $axe->getId()));
        }

        return $this->render('axe/new.html.twig', array(
            'axe' => $axe,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a axe entity.
     *
     * @Route("/{id}", name="axe_show")
     * @Method("GET")
     */
    public function showAction(Axe $axe)
    {
        $deleteForm = $this->createDeleteForm($axe);

        return $this->render('axe/show.html.twig', array(
            'axe' => $axe,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing axe entity.
     *
     * @Route("/{id}/edit", name="axe_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Axe $axe)
    {
        $deleteForm = $this->createDeleteForm($axe);
        $editForm = $this->createForm('GestionBudgetBundle\Form\AxeType', $axe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('axe_edit', array('id' => $axe->getId()));
        }

        return $this->render('axe/edit.html.twig', array(
            'axe' => $axe,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a axe entity.
     *
     * @Route("/{id}", name="axe_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Axe $axe)
    {
        $form = $this->createDeleteForm($axe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($axe);
            $em->flush();
        }

        return $this->redirectToRoute('axe_index');
    }

    /**
     * Creates a form to delete a axe entity.
     *
     * @param Axe $axe The axe entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Axe $axe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('axe_delete', array('id' => $axe->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
