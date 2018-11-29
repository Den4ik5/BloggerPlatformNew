<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 29.11.2018
 * Time: 16:50
 */
declare(strict_types=1);
namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ForgotPasswordForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class)
            ->add('confirm!', SubmitType::class);

    }
}