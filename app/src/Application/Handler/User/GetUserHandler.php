<?php

namespace App\Application\Handler\User;

use App\Application\Handler\CommonHandler;
use App\Domain\User\Exception\UserNotFoundException;
use App\Infrastructure\Persistence\Doctrine\DoctrineUserRepository;

class GetUserHandler extends CommonHandler
{
    /**
     * @var DoctrineUserRepository
     */
    private $userRepository;

    public function __construct(DoctrineUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(string $id)
    {
        if (!$user = $this->userRepository->get($id)) {
            throw new UserNotFoundException();
        }

        return $this->returnValue($user);
    }
}
