<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Lucas Santos <email@here>
 */
class ForumController extends Controller
{
    /**
     * @Route("/forum", name="forum")
     */
    public function index()
    {
        return $this->render('forum/index.html.twig');
    }
}
