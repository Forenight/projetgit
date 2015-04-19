<?php

namespace MMI\MMIBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MMI\MMIBundle\Entity\agenda;
use MMI\MMIBundle\Form\agendaType;

/**
 * agenda controller.
 *
 */
class agendaController extends Controller
{

    /**
     * Lists all agenda entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MMIMMIBundle:agenda')->findAll();

        return $this->render('MMIMMIBundle:agenda:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new agenda entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new agenda();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('agenda_show', array('id' => $entity->getId())));
        }

        return $this->render('MMIMMIBundle:agenda:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a agenda entity.
     *
     * @param agenda $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(agenda $entity)
    {
        $form = $this->createForm(new agendaType(), $entity, array(
            'action' => $this->generateUrl('agenda_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new agenda entity.
     *
     */
    public function newAction()
    {
        $entity = new agenda();
        $form   = $this->createCreateForm($entity);

        return $this->render('MMIMMIBundle:agenda:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a agenda entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MMIMMIBundle:agenda')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find agenda entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MMIMMIBundle:agenda:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing agenda entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MMIMMIBundle:agenda')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find agenda entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MMIMMIBundle:agenda:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a agenda entity.
    *
    * @param agenda $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(agenda $entity)
    {
        $form = $this->createForm(new agendaType(), $entity, array(
            'action' => $this->generateUrl('agenda_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing agenda entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MMIMMIBundle:agenda')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find agenda entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('agenda_edit', array('id' => $id)));
        }

        return $this->render('MMIMMIBundle:agenda:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a agenda entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MMIMMIBundle:agenda')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find agenda entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('agenda'));
    }

    /**
     * Creates a form to delete a agenda entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('agenda_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
