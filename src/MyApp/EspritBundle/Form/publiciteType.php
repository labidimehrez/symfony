<?php

namespace MyApp\EspritBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class publiciteType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('position')
                ->add('image', 'ckeditor', array(
                    'plugins' => array(
                        'wordcount' => array(
                            'path' => '/bundles/myappespritbundle/ckeditor/',
                            'filename' => 'plugin.js',
                        ),
            )))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'MyApp\EspritBundle\Entity\publicite'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'myapp_espritbundle_publicite';
    }

}
