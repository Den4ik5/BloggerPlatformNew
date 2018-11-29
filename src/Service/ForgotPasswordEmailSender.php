<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 29.11.2018
 * Time: 16:28
 */

declare(strict_types=1);

namespace App\Service;


use Swift_Mailer;
use Twig\Environment;

class ForgotPasswordEmailSender
{
    private $mailer;

    private $twig;

    public function __construct(Swift_Mailer $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function send(string $name,string $lastName,string $email, string $newPassword)
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('bloggerplatform2019@gmail.com')
            ->setTo([$email => 'A name'])
            ->setBody(' Hi'.$name.' '.  $lastName.'! Your login is '.  $email.'. Your new password is '.$newPassword);

        /*   dump($this->mailer->send($message));
           die;*/
        return $this->mailer->send($message) > 0;
    }

}