<?php

namespace MyApp\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('username', 'text')
                ->add('enabled', 'checkbox', array('required' => false))
                ->add('roles', 'collection', array(
                    'type' => 'choice',
                    'options' => array(
                        'label' => false, /* Ajoutez cette ligne */
                        'choices' => array(
                           'ROLE_SUPER_ADMIN' => 'Superadmin',
                            'ROLE_ADMIN' => 'Admin',
                            'ROLE_SUPERSOL' => 'Supersol',
                            'ROLE_EDITOR' => 'Editor',
                            'ROLE_USER' => 'User',
                ))))
     
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyApp\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'myapp_userbundle_user';
    }
}
