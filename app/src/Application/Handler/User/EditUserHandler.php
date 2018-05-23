<?php

namespace App\Application\Handler\User;

use App\Application\Handler\CommonHandler;
use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\User;
use App\Infrastructure\Persistence\Doctrine\DoctrineUserRepository;

class EditUserHandler extends CommonHandler
{
    /**
     * @var DoctrineUserRepository
     */
    private $userRepository;

    public function __construct(DoctrineUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(string $id, string $name, int $age)
    {
        /** @var User $user */
        if (!$user = $this->userRepository->get($id)) {
            throw new UserNotFoundException();
        }

        $user->update($name, $age);
    }
}
