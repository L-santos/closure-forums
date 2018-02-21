<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Forum;
use App\Entity\Thread;
use App\Entity\Post;
use App\Entity\User;

/**
 * @Route("/forums/admin", name="admin")
 * 
 * @author Lucas Santos <devlostpublisher@gmail.com>
 */
class AdminController extends Controller
{

    /**
     * @Route("/")
     * @Route("/dashboard", name="_dashboard")
     */
    public function dashboard()
    {
        $forum_count = $this->getDoctrine()->getRepository(Forum::class)->forumCount();
        $data = [
            'forum_count' => $forum_count
        ];

        return $this->render('admin/dashboard.html.twig', ['data' => $data ]);
    }

}
