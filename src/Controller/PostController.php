<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Post;

/** 
 * @Route("/forums/post", name="post")
 * 
 * @author Lucas Santos <devlostpublisher@gmail.com>
 * 
 **/
class PostController extends Controller
{
    /**
     * @Route("/{id}/delete", name="_delete")
     */
    public function delete(Request $request, Post $post)
    {
        if($request->getMethod() == 'POST'){

            $repo = $this->getDoctrine()->getRepository(Post::class);
            $forum = $post->getThread()->getForum();
            $thread = $post->getThread();

            $em = $this->getDoctrine()->getManager();
            $em->remove($post);
            $em->flush();

            //Update Thread & Forum
            $thread->setLastPost($repo->findLastByThread($thread));
            $em->persist($thread);

            $last_post = $repo->findLastByForum($thread->getForum());
            $forum->setLastThread($last_post->getThread());

            $em->persist($forum);
            $em->flush();

            return $this->redirectToRoute('thread_show', ['slug' => $forum->getSlug(), 'id' => $thread->getId()]);
        }

        return $this->render('forum/post_delete.html.twig', ["post" => $post]);
    }
}
