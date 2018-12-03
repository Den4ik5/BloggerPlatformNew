<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 01.12.2018
 * Time: 18:03
 */

namespace App\Controller\MenuControllers;



use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AllPostsController extends AbstractController
{
    /**
    * @Route("/view_all_posts/profile", name="all_posts", methods="GET")
    */
    public function viewAllPosts() : Response
    {
        $posts = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findAll();
        $reversed=array_reverse($posts);

       return $this->render('menu/allPosts.html.twig',[
              'posts'=>$reversed,
           ]
        );
    }
}