<?php

namespace App\Domain\User\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Domain\User\Entities\UserPayment;
use App\Domain\User\Contracts\UserPaymentRepositoryInterface;

class UserPaymentRepository extends BaseRepository implements UserPaymentRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return UserPayment::class;
    }
}
