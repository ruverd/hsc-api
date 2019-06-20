<?php

namespace App\Domain\User\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Domain\User\Entities\UserBackground;
use App\Domain\User\Contracts\UserBackgroundRepositoryInterface;

class UserBackgroundRepository extends BaseRepository implements UserBackgroundRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return UserBackground::class;
    }
}
