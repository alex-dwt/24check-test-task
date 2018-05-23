<?php

namespace App\Domain\User\Exception;

use Throwable;

class UserNotFoundException extends \DomainException
{
    public function __construct(
        string $message = "User is not found",
        int $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
