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
        ->add('user','entity',array(
            'class'=>'MyAppUserBundleBundle:User',      
            'expanded'=> true,
            'multiple'=> true,
            'property'=>'name',/*
            'query_builder' => function(EntityRepository $er) use($options) {
                return $er->createQueryBuilder('ac')
                ->leftJoin('ac.company','c')
                ->where('c = :id')
                ->orderBy('ac.name', 'ASC')
                ->setParameter('id', $options['company_id']);}*/
            ))
     
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
