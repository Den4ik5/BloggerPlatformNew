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
class AllPostsController extends AbstractController
{
    public function viewAllPosts(){
        $repository = $this->getDoctrine()->getRepository(Post::class);
        $posts = $repository->findAll();
        $postCreator=[];
        $content=[];
        $title=[];
        $linkToPicture=[];
        $tag=[];
        $teaser=[];
        foreach ($posts as $post){
            $postCreator= $post->getPostCreator();
            $content= $post->getContent();
            $title= $post->getTitle();
            $linkToPicture= $post->getLinkToPicture();
            $tag= $post->getTag();
            $teaser= $post->getTeaser();
        }
       return $this->render('menu/allPosts.html.twig',[
              /* 'postCreator'=>$postCreator,
               'title'=>$title,
               'teaser'=>$teaser,
               'content'=>$content,
               'linkToPicture'=>$linkToPicture,
               'tag'=>$tag*/
              'posts'=>$posts
           ]
        );
    }
}