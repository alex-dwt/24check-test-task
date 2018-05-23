<?php

namespace App\Application\Handler\User;

use App\Application\Handler\CommonHandler;
use App\Domain\User\Criteria\UsersListCriteria;
use App\Infrastructure\Persistence\Doctrine\DoctrineUserRepository;

class GetUsersListHandler extends CommonHandler
{
    /**
     * @var DoctrineUserRepository
     */
    private $userRepository;

    public function __construct(DoctrineUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(string $orderBy)
    {
        return $this->returnValue(
            $this->userRepository->getCollectionByCriteria(
                new UsersListCriteria($orderBy)
            )
        );
    }
}
