<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 03.12.2018
 * Time: 17:35
 */

namespace App\Form\MyProfile;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class ButtonForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Blogger', SubmitType::class);
    }

}