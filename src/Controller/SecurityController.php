<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 28.11.2018
 * Time: 12:33
 */
declare(strict_types=1);
namespace App\Controller;


use App\Entity\User;
use App\Form\ForgotPasswordForm;
use App\Form\LoginForm;
use App\Form\UserType;
use App\Service\ForgotPasswordEmailSender;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Validator\Constraints\Email;

class SecurityController extends AbstractController
{
    /**
     * @param AuthenticationUtils $authenticationUtils
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils, Request $request){
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername=$authenticationUtils->getLastUsername();
        $form = $this->createForm(LoginForm::class, [
            'username' => $lastUsername,
        ]);
        $form->handleRequest($request);
        return $this->render('security/login.html.twig', array(
            'form' => $form->createView(),
            'errors' => $error,
        ));
    }

    /**
     * @param ForgotPasswordEmailSender $emailSender
     * @param UserPasswordEncoderInterface $encoder
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
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