<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 03.12.2018
 * Time: 15:58
 */

namespace App\Controller\MenuControllers;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PopularController extends AbstractController
{
    /**
     *@Route("/popular", name="popular")
     */
    public function view(){
        return $this->render('menu/popular.html.twig');
    }

}