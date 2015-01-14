<?php

namespace MyApp\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MyAppUserBundle extends Bundle
{
    public function getParent( )
    {
        return'FOSUserBundle';
    }
}

