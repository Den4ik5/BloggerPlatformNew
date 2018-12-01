<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 29.11.2018
 * Time: 22:49
 */
declare(strict_types=1);
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * Require ROLE_BLOGGER for *every* controller method in this class.
 *
 * @IsGranted("ROLE_BLOGGER")
 */

class BloggerController extends AbstractController
{
    /**
     * Require ROLE_ADMIN for only this controller method.
     *
     * @IsGranted("ROLE_BLOGGER")
     */
    public function bloggerDashboard(){
        $this->denyAccessUnlessGranted('ROLE_BLOGGER', null, 'User tried to access a page without having ROLE_BLOGGER');
    }

}