<?php

namespace App\Application\Handler\User;

use App\Application\Handler\CommonHandler;
use App\Domain\User\User;
use App\Infrastructure\Persistence\Doctrine\DoctrineUserRepository;

class CreateUserHandler extends CommonHandler
{
    /**
     * @var DoctrineUserRepository
     */
    private $userRepository;

    public function __construct(DoctrineUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(string $name, int $age)
    {
        $user = new User($name, $age);

        $this->userRepository->add($user);
    }
}
