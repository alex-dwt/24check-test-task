<?php

namespace App\Domain\User;

use App\Domain\Common\InitEntityTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class User
{
    use InitEntityTrait;

    /**
     * @var int
     * @ORM\Column(type="string", nullable=false)
     */
    private $name;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=false)
     */
    private $age;

    public function __construct(
        string $name,
        int $age
    ){
        $this->init();

        $this->update(
            $name,
            $age
        );
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function update(
        string $name,
        int $age
    ): self
    {
        $this->name = $name;
        $this->age = $age;

        return $this;
    }
}
