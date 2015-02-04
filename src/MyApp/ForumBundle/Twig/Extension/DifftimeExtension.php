<?php

namespace MyApp\ForumBundle\Twig\Extension;

class DifftimeExtension extends \Twig_Extension {

    public function getFilters() {
        return array(new \Twig_SimpleFilter('Difftime', array($this, 'Difftime')));
    }

    function difftime($datecreation) {

        $now = time();



        $diff = abs($now - $datecreation);
         $diff =  $diff %  60;
        $datecreation = $diff ;

        return $datecreation;
    }

    public function getName() {
        return 'difftime_extension';
    }

}
