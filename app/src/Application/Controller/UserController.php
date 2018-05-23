<?php

namespace App\Application\Controller;

use App\Application\Form\User\UserForm;
use App\Application\Handler\User\CreateUserHandler;
use App\Application\Handler\User\EditUserHandler;
use App\Application\Handler\User\GetUserHandler;
use App\Application\Handler\User\GetUsersListHandler;
use App\Domain\User\Criteria\UsersListCriteria;
use App\Domain\User\Transformer\UserFullTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/users")
 */
class UserController extends AbstractController
{
    /**
     * @Route(path="/new", name="addUser")
     */
    public function addAction(CreateUserHandler $handler, Request $request)
    {
        $form = $this
            ->createForm(UserForm::class)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $handler(
                $form->getData()['name'],
                $form->getData()['age']
            );

            return $this->redirectToRoute('getUsersList');
        }

        return $this->render(
            'users/add.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }


    /**
     * @Route(path="/edit/{id}", name="editUser", requirements={"id": "[\-a-z\d]+"})
     */
    public function editAction(
        string $id,
        EditUserHandler $editUserHandler,
        GetUserHandler $getUserHandler,
        Request $request
    ) {
        $form = $this
            ->createForm(
                UserForm::class,
                $getUserHandler->setTransformer(new UserFullTransformer())($id)
            )
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $editUserHandler(
                $id,
                $form->getData()['name'],
                $form->getData()['age']
            );

            return $this->redirectToRoute('getUsersList');
        }

        return $this->render(
            'users/add.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route(path="/{id}", name="getUser", requirements={"id": "[\-a-z\d]+"})
     * @Method("GET")
     */
    public function viewAction(string $id, GetUserHandler $handler)
    {
        return $this->render(
            'users/view.html.twig',
            [
                'user' => $handler->setTransformer(new UserFullTransformer())($id)
            ]
        );
    }

    /**
     * @Route(path="/", name="getUsersList")
     * @Method("GET")
     */
    public function listAction(GetUsersListHandler $handler, Request $request)
    {
        if (!in_array(
            $order = $request->query->get('order', UsersListCriteria::ORDER_NAME_ASC),
            UsersListCriteria::ORDERS_LIST
        )) {
            throw new BadRequestHttpException('Wrong order');
        }

        return $this->render(
            'users/list.html.twig',
            [
                'users' => $handler
                    ->setTransformer(new UserFullTransformer())(
                        $order
                    ),
            ]
        );
    }


}