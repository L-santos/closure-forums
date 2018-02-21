<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;


/**
 * @Route("/forums/users", name="user")
 * 
 * @author Lucas Santos <devlostpublisher@gmail.com>
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="_list")
     */
    public function list(){
        return new Response("There's nothing here yet...");
    }

    /**
     * @Route("/user={id}", name="_show")
     */
    public function show(User $user, $user_id = null)
    {
        return new Response($user->getUsername());    
    }
}
