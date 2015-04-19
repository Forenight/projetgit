<?php

namespace MMI\MMIBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MMI\MMIBundle\Entity\videos;
use MMI\MMIBundle\Form\videosType;

/**
 * videos controller.
 *
 */
class videosController extends Controller
{

    /**
     * Lists all videos entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MMIMMIBundle:videos')->findAll();

        return $this->render('MMIMMIBundle:videos:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new videos entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new videos();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('videos_show', array('id' => $entity->getId())));
        }

        return $this->render('MMIMMIBundle:videos:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a videos entity.
     *
     * @param videos $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(videos $entity)
    {
        $form = $this->createForm(new videosType(), $entity, array(
            'action' => $this->generateUrl('videos_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new videos entity.
     *
     */
    public function newAction()
    {
        $entity = new videos();
        $form   = $this->createCreateForm($entity);

        return $this->render('MMIMMIBundle:videos:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a videos entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MMIMMIBundle:videos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find videos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MMIMMIBundle:videos:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing videos entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MMIMMIBundle:videos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find videos entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MMIMMIBundle:videos:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a videos entity.
    *
    * @param videos $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(videos $entity)
    {
        $form = $this->createForm(new videosType(), $entity, array(
            'action' => $this->generateUrl('videos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing videos entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MMIMMIBundle:videos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find videos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('videos_edit', array('id' => $id)));
        }

        return $this->render('MMIMMIBundle:videos:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a videos entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MMIMMIBundle:videos')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find videos entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('videos'));
    }

    /**
     * Creates a form to delete a videos entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('videos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
