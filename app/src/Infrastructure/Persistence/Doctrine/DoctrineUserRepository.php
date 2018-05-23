<?php

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\User\User;

class DoctrineUserRepository extends AbstractDoctrineRepository
{
    protected function repositoryClassName(): string
    {
        return User::class;
    }
}
