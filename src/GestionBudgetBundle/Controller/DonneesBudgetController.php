<?php

namespace GestionBudgetBundle\Controller;

use GestionBudgetBundle\Entity\DonneesBudget;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Donneesbudget controller.
 *
 * @Route("donneesbudget")
 */
class DonneesBudgetController extends Controller
{
    /**
     * Lists all donneesBudget entities.
     *
     * @Route("/", name="donneesbudget_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $donneesBudgets = $em->getRepository('GestionBudgetBundle:DonneesBudget')->findAll();

        return $this->render('donneesbudget/index.html.twig', array(
            'donneesBudgets' => $donneesBudgets,
        ));
    }

    /**
     * Creates a new donneesBudget entity.
     *
     * @Route("/new", name="donneesbudget_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $donneesBudget = new Donneesbudget();
        $form = $this->createForm('GestionBudgetBundle\Form\DonneesBudgetType', $donneesBudget);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($donneesBudget);
            $em->flush();

            return $this->redirectToRoute('donneesbudget_show', array('id' => $donneesBudget->getId()));
        }

        return $this->render('donneesbudget/new.html.twig', array(
            'donneesBudget' => $donneesBudget,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a donneesBudget entity.
     *
     * @Route("/{id}", name="donneesbudget_show")
     * @Method("GET")
     */
    public function showAction(DonneesBudget $donneesBudget)
    {
        $deleteForm = $this->createDeleteForm($donneesBudget);

        return $this->render('donneesbudget/show.html.twig', array(
            'donneesBudget' => $donneesBudget,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing donneesBudget entity.
     *
     * @Route("/{id}/edit", name="donneesbudget_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, DonneesBudget $donneesBudget)
    {
        $deleteForm = $this->createDeleteForm($donneesBudget);
        $editForm = $this->createForm('GestionBudgetBundle\Form\DonneesBudgetType', $donneesBudget);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('donneesbudget_edit', array('id' => $donneesBudget->getId()));
        }

        return $this->render('donneesbudget/edit.html.twig', array(
            'donneesBudget' => $donneesBudget,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a donneesBudget entity.
     *
     * @Route("/{id}", name="donneesbudget_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, DonneesBudget $donneesBudget)
    {
        $form = $this->createDeleteForm($donneesBudget);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($donneesBudget);
            $em->flush();
        }

        return $this->redirectToRoute('donneesbudget_index');
    }

    /**
     * Creates a form to delete a donneesBudget entity.
     *
     * @param DonneesBudget $donneesBudget The donneesBudget entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DonneesBudget $donneesBudget)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('donneesbudget_delete', array('id' => $donneesBudget->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
