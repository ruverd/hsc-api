<?php

namespace App\Domain\User\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Domain\User\Entities\UserStatus;
use App\Domain\User\Contracts\UserStatusRepositoryInterface;

class UserStatusRepository extends BaseRepository implements UserStatusRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return UserStatus::class;
    }
}