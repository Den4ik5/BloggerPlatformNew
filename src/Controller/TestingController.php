<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 28.11.2018
 * Time: 18:04
 */
declare(strict_types=1);
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestingController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function redirectToNotCreatedYetRoute(){
        return $this->render('base.html.twig');
    }


}