<?php

namespace App\Application\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Application\Handler\User\CreateUserHandler;
use App\Application\Handler\User\EditUserHandler;
use App\Application\Handler\User\GetUserHandler;
use App\Application\Handler\User\GetUsersListHandler;
use App\Domain\User\Transformer\UserFullTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Validator\Constraints as Assert;


class UserForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                ['constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Type(['type' => 'string'])
                ]]
            )
            ->add(
                'age',
                TextType::class,
                ['constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Type(['type' => 'numeric'])
                ]]
            )
            ->add('send', SubmitType::class)
        ;
    }
}
