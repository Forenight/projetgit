<?php

namespace MMI\MMIBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MMI\MMIBundle\Entity\portfolio;
use MMI\MMIBundle\Form\portfolioType;

/**
 * portfolio controller.
 *
 */
class portfolioController extends Controller
{

    /**
     * Lists all portfolio entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MMIMMIBundle:portfolio')->findAll();

        return $this->render('MMIMMIBundle:portfolio:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new portfolio entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new portfolio();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('portfolio_show', array('id' => $entity->getId())));
        }

        return $this->render('MMIMMIBundle:portfolio:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a portfolio entity.
     *
     * @param portfolio $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(portfolio $entity)
    {
        $form = $this->createForm(new portfolioType(), $entity, array(
            'action' => $this->generateUrl('portfolio_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new portfolio entity.
     *
     */
    public function newAction()
    {
        $entity = new portfolio();
        $form   = $this->createCreateForm($entity);

        return $this->render('MMIMMIBundle:portfolio:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a portfolio entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MMIMMIBundle:portfolio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find portfolio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MMIMMIBundle:portfolio:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing portfolio entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MMIMMIBundle:portfolio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find portfolio entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MMIMMIBundle:portfolio:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a portfolio entity.
    *
    * @param portfolio $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(portfolio $entity)
    {
        $form = $this->createForm(new portfolioType(), $entity, array(
            'action' => $this->generateUrl('portfolio_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing portfolio entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MMIMMIBundle:portfolio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find portfolio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('portfolio_edit', array('id' => $id)));
        }

        return $this->render('MMIMMIBundle:portfolio:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a portfolio entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MMIMMIBundle:portfolio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find portfolio entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('portfolio'));
    }

    /**
     * Creates a form to delete a portfolio entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('portfolio_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
