<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 02.12.2018
 * Time: 16:10
 */

declare(strict_types=1);

namespace App\Controller\MenuControllers;


use App\Entity\Post;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ViewSpecificUserPageController extends AbstractController
{

    /**
     * @param $id
     * @return string
     */
    public function prepareToViewSpecificUsersHomePage($id){
        $posts = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findBy(['postCreator'=>$id]);
        return $this->render('menu/MyProfile/specificUserHomePage.html.twig',
            [
                'posts'=>$posts,
            ]
        );
    }


    public function myPosts(TokenStorageInterface $token){
        $posts = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findBy(['postCreator'=>$token->getToken()->getUser()]);

        return $this->render('menu/MyProfile/specificUserHomePage.html.twig',
            [
                'posts'=>$posts,
            ]
        );
    }

    public function myProfile(TokenStorageInterface $token){
        return $this->render('menu/MyProfile/homePage.html.twig',
            [
            'user'=>$token->getToken()->getUser()
        ]);
    }


}