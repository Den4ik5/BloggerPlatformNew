<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 29.11.2018
 * Time: 22:47
 */
declare(strict_types=1);
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * Require ROLE_MODERATOR for *every* controller method in this class.
 *
 * @IsGranted("ROLE_MODERATOR")
 */
class ModeratorController extends AbstractController
{
    /**
     * Require ROLE_MODERATOR for only this controller method.
     *
     * @IsGranted("ROLE_MODERATOR")
     */
    public function moderatorDashboard(){
        $this->denyAccessUnlessGranted('ROLE_MODERATOR', null, 'User tried to access a page without having ROLE_MODERATOR');
    }

}