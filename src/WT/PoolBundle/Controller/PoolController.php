<?php

namespace WT\PoolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use WT\PoolBundle\Entity\Pool;
use WT\PoolBundle\Entity\Answer;
use WT\PoolBundle\Form\PoolType;

/**
 * Pool controller.
 *
 * @Route("/pool")
 */
class PoolController extends Controller
{

    /**
     * Lists all Pool entities.
     *
     * @Route("/", name="pool")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('WTPoolBundle:Pool')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Pool entity.
     *
     * @Route("/", name="pool_create")
     * @Method("POST")
     * @Template("WTPoolBundle:Pool:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Pool();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pool_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Pool entity.
    *
    * @param Pool $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Pool $entity)
    {
        $form = $this->createForm(new PoolType(), $entity, array(
            'action' => $this->generateUrl('pool_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Pool entity.
     *
     * @Route("/new", name="pool_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Pool();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Pool entity.
     *
     * @Route("/{id}", name="pool_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WTPoolBundle:Pool')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pool entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Pool entity.
     *
     * @Route("/{id}/edit", name="pool_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WTPoolBundle:Pool')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pool entity.');
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
    * Creates a form to edit a Pool entity.
    *
    * @param Pool $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pool $entity)
    {
        $form = $this->createForm(new PoolType(), $entity, array(
            'action' => $this->generateUrl('pool_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Pool entity.
     *
     * @Route("/{id}", name="pool_update")
     * @Method("PUT")
     * @Template("WTPoolBundle:Pool:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WTPoolBundle:Pool')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pool entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pool_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Pool entity.
     *
     * @Route("/{id}", name="pool_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('WTPoolBundle:Pool')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pool entity.');
            }
            $questions = $entity->getQuestions();
            foreach ($questions as $question) {
                $qOptions = $question->getQOptions();
                foreach ($qOptions as $qOption) {
                    $em->remove($qOption);
                }
                $answers = $question->getAnswers();
                foreach ($answers as $answer) {
                    $em->remove($answer);
                }
                $em->remove($question);
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pool'));
    }    

    /**
     * Creates a form to delete a Pool entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pool_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    /**
     * Create form, fill the pool and persist answers TODO
     *
     * @Route("/{id}/fill", name="pool_fill")
     * @Template()     
     */
    public function fillPoolAction(Request $request, $id) {
        $form = $this->createFillForm($id);
        $form->handleRequest($request);       

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('WTPoolBundle:Pool')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pool entity.');
            }
            $em = $this->get('doctrine')->getManager();
            //$em->persist($question); persist data
            $em->flush();
        }

        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to fill a Pool entity by id. TODO
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createFillForm($id)
    {
        $em = $this->getDoctrine()->getManager();
        $pool = $em->getRepository('WTPoolBundle:Pool')->find($id);
        $questions = $pool->getQuestions();

        $formBuilderQuestionnaire = $this->createFormBuilder();
        $i = 0;

        foreach ($questions as $question) {
            $formBuilder = $this->get('form.factory')->createNamedBuilder($i, 'form');
            $formBuilder->add('text' , 'textarea',  array(
                'required' => false,
                'label' => $question->getText() 
            ));

            $formBuilderQuestionnaire->add($formBuilder);

            $i++;
            // if($question->getType() == 0) $form->add('boolean', 'checkbox', array('required' => false, 'label' => $question->getText()));
            // elseif($question->getType() == 1) $form->add('textAnswer', array('label' => $question->getText()));
            // else $form->add('selectBox', array('label' => $question->getText()));
        }
        $formBuilderQuestionnaire->add('submit', 'submit', array('label' => 'Save'));
        $form = $formBuilderQuestionnaire->getForm();
        return $form;
    }
}
