<?php

namespace App\Domain\User\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Domain\User\Entities\UserContact;
use App\Domain\User\Contracts\UserContactRepositoryInterface;

class UserContactRepository extends BaseRepository implements UserContactRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return UserContact::class;
    }
}
