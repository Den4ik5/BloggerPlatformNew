<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 01.12.2018
 * Time: 21:52
 */

namespace App\Controller\MenuControllers;


use App\Entity\Post;
use App\Entity\User;
use App\Form\MyPostsForm;
use App\Form\MyProfile\EditInformationForm;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class MyProfileController extends AbstractController
{
    public function viewMyPosts(Request $request, TokenStorageInterface $tokenStorage){
        $repository = $this->getDoctrine()->getRepository(Post::class);
        $postCreator=$tokenStorage->getToken()->getUsername();
        $myPosts=$repository->findOneBy(['postCreator' => $postCreator]);

    }
    public function editProfile(Request $request, TokenStorageInterface $tokenStorage,UserPasswordEncoderInterface $passwordEncoder){

        $form=$this->createForm(EditInformationForm::class);
        $form->handleRequest($request);
        $user=$tokenStorage->getToken()->getUsername();
        var_dump($user);

        if($form->isSubmitted()&&$form->isValid()){

        }

        return $this->render('menu/MyProfile/editInformation.html.twig',
            array('form'=>$form->createView())
        );
    }

}