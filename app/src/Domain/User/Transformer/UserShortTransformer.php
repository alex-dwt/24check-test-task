<?php

namespace App\Domain\User\Transformer;

use App\Domain\Common\DomainTransformer;
use App\Domain\User\User;

class UserShortTransformer extends DomainTransformer
{
    /**
     * @param User $entity
     * @return array
     */
    protected function transformOneEntity($entity): array
    {
        return [
            'id' => $entity->getId(),
            'age' => $entity->getAge(),
            'name' => $entity->getName(),
        ];
    }
}
