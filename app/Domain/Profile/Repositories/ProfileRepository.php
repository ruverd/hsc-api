<?php

namespace App\Domain\Profile\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Domain\Profile\Entities\Profile;
use App\Domain\Profile\Contracts\ProfileRepositoryInterface;

class ProfileRepository extends BaseRepository implements ProfileRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return Profile::class;
    }
}