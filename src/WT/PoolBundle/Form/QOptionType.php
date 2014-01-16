<?php

namespace WT\PoolBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QOptionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('text')
            ->add('question', 'entity', array(
                'class' => 'WTPoolBundle:Question',
                'property' => 'text',
                'read_only' => true, 
                'label' => ' ',               
        ));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WT\PoolBundle\Entity\QOption'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wt_poolbundle_qoption';
    }
}
