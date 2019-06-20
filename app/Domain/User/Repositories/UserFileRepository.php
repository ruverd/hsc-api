<?php

namespace App\Domain\User\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Domain\User\Entities\UserFile;
use App\Domain\User\Contracts\UserFileRepositoryInterface;

class UserFileRepository extends BaseRepository implements UserFileRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return UserFile::class;
    }
}
