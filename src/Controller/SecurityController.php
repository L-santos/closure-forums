<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/forums")
 * 
 * @author Lucas Santos <devlostpublisher@gmail.com>
 */
class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $auth){

        /**
         * https://symfony.com/doc/current/security/form_login_setup.html
         */
        
        $error = $auth->getLastAuthenticationError();

        $lastUsername = $auth->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username'=> $lastUsername,
        'error' => $error]);
    }
}
