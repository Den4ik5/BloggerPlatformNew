<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 01.12.2018
 * Time: 22:05
 */

namespace App\Form\MyProfile;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class MyPostsForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('teaser', TextType::class)
            ->add('content', TextType::class)
            ->add('linkToPicture', TextType::class)
            ->add('tag', TextType::class)
            ->add('create_new_post!', SubmitType::class);
    }
}