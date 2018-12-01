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
use Symfony\Component\HttpFoundation\Request;

class AllPosts extends AbstractController
{
    public function viewAllPosts(Request $request){
        $repository = $this->getDoctrine()->getRepository(Post::class);
        $emailExist = $repository->findAll();
        foreach ($emailExist as $item){
            echo "title: ". $item->getTitle()."<br>";
            echo "content: ".$item->getContent()."<br>";
            echo "author: ".$item->getPostCreator()."<br>";
        }
        return $this->render('menu/allPosts.html.twig');
    }
}