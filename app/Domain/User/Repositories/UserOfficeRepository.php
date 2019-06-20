<?php

namespace App\Domain\User\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Domain\User\Entities\UserOffice;
use App\Domain\User\Contracts\UserOfficeRepositoryInterface;

class UserOfficeRepository extends BaseRepository implements UserOfficeRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return UserOffice::class;
    }
}
