<?php
namespace MyApp\ForumBundle\Validator\Constraints;
use Symfony\Component\Validator\Constraint;
 /**
  * @Annotation
  */
class ConstraintsCheck extends Constraint {
        
    public  $message = 'Le champs contient des liens non valides';
    
//    public function validatedBy() {
//        return get_class($this).'Validator';
//    }
    
    
}
?>