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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


/**
 * Require ROLE_MODERATOR for *every* controller method in this class.
 */
/*
 * @IsGranted("ROLE_MODERATOR")
 */
class ModeratorController extends AbstractController
{
    /**
     * Require ROLE_MODERATOR for only this controller method.
     *
     * @IsGranted("ROLE_MODERATOR")
     */
    public function moderatorDashboard()
    {
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'User tried to access a page without having ROLE_MODERATOR');
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
    public function viewNotice(){
        $this->denyAccessUnlessGranted('ROLE_MODERATOR');
        $notices = $this->getDoctrine()
            ->getRepository(Notice::class)
            ->findAll();
        return $this->render('menu/moderatorPageViewNotice.html.twig',[
                'notices'=>$notices,
            ]
        );
    }

}