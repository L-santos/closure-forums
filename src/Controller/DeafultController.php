<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DeafultController extends Controller
{
    /**
     * @Route("/", name="deafult")
     */
    public function index()
    {
        return $this->render('welcome.html.twig');
    }
}
