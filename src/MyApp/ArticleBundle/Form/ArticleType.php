<?php

namespace MyApp\ArticleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('headline')
                ->add('urlimg')
                ->add('copyrights')
                ->add('fixedposition', 'checkbox', array('required' => false, 'data' => true))
                
                ->add('style', 'entity', array(
                    'class' => 'MyApp\ArticleBundle\Entity\Article',
                    'property' => 'style',
                    'expanded' => false,
                    'multiple' => false,
                    'required' => false))
                
                ->add('position', 'entity', array(
                    'class' => 'MyApp\ArticleBundle\Entity\Article',
                    'property' => 'position',
                    'expanded' => false,
                    'multiple' => false,
                    'required' => false))
                
                ->add('lien')
                
                ->add('arstyle')
                ->add('tags')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'MyApp\ArticleBundle\Entity\Article'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'myapp_articlebundle_article';
    }

}
