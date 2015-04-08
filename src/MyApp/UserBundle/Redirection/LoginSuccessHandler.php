<?php   /*/#*

namespace MyApp\UserBundle\Redirection;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface {

    protected $router;
    protected $security;

    public function __construct(Router $router, SecurityContext $security) {
        $this->router = $router;
        $this->security = $security;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token) {
        
        if ($this->security->isGranted('ROLE_SUPER_ADMIN'))
        {
            $response = new  RedirectResponse($this->router->generate('my_app_esprit_administration'));
            
        }
        elseif ($this->security->isGranted('ROLE_USER'))
        {
           $response = new     RedirectResponse($this->router->generate('my_app_esprit_homepage'));
        }
        return $response;
    }

}
 