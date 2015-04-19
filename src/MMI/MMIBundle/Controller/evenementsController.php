<?php

namespace MMI\MMIBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MMI\MMIBundle\Entity\evenements;
use MMI\MMIBundle\Form\evenementsType;

/**
 * evenements controller.
 *
 */
class evenementsController extends Controller
{

    /**
     * Lists all evenements entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MMIMMIBundle:evenements')->findAll();

        return $this->render('MMIMMIBundle:evenements:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new evenements entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new evenements();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('evenements_show', array('id' => $entity->getId())));
        }

        return $this->render('MMIMMIBundle:evenements:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a evenements entity.
     *
     * @param evenements $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(evenements $entity)
    {
        $form = $this->createForm(new evenementsType(), $entity, array(
            'action' => $this->generateUrl('evenements_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new evenements entity.
     *
     */
    public function newAction()
    {
        $entity = new evenements();
        $form   = $this->createCreateForm($entity);

        return $this->render('MMIMMIBundle:evenements:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a evenements entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MMIMMIBundle:evenements')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find evenements entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MMIMMIBundle:evenements:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing evenements entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MMIMMIBundle:evenements')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find evenements entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MMIMMIBundle:evenements:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a evenements entity.
    *
    * @param evenements $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(evenements $entity)
    {
        $form = $this->createForm(new evenementsType(), $entity, array(
            'action' => $this->generateUrl('evenements_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing evenements entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MMIMMIBundle:evenements')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find evenements entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('evenements_edit', array('id' => $id)));
        }

        return $this->render('MMIMMIBundle:evenements:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a evenements entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MMIMMIBundle:evenements')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find evenements entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('evenements'));
    }

    /**
     * Creates a form to delete a evenements entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('evenements_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
