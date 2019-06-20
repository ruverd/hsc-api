<?php

namespace App\Domain\User\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Domain\User\Entities\UserVehicle;
use App\Domain\User\Contracts\UserVehicleRepositoryInterface;

class UserVehicleRepository extends BaseRepository implements UserVehicleRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return UserVehicle::class;
    }
}
