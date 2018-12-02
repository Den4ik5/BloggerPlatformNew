<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 02.12.2018
 * Time: 16:10
 */

namespace App\Controller\MenuControllers;


use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ViewSpecificUserPageController extends AbstractController
{
    public function viewSpecificUsersHomePage(){
        $posts = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findOneBy(['postCreator'=>$username]);

        return $this->renderView('menu/MyProfile/specificUserHomePage.html.twig',[
            'posts'=>$posts
        ]);
    }
}