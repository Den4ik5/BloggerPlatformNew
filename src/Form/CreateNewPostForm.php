<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 01.12.2018
 * Time: 16:58
 */

declare(strict_types=1);

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateNewPostForm extends AbstractType
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
            ->add('post!', SubmitType::class);
    }

}