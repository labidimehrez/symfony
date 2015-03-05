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
                ->add('copyrights', null, array('required' => false))
                
                ->add('fixedposition', 'checkbox', array('required' => false, 'data' => true))
                
                ->add('style', 'entity', array(
                    'class' => 'MyApp\ArticleBundle\Entity\Style',
                    'property' => 'title',
                    'expanded' => false,
                    'multiple' => false,
                    'required' => true))
 
                ->add('lien')
                ->add('position', 'choice', array(
                    'choices' => array(
                        '1' => 'Position 1', 
                        '2' => 'Position 2',
                        '3' => 'Position 3',
                        '4' => 'Position 4',
                        '5' => 'Position 5',
                        '6' => 'Position 6',
                        '7' => 'Position 7',
                        '8' => 'Position 8',
                        '9' => 'Position 9',
                        '10' => 'Position 10',
                        '11' => 'Position 11', 
                        '12' => 'Position 12',
                        '13' => 'Position 13',
                        '14' => 'Position 14',
                        '15' => 'Position 15'
                        ),
                    'expanded' => false,
                    'multiple' => false
                ))
                ## ->add('arstyle')
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
