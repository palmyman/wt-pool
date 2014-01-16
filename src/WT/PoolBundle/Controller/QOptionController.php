<?php

namespace WT\PoolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use WT\PoolBundle\Entity\QOption;
use WT\PoolBundle\Form\QOptionType;

/**
 * QOption controller.
 *
 * @Route("/qoption")
 */
class QOptionController extends Controller
{

    /**
     * Lists all QOption entities.
     *
     * @Route("/", name="qoption")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('WTPoolBundle:QOption')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new QOption entity.
     *
     * @Route("/", name="qoption_create")
     * @Method("POST")
     * @Template("WTPoolBundle:QOption:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new QOption();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('qoption_new', array('questionId' => $entity->getQuestion()->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a QOption entity.
    *
    * @param QOption $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(QOption $entity)
    {
        $form = $this->createForm(new QOptionType(), $entity, array(
            'action' => $this->generateUrl('qoption_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Add'));

        return $form;
    }

    /**
     * Displays a form to create a new QOption entity.
     *
     * @Route("/{questionId}/new", name="qoption_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($questionId)
    {
        $em = $this->getDoctrine()->getManager();
        $question = $this->get('doctrine')->getRepository('WTPoolBundle:Question')->find($questionId);
        $entity = new QOption();
        $entity->setQuestion($question);
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a QOption entity.
     *
     * @Route("/{id}", name="qoption_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WTPoolBundle:QOption')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find QOption entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing QOption entity.
     *
     * @Route("/{id}/edit", name="qoption_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WTPoolBundle:QOption')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find QOption entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a QOption entity.
    *
    * @param QOption $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(QOption $entity)
    {
        $form = $this->createForm(new QOptionType(), $entity, array(
            'action' => $this->generateUrl('qoption_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing QOption entity.
     *
     * @Route("/{id}", name="qoption_update")
     * @Method("PUT")
     * @Template("WTPoolBundle:QOption:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WTPoolBundle:QOption')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find QOption entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('qoption_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a QOption entity.
     *
     * @Route("/{id}", name="qoption_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('WTPoolBundle:QOption')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find QOption entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('qoption'));
    }

    /**
     * Creates a form to delete a QOption entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('qoption_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
