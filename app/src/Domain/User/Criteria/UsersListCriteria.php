<?php

namespace App\Domain\User\Criteria;

use App\Domain\Common\DomainCriteria;
use Doctrine\Common\Collections\Criteria;

class UsersListCriteria implements DomainCriteria
{
    const ORDERS_LIST = [
        self::ORDER_NUM_DESC,
        self::ORDER_NUM_ASC,
        self::ORDER_NAME_DESC,
        self::ORDER_NAME_ASC,
    ];

    const ORDER_NAME_ASC = 'name_asc';
    const ORDER_NAME_DESC = 'name_desc';
    const ORDER_NUM_ASC = 'num_asc';
    const ORDER_NUM_DESC = 'num_desc';

    public function __construct(string $order)
    {
        $this->orderBy = $order;
    }

    /** @var string */
    private $orderBy;

    public function create(): Criteria
    {
        $orderBy = ['name' => 'ASC'];

        switch ($this->orderBy) {
            case self::ORDER_NAME_DESC:
                $orderBy = ['name' => 'DESC'];
                break;
            case self::ORDER_NUM_ASC:
                $orderBy = ['age' => 'ASC'];
                break;
            case self::ORDER_NUM_DESC:
                $orderBy = ['age' => 'DESC'];
                break;
        }

        return (new Criteria())->orderBy($orderBy);
    }
}
