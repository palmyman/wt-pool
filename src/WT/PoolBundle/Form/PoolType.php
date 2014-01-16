<?php

namespace WT\PoolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PoolType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
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
            'data_class' => 'WT\PoolBundle\Entity\Pool'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wt_poolbundle_pool';
    }
}
