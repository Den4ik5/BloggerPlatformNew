<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 03.12.2018
 * Time: 15:43
 */

declare(strict_types=1);

namespace App\Controller\MenuControllers;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class PreferencesController extends AbstractController
{
    /**
     *@Route("/preferences/profile", name="preferences")
     */
    public function view(){
        return $this->render('menu/MyProfile/preferences.html.twig');
    }

}