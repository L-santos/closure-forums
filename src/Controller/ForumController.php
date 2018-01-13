<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Thread;
use App\Entity\Status;
use App\Entity\Forum;
use App\Entity\Post;
use App\Entity\User;

/**
 * @Route("/forum")
 * 
 * @author Lucas Santos <devlostpublisher@gmail.com>
 */
class ForumController extends Controller
{
    /**
     * @Route("/forums", name="list")
     * @Route("/", name="index")
     * @Method("GET")
     */
    public function index() : Response
    {
        //Show the categories
        $repo = $this->getDoctrine()->getRepository(Forum::class);

        /**
         * @TODO Manage the depth of the search looking only for forums without parent??
         * USE a paginator see [PAGER FANTA];;
         */
        //$root = $repo->find(0);
        $forums = $repo->findAll();
        return $this->render('forum/index.html.twig', ["forums" => $forums]);
    }

    /**
     * @Route("/forums/{slug}", name="forum", requirements={"page"="\+d"})
     */
     public function forumShow(Forum $forum): Response
     {
         $threads = $forum->getThreads();
         return $this->render('forum/forum_show.html.twig', ["forum" => $forum, "threads" => $threads]);
     }

     /**
      * @Route("/forums/{slug}/create-thread", name="thread_create")
      */
     public function createThread(Forum $forum){

        //TODO: Create and render form, validate and submit

        return $this->render('forum/_thread_form.html.twig');
     }

     /**
      * @Route("/forums/{slug}/thread={id}", name="thread")
      */
     public function threadShow(Thread $thread): Response
     {
        return $this->render("forum/thread_show.html.twig", ["thread" => $thread]);
     }

     /**
      * TODO
      * Reply thread
      * Quote Reply
      */
}
