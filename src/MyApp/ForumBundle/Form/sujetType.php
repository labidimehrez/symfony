<?php

namespace MyApp\ForumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class sujetType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sujet')
            ->add('contenu','textarea')
           ## ->add('datecreation')
           ## ->add('datelus')
             ->add('notification', 'checkbox', array('required' => false, 'data' => true))
             ->add('user')
            ->add('tags')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyApp\ForumBundle\Entity\sujet'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'myapp_forumbundle_sujet';
    }
}
