<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ForgotPasswordForm;
use App\Service\ForgotPasswordEmailSender;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @param ForgotPasswordEmailSender $emailSender
     * @param UserPasswordEncoderInterface $encoder
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @throws \Exception
     * @Route("/forgot_password", name="forgot_password")
     */
    public function forgotPassword(ForgotPasswordEmailSender $emailSender, UserPasswordEncoderInterface $encoder, Request $request)
    {

        $user = new User();
        $form = $this->createForm(ForgotPasswordForm::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted()) {

            $repository = $this->getDoctrine()->getRepository(User::class);
            $specificUser= $repository->findOneBy([
                'email' => $user->getEmail()
            ]);

            if ($specificUser) {
                echo 1;
                $password = random_bytes(20);
                $specificUser->setPassword($encoder->encodePassword($user, $password));

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();

                $checker = $emailSender->send($specificUser->getFirstName(), $specificUser->getLastName(), $specificUser->getEmail(), $password);

                if ($checker != 0) {
                    echo "Message with new password have been send to ". $specificUser->getEmail();
                    sleep(2);
                    return $this->redirectToRoute('login');
                }
            }
            else {
                echo 'Email is not exist!';
                sleep(2);
                return $this->redirectToRoute('registration');
            }
        }
        return $this->render(

            'security/forgotPassword.html.twig',
            array('form' => $form->createView())
        );
    }
}
