<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 29.11.2018
 * Time: 22:47
 */
declare(strict_types=1);
namespace App\Controller;

use App\Entity\Notice;
use App\Entity\User;
use App\Form\MyProfile\ButtonForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;



/**
 * Require ROLE_MODERATOR for *every* controller method in this class.
 */

class ModeratorController extends AbstractController
{
    /**
     * Require ROLE_MODERATOR for only this controller method.
     * @Route("/moderator_page/moderator", name="moderator_page", methods="GET")
     *
     * @IsGranted("ROLE_MODERATOR")
     */

    public function moderatorDashboard()
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'User tried to access a page without having ROLE_MODERATOR');
        return $this->render('menu/MyProfile/moderatorPage.html.twig');
    }

    /**
     * @param string $username
     */
    public function sendNotice(string $username):void
    {
        $notice = new Notice();
        $entityManager = $this->getDoctrine()->getManager();
        $notice->setUser($username);
        $notice->setBody('I want to be a blogger!');
        $entityManager->persist($notice);
        $entityManager->flush();
    }
    public function viewNotice(Request $request){
        $this->denyAccessUnlessGranted('ROLE_MODERATOR');
        $notices = $this->getDoctrine()
            ->getRepository(Notice::class)
            ->findAll();
        $form= $this->createForm(ButtonForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()){
            echo 3;
            $users=$this->getDoctrine()
                ->getRepository(User::class);
            $entityManager= $this->getDoctrine()->getManager();

            foreach ($notices as $notice){
                $username=$notice->getUser();
                $user=$users->findOneBy(['email'=>$username]);
                $user->setRoles(['ROLE_BLOGGER']);
                $entityManager->remove($notice);
                $entityManager->flush();
                $entityManager->persist($user);
                $entityManager->flush();
            }
            return $this->redirectToRoute('test');
        }
        return $this->render('menu/moderatorPageViewNotice.html.twig',[
                'notices'=>$notices,
                'form'=>$form->createView()
            ]
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/users_greed/moderator", name="users_greed", methods="GET")
     */
    public function viewGreedUsers(Request $request){
        $this->denyAccessUnlessGranted('ROLE_MODERATOR');
        $users =$this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        return $this->render('menu/usersGreed.html.twig',
            [
                'users'=>$users
            ]);
    }


}