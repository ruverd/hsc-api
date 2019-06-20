<?php

namespace App\Domain\User\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Domain\User\Entities\UserSpeciality;
use App\Domain\User\Contracts\UserSpecialityRepositoryInterface;

class UserSpecialityRepository extends BaseRepository implements UserSpecialityRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return UserSpeciality::class;
    }
}
