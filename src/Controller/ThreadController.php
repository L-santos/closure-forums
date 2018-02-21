<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Thread;
use App\Entity\Status;
use App\Entity\Forum;
use App\Entity\Post;
use App\Entity\User;
use App\Form\ThreadType;
use App\Form\PostType;

/**
 * @Route("/forums", name="thread")
 * 
 * @author Lucas Santos <devlostpublisher@gmail.com>
 * 
 */ 
class ThreadController extends Controller
{
    /**
     * @Route("/forum/{slug}/thread={id}", name="_show")
     */
    public function show(Request $request, Thread $thread, $post_id = null)
    {
    
        $post = new Post();
        $post->setContent("");

        unset($post_id);

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {            
            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
            $em = $this->getDoctrine()->getManager();

            $post->setUser($this->getUser());
            $post->setThread($thread);
            $post->setCreatedAt(new \DateTime());

            //Updates thread
            $thread->setLastPost($post);

            //Updates the forum
            $forum = $thread->getForum();
            $forum->setLastThread($thread);            

            $em->persist($post);
            $em->persist($thread);
            $em->persist($forum);
            $em->flush();
            
            return $this->redirectToRoute(
                'thread_show', 
                ['slug' => $thread->getForum()->getId(), 'id' => $thread->getId()]);
        }
 
        return $this->render("forum/thread.html.twig", ["thread" => $thread, 'form' => $form->createView(), "forum" => $thread->getForum()]);
    }

     /**
      * @Route("/forum/{slug}/create-thread", name="_create")
      */
      public function create(Forum $forum, Request $request)
      {
         $this->denyAccessUnlessGranted('ROLE_USER', null, "You're not allowed to post");

         $thread = new Thread();

         $form = $this->createForm(ThreadType::class, $thread);

         $form->handleRequest($request);
         
         if($form->isSubmitted() && $form->isValid())
         {
             $thread->setUser($this->getUser());
             $thread->setForum($forum);
             $thread->setCreatedAt(new \DateTime());
 
             //Add thread content
             $post = new Post();
             $post->setContent($form->get('content')->getData());
             $post->setThread($thread);
             $post->setUser($thread->getUser());
             $post->setCreatedAt($thread->getCreatedAt());
 
             $thread->setLastPost($post);
 
             $em = $this->getDoctrine()->getManager();
             $em->persist($thread);
             $em->persist($post);
             $em->flush();
 
             $forum->setLastThread($thread);
             $em->persist($forum);
             $em->flush();
 
             return $this->redirectToRoute('thread_show', ['slug' => $forum->getSlug(), "id" => $thread->getId()]);
         }
 
         return $this->render('forum/thread_create.html.twig', ["form" => $form->createView(), "forum" => $forum]);
      }
}
