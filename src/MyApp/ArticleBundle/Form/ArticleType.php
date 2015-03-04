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
                    'class' => 'MyApp\ArticleBundle\Entity\Style',
                    'property' => 'title',
                    'expanded' => false,
                    'multiple' => false,
                    'required' => true))
 
                ->add('lien')
                ->add('position', 'choice', array(
                    'choices' => array(
                        '1' => '1', '2' => '2','3' => '3', '4' => '4',
                        '5' => '5', '6' => '6','7' => '7', '8' => '8',
                        '9' => '9', '10' => '10','11' => '11', '12' => '12',
                        '13' => '13', '14' => '14','15' => '15'
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
