<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 28.11.2018
 * Time: 18:04
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestingController extends AbstractController
{
    /*
     * @
     */
    public function redirectToNotCreatedYetRoute(){
        return $this->render('test/test.html.twig');
    }
}