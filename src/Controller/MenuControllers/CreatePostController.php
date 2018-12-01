<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 01.12.2018
 * Time: 16:50
 */

declare(strict_types=1);
namespace App\Controller\MenuControllers;


use App\Entity\Post;
use App\Entity\User;
use App\Form\CreateNewPostForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CreatePostController extends AbstractController
{
    /**
     * @param Request $request
     * @param TokenStorageInterface $tokenStorage
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createPost(Request $request, TokenStorageInterface $tokenStorage){
        $this->denyAccessUnlessGranted('ROLE_BLOGGER');
        $post = new Post();
        $form = $this->createForm(CreateNewPostForm::class, $post);
        $form->handleRequest($request);
        $postCreator=$tokenStorage->getToken()->getUsername();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $post->setPostCreator($postCreator);
            $entityManager->persist($post);
            $entityManager->flush();
            //TODO: Add route to redirect to;
            //$this->redirectToRoute('route');
        }

            return $this->render(
            'menu/createNewPost.html.twig',
            array('form'=>$form->createView())
        );
    }

}