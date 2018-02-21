<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\ForumType;
use App\Entity\Forum;

/**
 * @Route("/forums", name="forum")
 * 
 * @author Lucas Santos <devlostpublisher@gmail.com>
 * 
 * @todo Decide if the forum should have a forum_root or create a new entity to manage the settings
 * 
 */
class ForumController extends Controller
{
    /**
     * @Route("/")
     * @Route("/forum", name="_list")
     * @Method("GET")
     */
    public function list()
    {
        $repo = $this->getDoctrine()->getRepository(Forum::class);

        $forums = $repo->findAll();

        return $this->render('forum/index.html.twig', ["forums" => $forums]);
    }

    /**
     * @Route("/forum/{slug}", name="_show", requirements={"page"="\+d"})
     */
     public function show(Forum $forum)
     {
         /**
          * @todo Use paginator [? /PAGER FANTA ??]
          */

         $threads = $forum->getThreads();
         return $this->render('forum/forum.html.twig', ["slug" => $forum->getSlug(), "threads" => $threads]);
     }

     /**
      * @Route("/forum/{slug}/settings", name="_settings")
      */
      public function settings(Forum $forum){
          return new Response();
      }

    /**
     * @Route("/create/forum", name="_create")
     */
    public function create(Request $request){
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'You are not allowed to create forums');

        $forum = new Forum();

        $form = $this->createForm(ForumType::class, $forum);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $forum->setCreatedAt(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($forum);
            $em->flush();

            return $this->redirectToRoute('admin_dashboard', ['slug' => 'test']);
        }
        
        return $this->render('admin/forum_create.html.twig', ['form' => $form->createView()]);
    }
}
