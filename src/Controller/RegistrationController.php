<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 28.11.2018
 * Time: 19:27
 */
declare(strict_types=1);
namespace App\Controller;
use App\Form\UserType;
use App\Entity\User;
use App\Form\WrongEmailForm;
use App\Service\RegistrationEmailSender;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param RegistrationEmailSender $emailSender
     * @param ModeratorController $moderatorController
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, RegistrationEmailSender $emailSender, ModeratorController $moderatorController)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $repository = $this->getDoctrine()->getRepository(User::class);
            $emailExist = $repository->findOneBy([
                'email' => $user->getEmail(),
            ]);
            if($emailExist){
                $message=' is busy! Please choose another one or log in.';
                return $this->wrongEmail($message,$user->getEmail());
            }
            else {
                $password = $passwordEncoder->encodePassword($user, $user->getPassword());
                $user->setPassword($password);
                if ($user->getBlogger()) {
                    $user->setRoles(['ROLE_USER']);
                    $moderatorController->sendNotice($user->getUsername());
                } else {
                    $user->setRoles(['ROLE_USER']);
                }
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                $checker = $emailSender->send($user->getFirstName(), $user->getLastName(), $user->getEmail());
                if ($checker!=0) {
                    echo "OLL KLEAR";
                    return $this->redirectToRoute('login');
                }

            }
        }
        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }
    public function wrongEmail(string $message, string $email){
        return $this->render('ExceptionTemplates/wrongEmail.html.twig',
            [
                'message'=>$message,
                'email'=>$email
            ]);
    }

}