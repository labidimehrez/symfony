<?php

namespace MyApp\ForumBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ConstraintsCheckValidator extends ConstraintValidator {

    public function validate($value, Constraint $constraint) {

       /* if (1 != 0)
            $this->context->addViolation($constraint->message);*/      
       
        if ((null === $value) )  {
           $this->context->addViolation($constraint->message);
        }
         if(is_numeric($value)) {
           $this->context->addViolation($constraint->message);
        }
        
    }

}

?>