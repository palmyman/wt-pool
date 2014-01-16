<?php

namespace WT\PoolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;

class QuestionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $request = Request::createFromGlobals();
        $builder
            ->add('text')            
            ->add('type', 'choice', array(
                'choices'   => array('0' => 'Check', '1' => 'Text', '2' => 'Options'),
                'expanded'  => true,))
            ->add('pool', 'entity', array(
                'class' => 'WTPoolBundle:Pool',
                'property' => 'title',
                'read_only' => true,
                'label' => ' ',            
            ))            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WT\PoolBundle\Entity\Question'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wt_poolbundle_question';
    }
}
