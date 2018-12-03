<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 28.11.2018
 * Time: 21:32
 */

declare(strict_types=1);

namespace App\Service;
use Swift_Mailer;
use Twig\Environment;
class RegistrationEmailSender
{
    private $mailer;

    private $twig;

    public function __construct(Swift_Mailer $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function send(string $name,string $lastName,string $email)
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('bloggerplatform2019@gmail.com')
            ->setTo([$email => 'A name'])
            ->setBody(' Hi'.$name.' '.  $lastName.'! You\'re successfully registered.');
        return $this->mailer->send($message) > 0;
    }
}